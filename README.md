# TaskFlow API

TaskFlow is a task management REST API built with Laravel. This project focuses on backend development, database operations, request validation, API design, and automated testing.

## Features

- Create, retrieve, update, and delete tasks (CRUD).
- Validate incoming requests using Laravel Form Requests.
- Filter tasks by status and priority.
- Search tasks by title.
- Paginate task lists.
- Return task data using Laravel API Resources.
- Handle missing tasks with HTTP 404 responses.
- Test API endpoints using automated feature tests.

## Tech Stack

- **Backend:** PHP, Laravel
- **Database:** SQLite
- **Testing:** Laravel testing tools / PHPUnit
- **Version control:** Git and GitHub

## Project Structure

```text
TaskFlow/
├── backend/    # Laravel API application
├── README.md   # Project documentation
└── TODO.md     # Backend roadmap and progress
```

## Requirements

Before running the project, make sure you have:

- PHP and the extensions required by your Laravel application.
- Composer.
- SQLite support enabled for PHP.

## Installation and Setup

Clone the repository and enter the backend directory:

```bash
git clone https://github.com/mousa1995/TaskFlow.git
cd TaskFlow/backend
```

Install PHP dependencies:

```bash
composer install
```

Create your local environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Database setup

Configure your local environment to use SQLite. Make sure the database path in `.env` points to a valid SQLite database file.

If the configured database file does not exist and your project uses `database/database.sqlite`, create it:

```bash
touch database/database.sqlite
```

Run the migrations:

```bash
php artisan migrate
```

### Run the API

Start the local development server:

```bash
php artisan serve
```

By default, the application is available at:

```text
http://127.0.0.1:8000
```

The API endpoints use the `/api` prefix.

### Run the tests

From the `backend` directory, run:

```bash
php artisan test
```

## API Endpoints

| Method | Endpoint            | Description                        |
| ------ | ------------------- | ---------------------------------- |
| GET    | `/api/tasks`        | Retrieve a paginated list of tasks |
| POST   | `/api/tasks`        | Create a task                      |
| GET    | `/api/tasks/{task}` | Retrieve a single task             |
| PUT    | `/api/tasks/{task}` | Update a task                      |
| PATCH  | `/api/tasks/{task}` | Partially update a task            |
| DELETE | `/api/tasks/{task}` | Delete a task                      |

### Task fields

| Field         | Description                                 |
| ------------- | ------------------------------------------- |
| `id`          | Task identifier                             |
| `title`       | Required task title, maximum 150 characters |
| `description` | Optional task description                   |
| `status`      | `pending`, `in_progress`, or `completed`    |
| `priority`    | `low`, `medium`, or `high`                  |
| `due_date`    | Optional due date                           |
| `created_at`  | Creation timestamp                          |
| `updated_at`  | Last update timestamp                       |

Default values:

- `status`: `pending`
- `priority`: `medium`

### List filters and pagination

The `GET /api/tasks` endpoint supports these query parameters:

| Parameter  | Description                         |
| ---------- | ----------------------------------- |
| `status`   | Filter tasks by status              |
| `priority` | Filter tasks by priority            |
| `search`   | Search task titles                  |
| `per_page` | Choose the number of tasks per page |
| `page`     | Select a page                       |

Example:

```text
GET /api/tasks?status=pending&priority=high&search=report&per_page=10&page=1
```

Pagination responses include task data and pagination metadata and links.

### Example: Create a task

Request:

```http
POST /api/tasks
Content-Type: application/json
Accept: application/json
```

Body:

```json
{
  "title": "Learn Laravel API Resources",
  "description": "Practice consistent API responses",
  "status": "pending",
  "priority": "medium",
  "due_date": "2026-11-15"
}
```

A successful creation returns HTTP `201 Created`.

## Response and Error Handling

Successful responses include a success indicator, a message, and the relevant data where applicable.

Common HTTP status codes:

- `200 OK` — successful retrieval, update, or deletion.
- `201 Created` — successful task creation.
- `404 Not Found` — the requested task does not exist.
- `422 Unprocessable Content` — request validation failed.

Validation errors are handled by Laravel's request validation mechanism.

## Testing

Automated feature tests cover task creation, retrieval, updates, deletion, validation, filtering, search, and pagination.

Run the complete test suite with:

```bash
php artisan test
```

## Scope and Limitations

This version focuses on the backend API.

- Authentication is not included.
- User ownership, teams, roles, and permissions are not included.
- File attachments and notifications are not included.
- A frontend application has not yet been included in this version.

## Development Roadmap

See [TODO.md](TODO.md) for implementation progress and planned work.
