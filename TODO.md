# TaskFlow API — Backend Roadmap

## Phase 0 — Repository and project setup

- [x] Create the GitHub repository.
- [x] Initialize the repository with `README.md` and `TODO.md`.
- [x] Create the Laravel application in `backend/`.
- [x] Confirm PHP, Composer, Laravel, and database versions.
- [x] Configure local `.env` and Git ignore rules.
- [x] Configure SQLite.
- [x] Run migrations successfully.
- [x] Run the initial test suite.
- [ ] Finalize README setup instructions and verify them on a clean environment.
- [x] Commit initial backend setup.

## Phase 1 — Requirements and API contract

- [x] Define all Task fields.
- [x] Define title validation and maximum length.
- [x] Define allowed status values.
- [x] Define allowed priority values.
- [x] Configure default status as `pending`.
- [x] Configure default priority as `medium`.
- [x] Implement missing-task 404 responses.
- [x] Establish JSON response conventions.
- [x] Implement `GET /api/tasks`.
- [x] Implement `POST /api/tasks`.
- [x] Implement `GET /api/tasks/{task}`.
- [x] Implement `PUT /api/tasks/{task}`.
- [x] Implement `PATCH /api/tasks/{task}`.
- [x] Implement `DELETE /api/tasks/{task}`.
- [x] Implement status and priority filters.
- [x] Implement title search.
- [x] Implement pagination.
- [x] Keep authentication out of scope for v1.
- [ ] Review and finalize API contract documentation.

## Phase 2 — Database and Eloquent model

- [x] Create the `tasks` migration.
- [x] Define columns, nullability, and defaults.
- [x] Create the `Task` model.
- [x] Configure `$fillable`.
- [x] Verify database persistence through feature tests.
- [ ] Review date casting.
- [ ] Add a `TaskFactory` if useful for test data.
- [ ] Add a `TaskSeeder` if useful for demonstration.
- [ ] Review database indexes based on actual query patterns.
- [ ] Verify migrations from a clean database.

## Phase 3 — Read endpoints

- [x] Implement the task list endpoint.
- [x] Implement the individual task endpoint.
- [x] Use `TaskResource` for task output.
- [x] Implement missing-task 404 behavior.
- [x] Add feature tests for list and detail endpoints.
- [ ] Consider route model binding.
- [ ] Review response consistency between endpoints.

## Phase 4 — Create endpoint and validation

- [x] Create `StoreTaskRequest`.
- [x] Validate title, description, status, priority, and due date.
- [x] Restrict status and priority to allowed values.
- [x] Implement task creation.
- [x] Return HTTP 201 for successful creation.
- [x] Test successful creation.
- [x] Test missing title.
- [x] Test invalid status.
- [x] Test HTTP 422 validation behavior.
- [ ] Test overlong title, invalid priority, and invalid date.

## Phase 5 — Update and delete endpoints

- [x] Create `UpdateTaskRequest`.
- [x] Implement PUT and PATCH updates.
- [x] Test successful updates.
- [x] Test partial updates.
- [x] Test invalid updates.
- [x] Implement task deletion.
- [x] Test successful deletion.
- [x] Test missing-task update and deletion.
- [x] Return HTTP 200 with JSON after deletion.
- [ ] Document PUT versus PATCH behavior.
- [ ] Decide whether to retain HTTP 200 or use HTTP 204 for deletion.
- [ ] Review duplicated missing-task handling.

## Phase 6 — Filtering, search, and pagination

- [x] Filter by status.
- [x] Filter by priority.
- [x] Combine status and priority filters.
- [x] Search task titles.
- [x] Paginate task results.
- [x] Return pagination metadata and links.
- [x] Test status filtering.
- [x] Test priority filtering.
- [x] Test combined filters.
- [x] Test title search.
- [x] Test pagination.
- [x] Test pagination with filters.
- [ ] Test empty search results and invalid filters.
- [ ] Define and test search case sensitivity.
- [ ] Enforce a maximum `per_page` value.
- [ ] Validate or safely handle invalid query parameters.

## Phase 7 — API consistency and maintainability

- [x] Create and use `TaskResource`.
- [x] Return structured JSON from the implemented endpoints.
- [x] Include task fields in responses.
- [x] Include pagination metadata in list responses.
- [x] Test important response fields.
- [ ] Review response consistency across all endpoints.
- [ ] Review date and timestamp formats.
- [ ] Document final HTTP status code choices.
- [ ] Review production exception handling.
- [ ] Review controllers for duplicated logic and unnecessary complexity.
- [ ] Finalize API documentation in README.

## Phase 8 — Test coverage and quality checks

- [x] Test successful task creation.
- [x] Test task retrieval.
- [x] Test task updates.
- [x] Test task deletion.
- [x] Test missing task records.
- [x] Test key validation failures.
- [x] Test partial updates.
- [x] Test filtering and search.
- [x] Test pagination.
- [x] Run the test suite: 20 tests passed, 116 assertions.
- [ ] Add remaining validation edge-case tests.
- [ ] Add tests for empty results and invalid query parameters.
- [ ] Verify test independence.
- [ ] Run tests again after final changes.
- [ ] Run a formatter or linter if configured.
- [ ] Review unnecessary database queries.

## Phase 9 — Final README and handoff

- [x] Draft the project purpose and feature list.
- [x] Draft the project structure.
- [x] Draft endpoint documentation.
- [x] Draft Task field and query parameter documentation.
- [x] Draft a task creation request example.
- [x] Draft scope and limitations.
- [x] Review PHP and Laravel requirements against `backend/composer.json`.
- [x] Review SQLite configuration against `backend/.env.example`.
- [ ] Verify installation commands on a clean environment.
- [ ] Verify test instructions after final changes.
- [ ] Ensure a new developer can follow the README successfully.
- [ ] Review Git history.
- [ ] Tag a stable release when ready.
- [ ] Commit final README documentation.

## Definition of Done

- [ ] A developer can set up the project using README.
- [ ] Migrations work from a clean database.
- [x] All core CRUD endpoints are implemented.
- [ ] All documented behaviors have sufficient tests.
- [ ] Validation and error responses are documented and predictable.
- [x] Filtering, search, and pagination are implemented and tested.
- [x] The last reported test suite passed.
- [ ] Remaining validation and query parameter edge cases are covered.
- [x] `.env` is configured to be ignored by Git.
- [x] The current version contains no frontend application.

## Out of Scope for v1

- Authentication and user ownership
- Teams, roles, and permissions
- File attachments
- Email/SMS notifications
- Background jobs and queues
- Frontend application
- Microservices or complex service-layer abstractions
