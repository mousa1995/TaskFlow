# TaskFlow API — Backend Roadmap

## Phase 0 — Repository and project setup

- [x] Create a GitHub repository named `Taskflow`.
- [x] Initialize the repository with a `README.md` and this `TODO.md`.
- [x] Create a Laravel application in the repository (or document the chosen directory layout).
- [x] Confirm the PHP, Composer, Laravel, and SQL database versions used.
- [x] Configure `.env` locally and verify `.env` is ignored by Git.
- [x] Configure the local SQL database connection.
- [x] Run migrations successfully against a clean development database.
- [s] Run the default test suite and confirm the starting state is green.
- [s] Add a short project description and setup instructions to `README.md`.
- [s] Commit: `chore: initialize TaskFlow API`

## Phase 1 — Requirements and API contract

- [x] Define the Task fields:
  - `id`
  - `title` (required string, max 150 characters)
  - `description` (optional text)
  - `status` (`pending`, `in_progress`, `completed`)
  - `priority` (`low`, `medium`, `high`)
  - `due_date` (optional date)
  - `created_at`
  - `updated_at`
- [ ] Decide and document default values: `status = pending`, `priority = medium`.
- [ ] Define behavior for missing or invalid IDs (HTTP 404).
- [ ] Define JSON response conventions for success and validation errors.
- [ ] Define the initial endpoint contract:
  - `GET /api/tasks`
  - `POST /api/tasks`
  - `GET /api/tasks/{task}`
  - `PUT/PATCH /api/tasks/{task}`
  - `DELETE /api/tasks/{task}`
- [ ] Document list query parameters: `status`, `priority`, `search`, `per_page`, and `page`.
- [ ] Keep authentication explicitly out of scope for this first version.
- [ ] Commit: `docs: define TaskFlow API requirements`

## Phase 2 — Database and Eloquent model

- [ ] Create the `tasks` migration.
- [ ] Add the required columns and appropriate nullability/defaults.
- [ ] Add indexes only where justified by expected filters or queries.
- [ ] Create the `Task` Eloquent model.
- [ ] Configure mass assignment safely (`$fillable` or an appropriate alternative).
- [ ] Add casts for `due_date` and any other fields that need casting.
- [ ] Create a `TaskFactory`.
- [ ] Create a `TaskSeeder` only if useful for local demonstration.
- [ ] Rebuild the database from a clean state and verify migrations.
- [ ] Add tests for model/database persistence where appropriate.
- [ ] Commit: `feat: add Task model and database schema`

## Phase 3 — Read endpoints

- [ ] Create the API routes for listing and showing tasks.
- [ ] Implement `GET /api/tasks`.
- [ ] Implement `GET /api/tasks/{task}`.
- [ ] Use route model binding for individual tasks.
- [ ] Return a consistent JSON representation (use an API Resource if appropriate).
- [ ] Verify an unknown task ID returns 404.
- [ ] Write feature tests for list and detail endpoints.
- [ ] Commit: `feat: implement task read endpoints`

## Phase 4 — Create endpoint and validation

- [ ] Create a `StoreTaskRequest` Form Request.
- [ ] Validate `title`, `description`, `status`, `priority`, and `due_date`.
- [ ] Ensure enum-like values accept only the documented options.
- [ ] Implement `POST /api/tasks`.
- [ ] Return HTTP 201 when a task is created successfully.
- [ ] Return structured validation errors with HTTP 422 for invalid input.
- [ ] Write feature tests for valid creation, missing title, overlong title, invalid status/priority, and invalid date.
- [ ] Commit: `feat: implement task creation and validation`

## Phase 5 — Update and delete endpoints

- [ ] Create an `UpdateTaskRequest` Form Request.
- [ ] Decide and test the intended semantics for `PUT` versus `PATCH`.
- [ ] Implement `PUT/PATCH /api/tasks/{task}`.
- [ ] Ensure omitted optional fields behave according to the documented update contract.
- [ ] Implement `DELETE /api/tasks/{task}`.
- [ ] Choose and document the delete response (commonly HTTP 204 No Content).
- [ ] Test successful updates, validation failures, deletion, and requests for missing tasks.
- [ ] Commit: `feat: implement task update and delete endpoints`

## Phase 6 — Filtering, search, sorting, and pagination

- [ ] Add filtering by `status`.
- [ ] Add filtering by `priority`.
- [ ] Add search by task title (define whether matching is partial and case-insensitive for the selected database).
- [ ] Add pagination with a safe default and a maximum `per_page` value.
- [ ] Validate query parameter values and reject or safely handle invalid values.
- [ ] Use Eloquent query scopes only where they make the query clearer and reusable.
- [ ] Add feature tests for combined filters, empty results, search, and pagination metadata.
- [ ] Verify the API does not load the entire task table by default.
- [ ] Commit: `feat: add task filtering and pagination`

## Phase 7 — API consistency and maintainability

- [ ] Review controller responsibilities and keep controllers readable.
- [ ] Use API Resources for consistent task output where beneficial.
- [ ] Ensure timestamps and dates have a predictable JSON format.
- [ ] Review status codes: 200, 201, 204, 404, and 422 where appropriate.
- [ ] Ensure unexpected exceptions are not exposed as stack traces in production.
- [ ] Add or update API documentation (README endpoint examples or an OpenAPI document).
- [ ] Remove unused code and duplicated validation/business rules.
- [ ] Commit: `refactor: standardize API responses and documentation`

## Phase 8 — Test coverage and quality checks

- [ ] Run the full test suite from a clean database.
- [ ] Cover the happy path for every endpoint.
- [ ] Cover invalid payloads and missing records.
- [ ] Cover filtering, search, and pagination.
- [ ] Verify tests are isolated and do not depend on execution order.
- [ ] Check for N+1 queries or unnecessary database queries where relevant.
- [ ] Run the project's formatter/linter if configured.
- [ ] Fix all failing tests and document any remaining known limitations.
- [ ] Commit: `test: complete TaskFlow API feature coverage`

## Phase 9 — Final README and handoff

- [ ] Write the project purpose and feature list.
- [ ] Document prerequisites and exact local setup steps.
- [ ] Document environment/database setup without including secrets.
- [ ] Document how to run migrations, seed demo data, and run tests.
- [ ] Document all endpoints, request examples, response examples, and status codes.
- [ ] Document available filters and pagination parameters.
- [ ] Add a clear scope/limitations section (including that authentication is not included yet).
- [ ] Verify a new developer can run the API by following the README.
- [ ] Review Git history and ensure commits are understandable.
- [ ] Tag a first stable release, e.g. `v1.0.0`, if the repository is ready.
- [ ] Commit: `docs: finalize TaskFlow API README`

## Definition of done

- [ ] A developer can set up the project from the README.
- [ ] Database migrations work from a clean database.
- [ ] All documented endpoints behave as specified.
- [ ] Validation and error responses are predictable.
- [ ] Filtering, search, and pagination work and are tested.
- [ ] The full test suite passes.
- [ ] No secrets or local environment files are committed.
- [ ] The repository contains no frontend code in this version.

## Out of scope for v1

- Authentication and user ownership
- Teams, roles, and permissions
- File attachments
- Email/SMS notifications
- Background jobs and queues
- Frontend application
- Microservices or complex service-layer abstractions
