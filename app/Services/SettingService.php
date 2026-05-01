<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\SettingType;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    private const CACHE_KEY = 'lumina.public_settings';

    /**
     * @return array<string, mixed>
     */
    public function publicSettings(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, function (): array {
            return Setting::query()
                ->where('is_public', true)
                ->get()
                ->mapWithKeys(fn (Setting $setting): array => [
                    $setting->key => $this->castValue($setting),
                ])
                ->all();
        });
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $setting = Setting::query()->where('key', $key)->first();

        return $setting instanceof Setting ? $this->castValue($setting) : $default;
    }

    /** @param array<string, array<string, mixed>> $settings */
    public function updateMany(array $settings): void
    {
        foreach ($settings as $key => $payload) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                [
                    'value' => $payload['value'] ?? null,
                    'type' => $payload['type'] ?? SettingType::String,
                    'is_public' => $payload['is_public'] ?? false,
                ],
            );
        }

        Cache::forget(self::CACHE_KEY);
    }

    private function castValue(Setting $setting): mixed
    {
        $value = $setting->getTranslation('value', app()->getLocale(), false)
            ?: $setting->getTranslation('value', config('app.fallback_locale', 'en'), false);

        return match ($setting->type) {
            SettingType::Boolean => filter_var($value, FILTER_VALIDATE_BOOL),
            SettingType::Json => is_string($value) ? json_decode($value, true) : $value,
            default => $value,
        };
    }
}
