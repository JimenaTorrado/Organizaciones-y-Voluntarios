# Organizaciones y Voluntarios

Aplicación web hecha con Laravel para registrar **organizaciones** y **voluntarios** y vincularlos entre sí. Un voluntario puede pertenecer a varias organizaciones, y en cada una tiene un rol (Voluntario, Coordinador, Asistente o Administrador).

## Funcionalidades

- Inicio de sesión y registro de usuarios.
- Dashboard con el total de organizaciones, voluntarios y vínculos.
- CRUD de organizaciones (crear, ver, editar y eliminar).
- CRUD de voluntarios, con foto opcional.
- Vincular voluntarios a organizaciones, desde la ficha de la organización (eligiendo el rol) o desde el formulario del voluntario.

## Tecnologías

- PHP 8.3+ y Laravel 13
- SQLite (por defecto) o MySQL
- Blade + AdminLTE 3 para el panel, Bootstrap 5 para las páginas de login
- Pest para los tests

## Instalación

```bash
composer install
cp .env.example .env          # en Windows: copy .env.example .env
php artisan key:generate
php artisan migrate --seed    # crea las tablas y datos de prueba
php artisan storage:link      # para que se vean las fotos de los voluntarios
npm install
npm run build
php artisan serve
```

Abre http://localhost:8000 y entra con:

- **Correo:** `test@example.com`
- **Contraseña:** `password`

Si cambias las migraciones, vuelve a crear la base de datos con `php artisan migrate:fresh --seed` (borra todos los datos).

## Tests

```bash
php artisan test
```

## Estructura principal

| Qué | Dónde |
|---|---|
| Rutas | `routes/web.php` |
| Controladores | `app/Http/Controllers/OrganizationController.php`, `VolunteerController.php` |
| Validaciones | `app/Http/Requests/` |
| Modelos | `app/Models/Organization.php`, `Volunteer.php`, `OrganizationVolunteer.php` (tabla intermedia) |
| Migraciones | `database/migrations/` |
| Datos de prueba | `database/factories/` y `database/seeders/DatabaseSeeder.php` |
| Vistas | `resources/views/organizations/`, `resources/views/volunteers/` y `resources/views/layouts/admin.blade.php` |
