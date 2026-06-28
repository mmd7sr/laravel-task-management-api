# Laravel Task Management API

A RESTful Task Management API built with **Laravel 11** and **Laravel Sanctum**.  
This project provides token-based authentication and user-owned project management using a clean API structure, Form Requests, Eloquent relationships, and API Resources.

---

## Features

- User registration
- User login
- Token-based authentication with Laravel Sanctum
- Protected API routes
- Project CRUD operations
- User-owned projects
- Request validation using Form Requests
- Standardized JSON responses using API Resources
- Authorization checks to prevent users from accessing other users' projects

---

## Tech Stack

- PHP 8+
- Laravel 11
- Laravel Sanctum
- MySQL
- Eloquent ORM
- RESTful API Architecture
- Postman for API testing

---

## Project Structure

The project follows a clean Laravel API structure:
```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   └── ProjectController.php
│   ├── Requests/
│   │   ├── StoreProjectRequest.php
│   │   └── UpdateProjectRequest.php
│   └── Resources/
│       └── ProjectResource.php
├── Models/
│   ├── User.php
│   └── Project.php
routes/
└── api.php
Installation
Clone the repository:

bash
git clone https://gitlab.com/your-username/laravel-task-management-api.git
Go to the project directory:

bash
cd laravel-task-management-api
Install PHP dependencies:

bash
composer install
Create the environment file:

bash
cp .env.example .env
Generate the application key:

bash
php artisan key:generate
Configure your database in the .env file:

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_api
DB_USERNAME=root
DB_PASSWORD=
Run database migrations:

bash
php artisan migrate
Start the development server:

bash
php artisan serve
The API will be available at:

text
http://127.0.0.1:8000
Authentication
This project uses Laravel Sanctum for API token authentication.

After registration or login, the API returns a Bearer token.

Use this token to access protected endpoints.

Example header:

http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
Content-Type: application/json
API Endpoints
Auth Endpoints
Method	Endpoint	Description	Auth Required
POST	/api/register	Register a new user	No
POST	/api/login	Login user and generate token	No
POST	/api/logout	Logout user and revoke token	Yes
Project Endpoints
Method	Endpoint	Description	Auth Required
GET	/api/projects	Get authenticated user’s projects	Yes
POST	/api/projects	Create a new project	Yes
GET	/api/projects/{project}	Get a single project	Yes
PUT/PATCH	/api/projects/{project}	Update a project	Yes
DELETE	/api/projects/{project}	Delete a project	Yes
Request Examples
Register
http
POST /api/register
Request body:

json
{
  "name": "Test User",
  "email": "test@example.com",
  "password": "12345678",
  "password_confirmation": "12345678"
}
Example response:

json
{
  "user": {
"id": 1,
"name": "Test User",
"email": "test@example.com"
  },
  "token": "1|example-token"
}
Login
http
POST /api/login
Request body:

json
{
  "email": "test@example.com",
  "password": "12345678"
}
Example response:

json
{
  "user": {
"id": 1,
"name": "Test User",
"email": "test@example.com"
  },
  "token": "1|example-token"
}
Create Project
http
POST /api/projects
Headers:

http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
Content-Type: application/json
Request body:

json
{
  "name": "Task Management API",
  "description": "A Laravel 11 RESTful API with Sanctum authentication.",
  "status": "active"
}
Example response:

json
{
  "data": {
"id": 1,
"name": "Task Management API",
"description": "A Laravel 11 RESTful API with Sanctum authentication.",
"status": "active",
"created_at": "2026-06-18T10:00:43.000000Z",
"updated_at": "2026-06-18T10:00:43.000000Z"
  }
}
Get Projects
http
GET /api/projects
Headers:

http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
Example response:

json
{
  "data": [
{
"id": 1,
"name": "Task Management API",
"description": "A Laravel 11 RESTful API with Sanctum authentication.",
"status": "active",
"created_at": "2026-06-18T10:00:43.000000Z",
"updated_at": "2026-06-18T10:00:43.000000Z"
}
  ]
}
Validation
Project creation and update requests are validated using Laravel Form Requests.

Example project validation rules:

php
'name' => ['required', 'string', 'max:255'],
'description' => ['nullable', 'string'],
'status' => ['required', 'in:active,completed,on_hold'],
Authorization
Each project belongs to a specific user.

Authenticated users can only access, update, or delete their own projects.

If a user tries to access another user’s project, the API returns:

json
{
  "message": "This action is unauthorized."
}
Database Relationships
User
A user can have many projects.

php
public function projects()
{
return $this->hasMany(Project::class);
}
Project
A project belongs to one user.

php
public function user()
{
return $this->belongsTo(User::class);
}
Testing with Postman
Recommended headers for protected routes:

http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
Content-Type: application/json
Make sure to use the token returned from the login or register endpoint.

Future Improvements
Planned features:

Task CRUD API
Task assignment to projects
Task status and priority management
Pagination
Filtering by status and priority
Search functionality
Comment system for tasks
API response wrapper
Feature tests and unit tests
Project Status
Current version includes:

Authentication system
Sanctum token management
Protected API routes
Project CRUD functionality
User-based project ownership
Request validation
API Resources
Task management functionality is planned for the next development phase.

Author
Mohammad Hossein Rahimpour

Laravel Developer