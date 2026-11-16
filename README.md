# Agenda Personal de Contactos

## 1. Descripción del proyecto

Agenda Personal de Contactos es una aplicación web desarrollada en PHP y MySQL que permite a los usuarios registrarse, iniciar sesión y administrar sus contactos personales.

El sistema permite agregar, visualizar, editar y eliminar contactos. Además, implementa mecanismos de autenticación, manejo de sesiones y medidas de seguridad para garantizar que cada usuario pueda acceder únicamente a su propia información.

## 2. Tecnologías utilizadas

- PHP: desarrollo de la lógica de la aplicación.
- MySQL: almacenamiento de usuarios y contactos.
- HTML: estructura de las páginas.
- CSS: diseño y presentación visual.
- XAMPP: entorno de servidor local.
- Visual Studio Code: editor de código.

## 3. Requisitos para su ejecución

- Computadora con Windows.
- XAMPP instalado.
- Apache y MySQL activos.
- Navegador web.
- Visual Studio Code (opcional, para modificar el código).

## 4. Pasos para instalar la aplicación

1. Instalar XAMPP en la computadora.
2. Iniciar los servicios Apache y MySQL desde el panel de control de XAMPP.
3. Copiar la carpeta `agenda_contactos` dentro de la carpeta `htdocs` de XAMPP.
4. Abrir phpMyAdmin desde `http://localhost/phpmyadmin`.
5. Crear la base de datos llamada `agenda_contactos`.
6. Importar el archivo `database.sql` para crear las tablas necesarias.
7. Revisar el archivo `config/conexion.php` y configurar los datos de conexión a MySQL según el entorno.
8. Abrir el navegador y acceder a `http://localhost/agenda_contactos/registro.php`.
9. Registrar un usuario e iniciar sesión para utilizar la aplicación.

## 5. Funcionalidades principales

- Registro de usuarios.
- Inicio y cierre de sesión.
- Agregar contactos.
- Visualizar contactos.
- Editar contactos.
- Eliminar contactos.
- Separación de contactos por usuario.
- Protección de contraseñas mediante hash.
- Consultas preparadas y validación de solicitudes CSRF en las operaciones de contactos.

## 6. Autor

Proyecto académico desarrollado como práctica de PHP, MySQL, autenticación y gestión de información.
