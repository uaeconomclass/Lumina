<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('throttle:api')
    ->group(function (): void {
        Route::get('pages', [PageController::class, 'index']);
        Route::get('pages/{slug}', [PageController::class, 'show']);
        Route::get('settings', [SettingController::class, 'index']);
    });
