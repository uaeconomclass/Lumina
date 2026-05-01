<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Enums\SettingType;
use App\Services\SettingService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\TextInput;

class SiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    /** @var array<string, mixed> */
    public ?array $data = [];

    public function mount(SettingService $settings): void
    {
        $this->form->fill([
            'site_name' => [
                'en' => $settings->get('site_name', 'Lumina CMS'),
                'ru' => $settings->get('site_name', 'Lumina CMS'),
            ],
            'contact_email' => [
                'en' => $settings->get('contact_email'),
                'ru' => $settings->get('contact_email'),
            ],
            'facebook_url' => [
                'en' => $settings->get('facebook_url'),
                'ru' => $settings->get('facebook_url'),
            ],
            'instagram_url' => [
                'en' => $settings->get('instagram_url'),
                'ru' => $settings->get('instagram_url'),
            ],
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Global values')
                ->schema([
                    Tabs::make('Locales')->tabs([
                        $this->localeTab('en', 'English'),
                        $this->localeTab('ru', 'Russian'),
                    ]),
                ]),
        ]);
    }

    public function save(SettingService $settings): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->form->getState();

        $settings->updateMany([
            'site_name' => [
                'value' => $data['site_name'],
                'type' => SettingType::String,
                'is_public' => true,
            ],
            'contact_email' => [
                'value' => $data['contact_email'],
                'type' => SettingType::Email,
                'is_public' => true,
            ],
            'facebook_url' => [
                'value' => $data['facebook_url'],
                'type' => SettingType::Url,
                'is_public' => true,
            ],
            'instagram_url' => [
                'value' => $data['instagram_url'],
                'type' => SettingType::Url,
                'is_public' => true,
            ],
        ]);

        Notification::make()
            ->success()
            ->title('Settings saved')
            ->send();
    }

    /** @return array<Action> */
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save settings')
                ->action('save')
                ->keyBindings(['mod+s']),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form'),
        ]);
    }

    private function localeTab(string $locale, string $label): Tab
    {
        return Tab::make($label)->schema([
            Grid::make(2)->schema([
                TextInput::make("site_name.{$locale}")
                    ->label('Site name')
                    ->required($locale === config('app.fallback_locale', 'en'))
                    ->maxLength(120),
                TextInput::make("contact_email.{$locale}")
                    ->label('Contact email')
                    ->email()
                    ->maxLength(160),
                TextInput::make("facebook_url.{$locale}")
                    ->label('Facebook URL')
                    ->url()
                    ->maxLength(255),
                TextInput::make("instagram_url.{$locale}")
                    ->label('Instagram URL')
                    ->url()
                    ->maxLength(255),
            ]),
        ]);
    }
}
