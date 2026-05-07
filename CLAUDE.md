# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Lumina CMS** — легка Laravel CMS як альтернатива WordPress. Laravel 13, PHP 8.3+, Filament 5 admin panel, Spatie Media Library, Spatie Translatable, SQLite за замовчуванням.

## Commands

```bash
# Setup
composer run setup        # One-command: install deps + migrate + seed

# Development
composer run dev          # Laravel server + queue + logs + Vite (all together)
npm run build             # Build frontend assets

# Quality
composer test             # PHPUnit test suite
vendor/bin/pint           # PHP code formatter (Laravel Pint)

# Run a single test
php artisan test --filter=TestClassName
```

Default admin: `admin@lumina.test` / `password`

## Architecture

### Layers

- **Controllers** (`app/Http/Controllers/Api/`) — thin, delegate to services
- **Services** (`app/Services/`) — all business logic (PageService, SettingService, MediaService)
- **FormRequests** (`app/Http/Requests/`) — API validation
- **JsonResources** (`app/Http/Resources/`) — API response shaping; never return raw Eloquent models
- **Filament** (`app/Filament/`) — admin CRUD and custom pages; no manual Blade controllers for admin

### Domain Models

| Model | Key traits |
|---|---|
| `Page` | Translatable (title, slug, content, seo_*), parent-child hierarchy, PageStatus enum, Spatie Media (thumb/medium WebP) |
| `Taxonomy` | Translatable (name, slug), TaxonomyType enum (category/tag), polymorphic to Page |
| `Setting` | SettingType enum (string/boolean/json), translatable value, public/private, cached forever by SettingService |
| `User` | UserRole enum (admin/editor), Filament panel auth |

### Public API (`/api/v1`)

```
GET /pages              # Paginated published pages, filterable by taxonomy
GET /pages/{slug}       # Single page, cross-locale slug lookup
GET /settings           # Public settings only
```

Locale resolved from: route param → first URL segment → `Accept-Language` header → app fallback. Handled by `SetLocale` middleware.

### Localization

Supported locales configured in `config/lumina.php`. Filament forms show locale tabs for translatable fields. Slug lookup scans all configured locales.

### Enums

All controlled domain values are enums in `app/Enums/`. Each enum provides `label()` and `options()` for Filament form selects.

## Mandatory Conventions

- Every PHP file **must** start with `declare(strict_types=1);`
- Eager-load relations with `with()` — no N+1
- Admin UI goes in Filament Resources/Pages, not manual controllers
- Business logic goes in Services, not controllers or models
- Settings cache: `Cache::rememberForever()`, invalidated on save
- Tests use `RefreshDatabase` + in-memory SQLite
