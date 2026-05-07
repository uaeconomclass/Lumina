<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home'))->name('home');
Route::get('/cars', fn () => Inertia::render('Cars/Index'))->name('cars.index');
Route::get('/cars/{id}', fn ($id) => Inertia::render('Car/Show'))->name('cars.show');
