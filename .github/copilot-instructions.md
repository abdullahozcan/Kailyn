# Copilot Instructions for Kailyn Framework

## Build, Test, and Lint Commands

- **Install dependencies:**
  ```bash
  composer install
  ```
- **Run development server:**
  ```bash
  php tulpar fly
  # or
  php -S localhost:8000 -t public
  ```
- **Generate code (scaffolding):**
  ```bash
  php tulpar make:model ModelName
  php tulpar make:controller ControllerName
  ```
- **Testing:**
  PHPUnit is referenced in dependencies, but no test directory or scripts are present by default. If tests are added, run:
  ```bash
  ./vendor/bin/phpunit [TestFile.php]
  ```

## High-Level Architecture

- **Entry Point:**
  - `public/index.php` loads `core/Kernel.php`, which loads configs, environment, and routes.
- **Routing:**
  - Defined in `route/api.php` using the `Core\Router` class. Maps HTTP methods and paths to controller actions or closures.
- **Controllers:**
  - Located in `app/Controllers/`. Extend `Core\Controller`. Handle requests and responses.
- **Models & ORM:**
  - Located in `app/Models/`. Extend `Core\Model` (PDO-based ORM). Table name is set via `$table` property.
- **Repositories:**
  - Located in `app/Repositories/`. Encapsulate data access logic, use models.
- **Core Components:**
  - `core/` contains framework logic: routing, database, request/response, templates, middleware, etc.
- **Environment:**
  - `.env` and `config/` for environment and app settings. Loaded via `vlucas/phpdotenv`.
- **CLI Tool:**
  - `tulpar` script for code generation and utility commands.

## Key Conventions

- **Autoloading:**
  - PSR-4 autoloading via Composer. `App\` → `app/`, `Core\` → `core/`.
- **Environment Variables:**
  - Use `.env` for DB and app config. Access via `getenv()` or `$_ENV`.
- **Controllers:**
  - Methods map to route actions. Use `Request` and `Response` classes for input/output.
- **Models:**
  - Set `$table` property for DB table. Use inherited ORM methods (`get`, `insert`, `update`, etc).
- **Routing:**
  - Define all routes in `route/api.php` using `$route->get()`, `$route->post()`, etc.
- **Templates:**
  - Use `core/Template.php` for view rendering and caching.
- **Code Generation:**
  - Use `tulpar` CLI for scaffolding models/controllers.

---

This file summarizes build/test commands, architecture, and key conventions for Copilot and future contributors. Would you like to adjust anything or add coverage for other areas (e.g., deployment, advanced usage)?
