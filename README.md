# Proyecto CRUD de Menús en PHP MVC

Este proyecto es una prueba de un CRUD (Crear, Leer, Actualizar, Eliminar) de menús jerárquicos utilizando PHP con arquitectura MVC, PDO para la base de datos y Bootstrap para la interfaz.

---

## Características

- CRUD completo para gestionar menús y submenús.
- Manejo de menús con niveles anidados ilimitados.
- Validaciones básicas en backend y frontend.
- Uso de modales para crear y editar menús.
- Prevención de eliminación de menús con submenús.
- Interfaz responsiva con Bootstrap.
- AJAX para operaciones sin recargar la página.

---

## Requisitos

- PHP 7.4 o superior.
- Servidor web con soporte para PHP (por ejemplo, XAMPP).
- Base de datos MySQL o compatible.

---

## Instalación y Configuración

1. Clona este repositorio en tu servidor o máquina local.

2. **IMPORTANTE:** La raíz pública del proyecto es la carpeta `public/`.  
   Debido a que tu servidor web no apunta directamente a `/public/`, todas las URLs deben incluir `/public/` en la ruta.  
   Por ejemplo: http://localhost/mi-proyecto/public/menu/index

   
3. Configura la conexión a la base de datos en el archivo de configuración (ejemplo: `app/config/database.php`).

4. Importa la estructura y datos de la base de datos desde el archivo `database.sql` (si tienes uno).

---

## Uso

- Accede a la aplicación desde: http://localhost/mi-proyecto/public/ (en caso de tener el vhost cambiar http://localhost/mi-proyecto/ por el url que se haya puesto )

- Administra los menús desde la sección de administración (`/menu/admin`).

- El menú principal se visualiza en `/` (teniendo encuenta la parte de `/public/`).


## Contacto

Si tienes dudas o sugerencias, puedes contactarme.

