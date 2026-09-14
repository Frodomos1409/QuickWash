# QuickWash

Sistema de reserva de máquinas de lavandería, desarrollado en Laravel 12 para el curso de Proyecto de Sistemas 3.

## Roles

**Estudiante**
- Registro e inicio de sesión.
- Ver máquinas disponibles.
- Registrar una reserva (máquina, fecha, horario).
- Consultar sus reservas.
- Cancelar una reserva (mínimo 2 horas antes, solo si está `pendiente`).

**Personal**
- Registro e inicio de sesión.
- Ver todas las reservas realizadas.
- Cambiar el estado de una reserva (`pendiente`, `en_proceso`, `finalizada`, `cancelada`).

## Reglas de negocio

- Una máquina no puede tener más de una reserva activa en el mismo horario.
- Cada estudiante puede tener máximo 3 reservas activas (`pendiente`/`en_proceso`).
- Solo las reservas en estado `pendiente` pueden cancelarse, y solo por el propio estudiante.
- El personal solo puede cambiar el estado de una reserva, no editar sus otros datos.

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+ (para compilar los assets con Vite)

## Instalación local

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm run build
php artisan serve
```

Usuarios de prueba creados por el seeder (contraseña `password`):

- `estudiante@quickwash.test` — rol Estudiante
- `personal@quickwash.test` — rol Personal

## Despliegue gratuito

Para desplegar QuickWash sin costo se recomienda separar la app (Render) de la base de datos (Supabase), porque el disco de los planes free de la mayoría de hosts es efímero — usar SQLite ahí haría que los datos se borren en cada redeploy.

### 1. Base de datos: Supabase (Postgres gratis y persistente)

1. Crea un proyecto en [supabase.com](https://supabase.com) (plan Free).
2. En **Project Settings → Database → Connection string**, copia los datos de conexión (host, puerto, usuario, contraseña, nombre de base de datos). Usa el modo *Session pooler* si tu host no soporta IPv6.
3. Nota: un proyecto Free de Supabase se pausa tras ~1 semana sin uso; los datos no se pierden, pero hay que reactivarlo manualmente desde el dashboard si eso pasa.

### 2. Aplicación: Render (Web Service gratis)

1. Entra a [render.com](https://render.com) y crea una cuenta (puedes usar tu GitHub).
2. **New + → Web Service**, conecta el repositorio `Frodomos1409/QuickWash`.
3. Configura:
   - **Runtime**: PHP
   - **Build Command**:
     ```
     composer install --no-dev --optimize-autoloader && npm install && npm run build
     ```
   - **Start Command**:
     ```
     php artisan migrate --force && php artisan config:cache && php artisan serve --host 0.0.0.0 --port $PORT
     ```
4. En **Environment**, agrega estas variables (reemplaza los valores de Supabase):

   | Variable | Valor |
   |---|---|
   | `APP_NAME` | `QuickWash` |
   | `APP_ENV` | `production` |
   | `APP_DEBUG` | `false` |
   | `APP_KEY` | genera uno con `php artisan key:generate --show` y pégalo con el prefijo `base64:` |
   | `APP_URL` | la URL que te da Render (ej. `https://quickwash.onrender.com`) |
   | `DB_CONNECTION` | `pgsql` |
   | `DB_HOST` | host de Supabase |
   | `DB_PORT` | `5432` (o `6543` si usas el pooler) |
   | `DB_DATABASE` | `postgres` |
   | `DB_USERNAME` | usuario de Supabase |
   | `DB_PASSWORD` | contraseña de Supabase |
   | `DB_SSLMODE` | `require` |

5. Despliega. Render instalará dependencias, correrá las migraciones contra Supabase y levantará la app.
6. Si quieres los usuarios y máquinas de ejemplo, corre una sola vez desde la shell de Render (o localmente apuntando a la DB de producción): `php artisan db:seed`.

El plan free de Render "duerme" el servicio tras ~15 minutos sin tráfico; la primera visita después de eso tarda unos segundos en despertar — normal y sin costo.

### Alternativa más simple (un solo clic, sin tarjeta)

[Railway.app](https://railway.app) detecta Laravel automáticamente (Nixpacks) sin necesidad de configurar build/start command, e incluye Postgres con un clic dentro del mismo proyecto. Su plan gratuito es limitado a un monto de uso mensual, pero es la opción más rápida para una demo o entrega.

## Stack

- Laravel 12 + Breeze (Blade)
- Tailwind CSS + Alpine.js
- SQLite en desarrollo / PostgreSQL en producción
