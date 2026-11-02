<<<<<<< HEAD
# student-management
AWAD Student Management System
=======
# Student Management System (Laravel 12)

Coursework Two — **Advanced Web Application Development (BUC3131)**, MUBS 2026/2027.

A web-based system to manage **students, courses, lecturers and course registrations**.
Built with Laravel 12, MySQL, Blade, Tailwind (CDN) and **spatie/laravel-permission** for roles & permissions.
The interface is a plum / teal / cream theme adapted from the campus-portal front-end.

## Features
| Role | What they can do |
|------|------------------|
| **Administrator** | CRUD students and courses, register/remove any student on a course, manage user accounts and roles |
| **Lecturer** | See only the courses assigned to them and the students registered in those courses |
| **Student** | Browse available courses, register / drop, view only their **own** registrations |

* Duplicate registrations are blocked twice: a **unique(student_id, course_id)** key in the database and a check in the controller. Courses also stop accepting students when full.
* Routes are protected with `auth` and `permission:*` middleware; controllers add record-level checks (a student cannot drop someone else's registration, a lecturer cannot open someone else's course).
* Navigation links and action buttons are shown with `@can` / `@canany`.

## Requirements
PHP 8.2+, Composer, MySQL (XAMPP / WAMP / Laragon is fine). Node is **not** needed (Tailwind and icons load from CDNs, so you need internet when viewing pages).

## Installation
```bash
# 1. install PHP packages
composer install
composer require spatie/laravel-permission      # role & permission package (if not already installed)

# 2. environment file
cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate

# 3. create an empty MySQL database called  student_management_system
#    (phpMyAdmin -> New, or: mysql -u root -e "CREATE DATABASE student_management_system")
#    then check DB_USERNAME / DB_PASSWORD in .env

# 4. create tables + sample data
php artisan migrate --seed

# 5. run
php artisan serve           # open http://127.0.0.1:8000
```
> Do **not** run `php artisan vendor:publish` for the permission package — its tables are already in
> `database/migrations/2026_10_31_000001_create_permission_tables.php`.

To start again from scratch: `php artisan migrate:fresh --seed`.
The seeders use `updateOrCreate` / `firstOrCreate`, so running `php artisan db:seed` twice never creates duplicates.

### Using SQLite instead of MySQL
In `.env` set `DB_CONNECTION=sqlite`, remove the other `DB_*` lines, run `touch database/database.sqlite`, then `php artisan migrate --seed`.

## Sample login credentials
All sample accounts use the password **`password`**.

| Role | Email |
|------|-------|
| Administrator | admin@sms.test |
| Lecturer | lecturer1@sms.test (BUC3131, BUC3112) · lecturer2@sms.test (BBC3127, BUC3105) |
| Student | student1@sms.test … student6@sms.test |

## Database design
```
users ──1:1── students ──< course_registrations >── courses ──> users (lecturer_id)
```
* `students` (user_id FK, student_number unique, name, email unique, phone, programme, year_of_study)
* `courses` (code unique, title, description, credit_units, capacity, lecturer_id FK → users)
* `course_registrations` (student_id FK, course_id FK, registered_at, **unique(student_id, course_id)**)
* Spatie tables: `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions`

Relationships (`app/Models`)
* `User` hasOne `Student`, hasMany `Course` (`taughtCourses`)
* `Student` belongsTo `User`, belongsToMany `Course`, hasMany `CourseRegistration`
* `Course` belongsTo `User` (lecturer), belongsToMany `Student`, hasMany `CourseRegistration`
* `CourseRegistration` belongsTo `Student`, belongsTo `Course`

Eloquent examples: `$student->courses` (a student's courses) and `$course->students` (students on a course).

## Roles & permissions (seeded in `RolesAndPermissionsSeeder`)
* **admin** – all permissions
* **lecturer** – `view assigned courses`
* **student** – `view courses`, `view own registrations`, `register courses`

## Project structure (main files)
```
app/Http/Controllers   Auth/AuthController, StudentController, CourseController,
                       RegistrationController, DashboardController, Admin/UserController
app/Models             User, Student, Course, CourseRegistration, Contact
database/migrations    permission tables, students, courses, course_registrations
database/seeders       RolesAndPermissions, User, Course, Student, Registration
resources/views        layouts/ (main, header, footer), partials/flash, components/page-header,
                       auth/, students/, courses/, registrations/, admin/users/
routes/web.php         all routes + middleware
tests/Feature/SmsTest  automated tests (php artisan test)
```

## Tests
`php artisan test` — checks seeding, login, role access, duplicate prevention, relationships and CRUD.

## GitHub workflow (group requirement)
* `main` = stable, `develop` = integration; each member works on `feature/<name>` and opens pull requests into `develop`.
* Fill in `CONTRIBUTION_REPORT.md` with your group members, branches, pull requests and tasks.

## Screenshots
Add screenshots of the running application to `docs/screenshots/` and list them here
(login, admin dashboard, students, courses, registrations, student view, lecturer view).
>>>>>>> d3965e6 (save remaining local changes)
