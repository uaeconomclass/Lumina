# Lumina CMS

Lumina CMS is a lightweight Laravel CMS built as a modern replacement for a heavy WordPress-style setup. The project uses a strictly typed Laravel backend, a Filament admin panel, Spatie Media Library for uploads, and Spatie Translatable for multilingual content.

The current implementation focuses on a clean content core: pages, taxonomies, public settings, media management, admin users, and a small public API for consuming published CMS content from a frontend or external client.

## Tech Stack

- PHP 8.3+
- Laravel 13
- Filament 5 admin panel
- Spatie Laravel Media Library 11
- Spatie Laravel Translatable 6
- Vite 8 and Tailwind CSS 4
- PHPUnit 12
- SQLite by default for local development

## What Is Implemented

- Admin panel at `/admin` powered by Filament.
- CRUD resources for pages, taxonomies, and users.
- Custom Filament pages for site settings and media library management.
- Public API under `/api/v1`.
- Translatable page, taxonomy, and setting fields.
- Locale detection through URL segment, route locale, or `Accept-Language` header.
- Page publishing workflow with `draft` and `published` statuses.
- Parent-child page hierarchy.
- Polymorphic taxonomy assignment for pages.
- Featured image support for pages through Spatie Media Library.
- WebP media conversions for `thumb` and `medium`.
- Public settings cache through `SettingService`.
- Seeded admin account and demo content.
- Feature tests for the public page API.

## Main Domain Model

### Pages

`App\Models\Page` is the primary content model.

Translatable fields:

- `title`
- `slug`
- `content`
- `seo_title`
- `seo_description`

Important behavior:

- `status` is cast to `App\Enums\PageStatus`.
- Published pages are filtered through the `published()` scope.
- Slugs are generated per locale in `App\Services\PageService` when missing.
- Pages can have a parent page and child pages.
- Pages can be attached to taxonomies.
- Pages can have one featured image in the `featured_image` media collection.

### Taxonomies

`App\Models\Taxonomy` supports categories and tags through `App\Enums\TaxonomyType`.

Translatable fields:

- `name`
- `slug`

Taxonomies are attached to pages through the polymorphic `taxonomables` pivot table.

### Settings

`App\Models\Setting` stores global site values.

Current public settings:

- `site_name`
- `contact_email`
- `facebook_url`
- `instagram_url`

Setting values are translatable and typed through `App\Enums\SettingType`.

### Users

`App\Models\User` implements Filament panel access. Users can access `/admin` only when their role is `admin` or `editor`.

Roles are defined in `App\Enums\UserRole`.

## Admin Panel

The Filament panel is configured in:

```text
app/Providers/Filament/AdminPanelProvider.php
```

Admin URL:

```text
/admin
```

Seeded local credentials:

```text
Email: admin@lumina.test
Password: password
```

Admin sections:

- Content
  - Pages
  - Taxonomies
  - Media Library
- System
  - Users
  - Site Settings

CRUD screens must stay inside Filament Resources. Custom admin workflows should be implemented as Filament Pages or Actions, not as manual Blade admin controllers.

## Public API

Routes are defined in `routes/api.php`.

Base prefix:

```text
/api/v1
```

Endpoints:

```http
GET /api/v1/pages
GET /api/v1/pages/{slug}
GET /api/v1/settings
```

### Get Published Pages

```http
GET /api/v1/pages?per_page=15&taxonomy=news
Accept-Language: en
```

Returns a paginated `PageResource` collection. Only published pages are returned.

### Get Page By Slug

```http
GET /api/v1/pages/about
Accept-Language: en
```

The lookup checks all configured locales, so localized slugs such as `/api/v1/pages/o-nas` work when the page has a Russian slug.

### Get Public Settings

```http
GET /api/v1/settings
Accept-Language: en
```

Returns public settings from `SettingService`. Values are cached forever until settings are updated through the service.

## Localization

Supported locales are configured in:

```text
config/lumina.php
```

Current locales:

```php
['en', 'ru']
```

Locale is selected by `App\Http\Middleware\SetLocale` using this priority:

1. Route parameter named `locale`.
2. First URL segment, when it matches a supported locale.
3. `Accept-Language` header.
4. `app.fallback_locale`.

When adding a new locale, update `config/lumina.php`, review Filament forms that currently define `en` and `ru` tabs, and add tests for localized API behavior.

## Media

Media is handled by Spatie Media Library.

Important files:

- `App\Services\MediaService`
- `App\Filament\Pages\MediaLibrary`
- `App\Models\Page`

Pages use a single-file media collection:

```text
featured_image
```

Configured conversions:

- `thumb`: 150x150 WebP
- `medium`: 600x400 WebP

For local public media URLs, run:

```bash
php artisan storage:link
```

## Project Structure

```text
app/
  Enums/                  Typed domain values
  Filament/               Admin resources, forms, tables, custom pages
  Http/Controllers/Api/   Public API controllers
  Http/Middleware/        Locale middleware
  Http/Requests/          API validation
  Http/Resources/         API response resources
  Models/                 Eloquent models
  Services/               Business logic
config/lumina.php         Project-specific CMS config
database/migrations/      Schema
database/factories/       Test and seed factories
database/seeders/         Demo content and admin user
routes/api.php            Public API
tests/Feature/            Feature tests
```

## Local Setup

Install PHP dependencies:

```bash
composer install
```

Install Node dependencies:

```bash
npm install
```

Create the environment file and app key:

```bash
cp .env.example .env
php artisan key:generate
```

Run migrations and seed demo data:

```bash
php artisan migrate --seed
```

Create the public storage link:

```bash
php artisan storage:link
```

Build frontend assets:

```bash
npm run build
```

Start local development:

```bash
composer run dev
```

The default Laravel server is available at:

```text
http://127.0.0.1:8000
```

## Quality Checks

Run the test suite:

```bash
composer test
```

Run Pint:

```bash
vendor/bin/pint
```

Run a quick PHP syntax check for an edited file:

```bash
php -l app/Path/To/File.php
```

## Development Rules

- Every PHP file must use `declare(strict_types=1);`.
- Keep business logic in `App\Services`.
- Keep API validation in FormRequest classes.
- Return API data through JsonResource classes.
- Use Filament Resources for admin CRUD.
- Prevent N+1 queries with explicit eager loading.
- Keep mass assignment explicit with `$fillable` or Laravel attributes.
- Prefer enums for controlled domain values.
- Add focused tests for API behavior, services, and risky admin-side changes.
