# SchoolOps Laravel Dashboard

Production-ready Laravel 12 dashboard starter for school operations: attendance, classes, finance, messaging, and access controls—styled with Tailwind CSS 4 and Vite.

## Features

- 🛰️ Operations cockpit with live-style metrics, charts (Chart.js), and activity signals
- 🧑‍🎓 Students & classes tables with guardian contacts and schedule coverage
- ✅ Attendance & finance reporting cards with fee and budget summaries
- ✉️ Messages & alerts lanes for quick comms
- 🛡️ Settings toggles and team access groups
- 🎨 Modern UI powered by Tailwind CSS 4 + Instrument Sans, responsive out of the box

## Stack

- Laravel 12, PHP 8.2+
- Vite 7, Tailwind CSS 4 (@tailwindcss/vite)
- Chart.js for visualizations

## Prerequisites

- PHP 8.2+, Composer
- Node.js 18+ and npm
- SQLite (default) or another DB configured in `.env`

## Local setup

```bash
git clone https://github.com/yusufdupsc1/Laravel-templates.git
cd Laravel-templates
cp .env.example .env
composer install
php artisan key:generate
npm install
# optional: adjust DB path in .env (defaults to SQLite at database/database.sqlite)
php artisan migrate --seed
```

Start the app:

```bash
# terminal 1
php artisan serve

# terminal 2
npm run dev
```

Visit `http://127.0.0.1:8000`.

## Demo content

- Demo data is seeded into SQLite for students, classes, attendance summaries, invoices, settings, and messages (`php artisan migrate --seed`).
- Add/edit/delete via UI:
  - Students: inline form + per-row edit/delete on `/students` (search + CSV export)
  - Classes: inline form + per-row edit/delete on `/classes`
  - Finance: inline form + per-row edit/delete on `/finance` (totals, aging, status colors)
  - Messages: compose + archive on `/messages` (queued email/SMS stub)
  - Attendance: per-grade edit/lock on `/attendance`
- Dashboard metrics/charts auto-read from stored data and are cached.

## Production build

```bash
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
```

Set `APP_ENV=production` and configure your database/queue/mail values in `.env` before deploying.

## API

- Sanctum-secured API endpoints:
  - `GET /api/students`, `/api/classes`, `/api/invoices`, `/api/messages`, `/api/attendance`
- Issue a token in Tinker:
```php
$user = \App\Models\User::factory()->create(['email' => 'api@example.com']);
$user->createToken('cli')->plainTextToken;
```

## Docker

```bash
docker build -t schoolops .
docker run -p 8000:9000 --env-file .env schoolops
```

## CI/CD (GitHub Actions + Vercel)

- Workflow: `.github/workflows/ci.yml` runs Composer/NPM installs, migrations, tests, and triggers Vercel deploy on `main`.
- Secrets needed: `VERCEL_TOKEN`, `VERCEL_ORG_ID`, `VERCEL_PROJECT_ID`.
- Vercel uses `vercel.json` + `Dockerfile`.

## Queues & notifications

- Messages dispatch a queued `SendMessageNotifications` job (email via configured mailer, SMS placeholder via logs). Run `php artisan queue:work` in production.

## Tests

```bash
php artisan test
```

## GitHub sync

```bash
git status
git add -A
git commit -m "Describe your change"
git push origin main
```

---

Ship-ready starting point for a school operations control center. 🚀
