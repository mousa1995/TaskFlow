# TaskFlow

TaskFlow is a learning project focused on building a RESTful API with Laravel. It provides task management features and serves as a backend foundation for a future frontend application.

## Features

- Create, retrieve, update, and delete tasks
- Validate incoming requests
- Filter tasks by status and priority
- Search tasks by title
- Paginate task lists
- Return consistent JSON responses using Laravel API Resources
- Automated feature tests

## Tech Stack

- PHP 8.3+
- Laravel 13
- SQLite
- PHPUnit

## Project Structure

```text
TaskFlow/
├── backend/
│   ├── app/
│   ├── database/
│   ├── routes/
│   └── tests/
├── README.md
└── TODO.md
```

## Requirements

- PHP 8.3 or newer
- Composer
- SQLite support and the PHP extensions required by Laravel

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/mousa1995/TaskFlow.git
cd TaskFlow/backend
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Prepare the SQLite database

```bash
touch database/database.sqlite
```

Make sure `.env` contains:

```env
DB_CONNECTION=sqlite
SESSION_DRIVER=file
```

### 5. Run migrations

```bash
php artisan migrate
```

### 6. Start the development server

```bash
php artisan serve
```

The API will be available at:

`http://127.0.0.1:8000`

API routes use the `/api` prefix.

## API Endpoints

| Method | Endpoint            | Description             |
| ------ | ------------------- | ----------------------- |
| GET    | `/api/tasks`        | List tasks              |
| POST   | `/api/tasks`        | Create a task           |
| GET    | `/api/tasks/{task}` | Retrieve a task         |
| PUT    | `/api/tasks/{task}` | Replace/update a task   |
| PATCH  | `/api/tasks/{task}` | Partially update a task |
| DELETE | `/api/tasks/{task}` | Delete a task           |

## Task Fields

| Field         | Description                              |
| ------------- | ---------------------------------------- |
| `id`          | Unique task identifier                   |
| `title`       | Required string, maximum 150 characters  |
| `description` | Optional description                     |
| `status`      | `pending`, `in_progress`, or `completed` |
| `priority`    | `low`, `medium`, or `high`               |
| `due_date`    | Optional date                            |
| `created_at`  | Creation timestamp                       |
| `updated_at`  | Last update timestamp                    |

## Filtering, Search, and Pagination

The task listing endpoint supports:

- `status` — filter by task status
- `priority` — filter by priority
- `search` — search task titles
- `per_page` — number of tasks per page
- `page` — page number

Example:

```text
GET /api/tasks?status=pending&priority=high&search=Laravel&per_page=5&page=1
```

## Example: Create a Task

Send a `POST` request to `/api/tasks` with the `Accept: application/json` header and a JSON body:

```json
{
  "title": "Learn Laravel API Resources",
  "description": "Practice consistent API responses",
  "status": "pending",
  "priority": "medium",
  "due_date": "2026-11-15"
}
```

## Validation and Error Handling

The API validates incoming task data and returns JSON responses.

Common HTTP status codes:

- `200 OK` — successful retrieval or update
- `201 Created` — task created
- `404 Not Found` — task does not exist
- `422 Unprocessable Content` — validation failed

## Running Tests

From the `backend/` directory:

```bash
php artisan test
```

## Project Scope

This project currently focuses on backend API development. Authentication, user ownership, teams, notifications, file uploads, and frontend integration are outside the initial scope.

## Roadmap

- [x] Core task CRUD
- [x] Request validation
- [x] Filtering and search
- [x] Pagination
- [x] API Resources
- [x] Feature tests
- [ ] Review edge cases and validation coverage
- [ ] Build a frontend application
