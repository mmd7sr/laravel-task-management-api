# Task Management API

A task-management application built with **Laravel 13**, offering two interfaces over the same domain:

- A **token-based REST API** (Laravel Sanctum) for programmatic access.
- A **session-based web UI** (Blade + Tailwind CSS) for interactive use.

Users can register, create projects, and manage tasks within those projects. All data is user-owned and protected by authorization policies.

---

## Features

- User registration, login, and logout
- **Dual authentication:** Sanctum bearer tokens for the API, session auth for the web UI
- **Projects** — full CRUD, owned per user
- **Tasks** — full CRUD, nested under projects
- Authorization via **Policies** (users can only access their own projects and tasks)
- Request validation (Form Requests on the API, validated controllers on the web)
- Standardized JSON output via **API Resources**
- **Pagination**, plus search and status filtering on listings
- Blade web UI with reusable components and flash/validation messaging

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Language | PHP 8.3+ |
| Framework | Laravel 13 |
| API auth | Laravel Sanctum 4 |
| Database | MySQL (SQLite supported) |
| ORM | Eloquent |
| Frontend | Blade, Tailwind CSS 4, Vite |
| Testing | Pest 4 |

---

## Requirements

- PHP **8.3+**
- Composer
- MySQL (or SQLite)
- Node.js & npm (for building frontend assets)

---

## Installation

```bash
# 1. Clone
git clone <repository-url>
cd task-management-api

# 2. Install PHP dependencies
composer install

# 3. Install & build frontend assets
npm install
npm run build

# 4. Create the environment file
cp .env.example .env

# 5. Generate the application key
php artisan key:generate
```

> A convenience script is also available: `composer setup` runs install, env creation, key generation, migration, and the asset build in one step.

---

## Environment Setup

Configure the database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_api
DB_USERNAME=root
DB_PASSWORD=
```

Sessions, cache, and queues default to the `database` driver, so their tables are created by the migrations below.

---

## Database Migration & Seeding

```bash
# Run all migrations
php artisan migrate

# (Optional) Seed a demo user
php artisan db:seed
```

The seeder creates one demo account:

- **Email:** `test@example.com`
- **Password:** `password`

---

## Running the Application

**All-in-one (server + queue + Vite dev):**

```bash
composer dev
```

**Or run pieces individually:**

```bash
# Backend
php artisan serve

# Frontend (dev server with hot reload)
npm run dev
```

The app is served at `http://127.0.0.1:8000`. Open it in a browser for the web UI, or point an API client at `/api/*`.

---

## Authentication Flow

**API (token-based, Sanctum)**
1. `POST /api/register` or `POST /api/login` returns a plain-text bearer token.
2. Send the token on protected requests:
   ```http
   Authorization: Bearer YOUR_ACCESS_TOKEN
   Accept: application/json
   ```
3. `POST /api/logout` revokes the current token.

**Web (session-based)**
- Register or log in through the Blade pages; the session cookie authenticates subsequent requests. Logging out invalidates the session.

The two guards are independent: the API uses the `sanctum` guard, the web UI uses the `web` (session) guard.

---

## API Endpoints

### Authentication

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/register` | Register and receive a token | No |
| POST | `/api/login` | Log in and receive a token | No |
| POST | `/api/logout` | Revoke the current token | Yes |

### Projects

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/projects` | List the user's projects (paginated, `?search=`, `?status=`) | Yes |
| POST | `/api/projects` | Create a project | Yes |
| GET | `/api/projects/{project}` | Show a project | Yes |
| PUT/PATCH | `/api/projects/{project}` | Update a project | Yes |
| DELETE | `/api/projects/{project}` | Delete a project | Yes |

### Tasks

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/projects/{project}/tasks` | List a project's tasks (paginated, `?search=`, `?status=`) | Yes |
| POST | `/api/projects/{project}/tasks` | Create a task under a project | Yes |
| GET | `/api/tasks/{task}` | Show a task | Yes |
| PUT | `/api/tasks/{task}` | Update a task | Yes |
| DELETE | `/api/tasks/{task}` | Delete a task | Yes |

**Status values** — Projects: `active`, `completed`, `archived`. Tasks: `todo`, `in_progress`, `done`.

---

## Web Pages

| Route | Description |
|-------|-------------|
| `/login`, `/register` | Session authentication |
| `/dashboard` | Overview: project/task counts and recent items |
| `/projects` | Project list with search & status filter |
| `/projects/create`, `/projects/{project}/edit` | Create / edit a project |
| `/projects/{project}` | Project detail with its tasks |
| `/projects/{project}/tasks/create`, `/tasks/{task}/edit` | Create / edit a task |

---

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/            # Token-authenticated JSON controllers
│   │   │   ├── AuthController.php
│   │   │   ├── ProjectController.php
│   │   │   └── TaskController.php
│   │   └── Web/            # Session-authenticated Blade controllers
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── ProjectController.php
│   │       └── TaskController.php
│   ├── Requests/           # Form Request validation (Store/Update × Project/Task)
│   └── Resources/          # ProjectResource, TaskResource
├── Models/                 # User, Project, Task
└── Policies/               # ProjectPolicy, TaskPolicy
resources/views/
├── layouts/app.blade.php   # Master layout
├── components/             # flash, input, textarea, select, button, card, status-badge
├── auth/                   # login, register
├── dashboard.blade.php
├── projects/               # index, create, edit, show, _form
└── tasks/                  # create, edit, _form
routes/
├── api.php                 # API routes (auth:sanctum)
└── web.php                 # Web routes (auth session)
```

---

## Authorization, Policies & Pagination

- **Ownership** is enforced by `ProjectPolicy` and `TaskPolicy`. Users can only view, update, or delete resources they own; unauthorized access returns **HTTP 403**. Both the API and web controllers authorize through these policies.
- **Pagination** is applied to all listings — the API returns paginated resource collections (with `data`, `links`, and `meta`), and the web listings are paginated as well.
- **Filtering & search** — project and task listings accept `search` (name/title) and `status` query parameters.

---

## Testing

```bash
php artisan test
```

Tests are written with **Pest**.

---

## Author

**Mohammad Hossein Rahimpour** — Laravel Developer
