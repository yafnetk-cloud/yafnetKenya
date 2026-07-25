# YAFNET Website — Laravel Application

Official website for the Youth Action Forum for Networking (YAFNET), including a public
site (Home, About, Programs, Flagship Programs, Where We Work, News & Stories, Partners,
Get Involved, Governance/Leadership, Contact) and a secure `/admin` content management
panel with role-based access (Super Admin / Editor).

This folder is **application source code**, meant to be dropped into a fresh Laravel
installation — it is not a runnable `vendor/` bundle, because Composer/Packagist was not
reachable from the environment this was built in. Setup below gets you from this source
to a running site in a few minutes on your own machine.

## 1. Requirements

- PHP 8.2+ (you already have 8.2.12 ✅)
- Composer 2.x (you already have 2.10.2 ✅)
- MySQL or PostgreSQL (SQLite also works for local dev)
- Node.js + npm (only needed if you later add a JS build step — not required to run this,
  since styling uses the Tailwind CDN build for simplicity)

## 2. Create the base Laravel app

This package contains only the YAFNET-specific application code (`app/`, `resources/`,
`routes/`, `database/`, `bootstrap/app.php`, `public/index.php`, `artisan`, `composer.json`).
It's missing the framework's own vendor files and a few stock Laravel files. Fastest path:

```bash
# 1. Create a fresh Laravel 11 project somewhere temporary
composer create-project laravel/laravel yafnet-tmp "^11.0"

# 2. Copy the *stock* Laravel files you don't have yet into this project folder
cp -r yafnet-tmp/config yafnet-website/config
cp yafnet-tmp/bootstrap/providers.php yafnet-website/bootstrap/providers.php 2>/dev/null || true
cp -r yafnet-tmp/database/factories yafnet-website/database/factories 2>/dev/null || true
cp -r yafnet-tmp/tests yafnet-website/tests
cp -r yafnet-tmp/public/. yafnet-website/public/ --no-clobber 2>/dev/null || true
cp yafnet-tmp/.gitattributes yafnet-website/ 2>/dev/null || true

# 3. Remove the scaffold project
rm -rf yafnet-tmp
```

> This repo already includes YAFNET's own `bootstrap/app.php`, `artisan`, `public/index.php`,
> `.gitignore` and `composer.json` — don't overwrite those with the scaffold's versions.

## 3. Install dependencies

```bash
cd yafnet-website
composer install
```

## 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials, mail settings, and (when ready) your
Paystack / M-Pesa keys and cloud storage credentials (S3 or Cloudinary).

## 5. Create the database and run migrations + seeders

```bash
php artisan migrate --seed
php artisan storage:link
```

Seeding creates:
- A **Super Admin** login: `admin@yafnet.org` / `ChangeMe123!`
- An **Editor** login: `editor@yafnet.org` / `ChangeMe123!`
- Sample pillars, programs (including the Digital Peace Corridors flagship program),
  impact stats, team members (founders + CEO), partners, news posts, and one job posting.

**Change both default passwords immediately** — either via `php artisan tinker` or by
adding a password-change flow before going live.

## 6. Run it locally

```bash
php artisan serve
```

Visit `http://localhost:8000` for the public site and `http://localhost:8000/admin`
for the admin panel.

## 7. What's implemented vs. what's stubbed

**Implemented:**
- Full public site structure and all pages from the spec, styled in navy/gold with
  animated impact-stat counters, scroll fade-ins, and a responsive mobile nav
- Role-based admin auth (Super Admin vs Editor) with session-based login
- Admin CRUD for: News/Stories (draft/publish/scheduled workflow), Partners, Team &
  Leadership, Programs (including flagship program components), Impact Stats,
  Job/Volunteer postings, Media Library (drag-and-drop upload not wired — standard file
  input), Site Settings, and Admin Users (Super Admin only)
- Form submissions inbox (contact, volunteer, partner inquiry, newsletter) with
  CSV export
- Activity log on the dashboard

**Intentionally stubbed — wire these up for production:**
- **Payments:** the Donate section has placeholder amount buttons. Paystack/M-Pesa/Stripe
  integration needs your merchant credentials and a webhook handler — env vars are already
  reserved in `.env.example`.
- **Interactive map:** "Where We Work" has a placeholder container — drop in Leaflet.js or
  Mapbox GL with a Kenya counties GeoJSON layer.
- **Rich text editor:** News/Program body fields are plain textareas — wire in a WYSIWYG
  (TipTap, Quill, or Trix) for the admin.
- **Cloud image storage:** `FILESYSTEM_DISK` defaults to local `public` disk; switch to
  `s3` (or add a Cloudinary driver) for production so uploads survive redeploys.
- **2FA:** the `users` table has `two_factor_enabled`/`two_factor_secret` columns ready,
  but the actual TOTP flow isn't implemented yet.
- **Google Analytics:** an env var is reserved; add the tracking snippet to
  `resources/views/layouts/app.blade.php` once you have a GA4 property ID.
- **SEO extras:** add `spatie/laravel-sitemap` (or a simple custom route) for
  `sitemap.xml`, and a `robots.txt` in `public/`.

## 8. Deployment

Any standard Laravel host works (Laravel Forge, Vercel via a PHP runtime is not
recommended — use a proper PHP host such as a VPS, Laravel Cloud, Render, or Railway).
Typical flow:

```bash
composer install --optimize-autoloader --no-dev
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Point your web server's document root at `public/`.

## 9. Project structure

```
app/Http/Controllers/          Public-site controllers (PageController)
app/Http/Controllers/Admin/    Admin panel controllers (one per resource)
app/Models/                    Eloquent models
app/Http/Middleware/           EnsureAdmin, EnsureSuperAdmin
database/migrations/           All schema migrations
database/seeders/               Sample content seeders
resources/views/layouts/       Public site layout
resources/views/partials/      Nav + footer
resources/views/pages/         Public page templates
resources/views/admin/         Admin panel views (layout, login, dashboard, CRUD forms)
routes/web.php                 All public + admin routes
```
