# Peer Tutoring Hub — Laravel MVC Demo

A small classroom demonstration connecting the familiar Peer Tutoring Hub
form to Laravel’s Model–View–Controller structure.

Built with Laravel 12, PHP, Blade templates, and SQLite.

## What the demo does

- Displays a tutoring request form.
- Validates course, description, topics, preferred date, and preferred time.
- Preserves entered values after validation errors.
- Saves accepted requests to SQLite.
- Lists submitted requests and displays individual request details.
- Returns a 404 response for an unknown request ID.

## Run in GitHub Codespaces

Create a Codespace from this repository.

In the terminal, run:

```bash
cd app
composer install
```

For the first setup, create the environment file:

```bash
cp -n .env.example .env
```

Set the application URL to this Codespace’s forwarded port address:

```bash
sed -i "s|^APP_URL=.*|APP_URL=https://${CODESPACE_NAME}-8000.${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN:-app.github.dev}|" .env
```

Prepare the application:

```bash
php artisan config:clear
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

Start the server:

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Open the Ports panel and select Open in Browser for port 8000.

For later sessions in the same Codespace, run:

```bash
cd app
php artisan serve --host=0.0.0.0 --port=8000
```

## MVC structure

All paths below are relative to the Laravel `app` folder.

| Responsibility | File | Purpose |
|---|---|---|
| Routes | `routes/web.php` | Map HTTP methods and URLs to controller actions |
| Model | `app/Models/TutoringRequest.php` | Represent and persist tutoring requests |
| Controller | `app/Http/Controllers/TutoringRequestController.php` | Validate input and coordinate models and views |
| Shared layout | `resources/views/layouts/app.blade.php` | Provide common page structure and navigation |
| Form view | `resources/views/requests/create.blade.php` | Collect input and display validation errors |
| List view | `resources/views/requests/index.blade.php` | Display saved requests |
| Details view | `resources/views/requests/show.blade.php` | Display one saved request |
| Migration | `database/migrations/*_create_tutoring_requests_table.php` | Define the tutoring requests table |

The model uses Laravel’s Eloquent ORM. Its casts convert topics between
an array and database JSON, and the preferred date into a date object.

## Request flow

1. The browser submits `POST /requests`.
2. The route calls `TutoringRequestController::store()`.
3. The controller validates the submitted input.
4. The `TutoringRequest` model creates a SQLite record.
5. The controller redirects to `/requests/{id}`.
6. Laravel resolves the saved record through route model binding.
7. The controller passes it to the details view.
8. Blade renders the response.

## Suggested classroom walkthrough

1. Open the request form.
2. Submit a complete request using today or a future date.
3. Inspect the confirmation and details page.
4. Open the request list and select the saved request.
5. Submit a form with no topics to demonstrate server validation.
6. Submit a past date to demonstrate a business rule.
7. Trace the route, controller, model, migration, and view in the editor.

The date field permits selecting a past date so the server-side rule can
be demonstrated.

## Validation rules

| Field | Rule |
|---|---|
| Course | IS 6465, IS 6495, or IS 6570 |
| Description | 10–500 characters after trimming |
| Topics | At least one of the three allowed topics, with no duplicates |
| Preferred time | Morning, Afternoon, or Evening |
| Preferred date | Valid date of today or later |
| Form identifier | Must equal `tutoring_request` |

Date validation follows the application’s America/Denver timezone.

## Connections to Lab 4

| Lab 4 concept | Laravel equivalent |
|---|---|
| Shared PHP includes | Blade layout |
| Request form page | Blade form view |
| Processing PHP page | Controller action |
| Manual validation checks | Laravel validation rules |
| Request identifier in a URL | Route parameter and model binding |
| Database operations | Eloquent model and SQLite migration |

## Demo scope

This is a shared classroom application. Everyone using the same running
instance can view its requests. Use fictional request content.

Requests persist in the SQLite file in that Codespace. A new Codespace
starts with its own database.

The example demonstrates request creation and reading. Authentication,
authorization, scheduling, updating, and deleting are future extensions.

This is a separate framework demonstration alongside the course’s
existing Lab 7 application.

## Verify database storage

From the Laravel folder:

```bash
php artisan tinker
```

Then:

```php
App\Models\TutoringRequest::count();
```

Exit with:

```php
exit
```

## Troubleshooting

- A localhost connection error usually means the generated URL needs
  updating. Set APP_URL to the current Codespaces port 8000 address,
  clear configuration, and restart the server.
- If port 8000 is unavailable, confirm the server command is still running.
- An Xdebug notice about localhost:9003 indicates no debugging client
  connected. Check the command’s subsequent output for its result.