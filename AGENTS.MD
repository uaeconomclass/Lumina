# Agent Guide: Lumina CMS

This file is the working context for AI agents editing Lumina CMS. Read this before changing code, then confirm details in the source files.

## Project Mission

Lumina CMS is a strict Laravel + Filament CMS intended to replace a heavy WordPress-style content setup with a small, maintainable backend and admin panel.

The project already has a working content foundation:

- Laravel 13 backend on PHP 8.3+.
- Filament 5 admin panel at `/admin`.
- Spatie Media Library for uploads and media conversions.
- Spatie Translatable for multilingual CMS fields.
- Public API under `/api/v1`.
- Pages, taxonomies, settings, users, media management, localization, factories, seeders, and feature tests.

## First Files To Read

Start with these files when picking up work:

- `README.md` for project overview and setup.
- `composer.json` for framework/package versions and scripts.
- `routes/api.php` for public API surface.
- `config/lumina.php` for CMS locales.
- `app/Providers/Filament/AdminPanelProvider.php` for admin panel configuration.
- `app/Services/*` for business logic.
- `app/Models/*` for data shape and relationships.
- `app/Filament/*` for admin UI.
- `tests/Feature/PageApiTest.php` for the current API behavior baseline.

## Architecture Rules

- Use `declare(strict_types=1);` in every PHP file.
- Keep business logic in `App\Services`.
- Keep API request validation in `App\Http\Requests`.
- Return public API entities through `App\Http\Resources`.
- Use Filament Resources for admin CRUD.
- Use Filament Pages or Actions for custom admin workflows.
- Do not add manual Blade controllers for admin CRUD.
- Prefer small, explicit classes over broad abstractions.
- Preserve Laravel conventions unless the project already has a stronger local pattern.
- Prevent N+1 queries with `with()`, `whenLoaded()`, and scoped queries.
- Keep mass assignment explicit through `$fillable` or Laravel model attributes.
- Use enums for fixed domain values.

## Domain Context

### Pages

Model: `App\Models\Page`

Service: `App\Services\PageService`

Admin resource: `App\Filament\Resources\Pages\PageResource`

API resource: `App\Http\Resources\PageResource`

Pages are the primary content entity. They support:

- Translatable `title`, `slug`, `content`, `seo_title`, and `seo_description`.
- `draft` and `published` statuses through `App\Enums\PageStatus`.
- Optional `published_at`.
- Parent-child hierarchy.
- Taxonomy assignment.
- Single featured image through the `featured_image` media collection.

Use `PageService` for create/update behavior so slug normalization, publish timestamps, and taxonomy syncing remain centralized.

### Taxonomies

Model: `App\Models\Taxonomy`

Admin resource: `App\Filament\Resources\Taxonomies\TaxonomyResource`

API resource: `App\Http\Resources\TaxonomyResource`

Taxonomies support categories and tags through `App\Enums\TaxonomyType`. Names and slugs are translatable. Pages attach to taxonomies through the polymorphic `taxonomables` table.

### Settings

Model: `App\Models\Setting`

Service: `App\Services\SettingService`

Admin page: `App\Filament\Pages\SiteSettings`

Settings are typed through `App\Enums\SettingType`. Public settings are cached by `SettingService::publicSettings()` and invalidated by `SettingService::updateMany()`.

Current public settings:

- `site_name`
- `contact_email`
- `facebook_url`
- `instagram_url`

When adding settings, update the service/page flow and consider cache invalidation.

### Media

Service: `App\Services\MediaService`

Admin page: `App\Filament\Pages\MediaLibrary`

Media is powered by Spatie Media Library. Pages register a single-file `featured_image` collection and two non-queued WebP conversions: `thumb` and `medium`.

When changing media behavior, check both the model collection setup and the API resource output.

### Users And Access

Model: `App\Models\User`

Admin resource: `App\Filament\Resources\Users\UserResource`

Roles: `App\Enums\UserRole`

Users can access the Filament admin panel only with the `admin` or `editor` role. Keep this gate in `User::canAccessPanel()`.

## Localization Workflow

Supported locales are in `config/lumina.php`; currently `en` and `ru`.

Locale is selected by `App\Http\Middleware\SetLocale` from:

1. Route parameter `locale`.
2. First URL segment.
3. `Accept-Language`.
4. Fallback locale.

When adding or changing locales:

- Update `config/lumina.php`.
- Update Filament forms with locale tabs/fields where needed.
- Check seeders and factories.
- Add or adjust API tests for localized output and slug lookup.

## API Workflow

Public API routes live in `routes/api.php` under `/api/v1`.

Current endpoints:

- `GET /api/v1/pages`
- `GET /api/v1/pages/{slug}`
- `GET /api/v1/settings`

Controllers should stay thin and delegate behavior to services. Validation belongs in FormRequests. Responses should use JsonResources unless returning a simple settings payload.

For page API changes, check:

- `App\Http\Controllers\Api\V1\PageController`
- `App\Http\Requests\PageIndexRequest`
- `App\Http\Requests\PageShowRequest`
- `App\Http\Resources\PageResource`
- `App\Services\PageService`
- `tests/Feature/PageApiTest.php`

## Filament Workflow

Admin CRUD belongs in Filament Resources:

- Pages: `app/Filament/Resources/Pages`
- Taxonomies: `app/Filament/Resources/Taxonomies`
- Users: `app/Filament/Resources/Users`

Custom admin screens belong in `app/Filament/Pages`.

Keep forms and tables in their existing `Schemas` and `Tables` classes. When adding fields, update the model fillable list, migrations, form schema, table columns if needed, service normalization, resources, factories, and tests as appropriate.

## Commands

Install dependencies:

```bash
composer install
npm install
```

Prepare local app:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

Run development stack:

```bash
composer run dev
```

Run tests:

```bash
composer test
```

Format PHP:

```bash
vendor/bin/pint
```

Build assets:

```bash
npm run build
```

## Seeded Admin

The database seeder creates:

```text
Email: admin@lumina.test
Password: password
Role: admin
```

Use only for local development/demo data.

## Testing Expectations

Add focused tests when changing:

- Public API behavior.
- Localization or slug lookup.
- Publishing rules.
- Service logic.
- Data serialization.
- Permission-sensitive admin behavior.

Use factories instead of large manual fixtures. Keep tests clear about locale and status.

## Security And Performance Checklist

Before finishing a change, check:

- No missing `declare(strict_types=1);`.
- No business logic hidden in controllers or Filament page callbacks when it belongs in a service.
- No unvalidated public API input.
- No raw model arrays exposed from API endpoints.
- No N+1 queries in list endpoints or Filament tables.
- No broad mass assignment.
- Settings cache is invalidated after settings writes.
- Media URLs and conversions still work after media changes.

## Removed Build Prompts

The old `prompts/` directory was used only to guide the initial CMS build. It is no longer part of the active workflow. Use this guide, the README, and the source code as the current project context.
