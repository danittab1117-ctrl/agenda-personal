# Agenda Personal de Contactos

## 1. Descripción del proyecto

La Agenda Personal de Contactos es una aplicación web desarrollada en PHP y MySQL que permite a los usuarios registrar, iniciar sesión y administrar sus contactos personales de manera organizada y segura.

Cada usuario puede acceder únicamente a sus propios contactos.

## 2. Tecnologías utilizadas

- PHP
- MySQL
- HTML
- CSS
- XAMPP
- InfinityFree
- GitHub

## 3. Funcionalidades principales

- Registro de usuarios.
- Inicio y cierre de sesión.
- Agregar nuevos contactos.
- Editar y eliminar contactos.
- Buscar contactos por nombre, correo electrónico o ciudad.
- Ordenar contactos por nombre, ciudad y fecha de creación.
- Clasificar contactos por categorías: Familia, Amigos, Trabajo, Universidad y Otro.
- Marcar contactos como favoritos.
- Filtrar los contactos favoritos.
- Protección de acceso mediante sesiones de usuario.

## 4. Requisitos para ejecutar el proyecto

- Tener instalado XAMPP.
- Contar con PHP y MySQL.
- Tener un navegador web.
- Importar el archivo de base de datos `database.sql`.

## 5. Pasos para instalar el proyecto

1. Descargar o clonar el repositorio.
2. Copiar la carpeta del proyecto dentro de `htdocs` de XAMPP.
3. Iniciar Apache y MySQL desde XAMPP.
4. Abrir phpMyAdmin.
5. Crear o importar la base de datos utilizando el archivo `database.sql`.
6. Configurar la conexión a la base de datos en `config/conexion.php`.
7. Abrir el navegador y acceder a:

`http://localhost/agenda_personal/login.php`

## 6. Aplicación publicada en Internet

La aplicación también se encuentra alojada en InfinityFree y puede accederse mediante el siguiente enlace:

http://miagendacontact.free.je/agenda_personal/login.php

## 7. Mejoras implementadas

Se incorporaron nuevas funcionalidades para mejorar la organización y administración de los contactos, como búsqueda, ordenamiento, categorías y favoritos.

También se mejoró el diseño visual mediante CSS y se publicó la aplicación en un servicio de hosting gratuito.

## 8. Base de datos

El proyecto utiliza una base de datos MySQL con las tablas:

- `usuarios`
- `contactos`

La información de cada usuario se administra de forma independiente.

## 9. Autor

Proyecto académico desarrollado como parte de la asignatura de desarrollo web.
