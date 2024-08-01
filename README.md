
# Work Up Backend

<details>
  <summary>Contenido 📝</summary>
  <ol>
    <li><a href="#Objetivo🎯">Objetivo🎯</a></li>
    <li><a href="#Sobre-el-proyecto📰">Sobre el proyecto 📰</a></li>
    <li><a href="##Stack ✨">Stack ✨</a></li>
    <li><a href="##Diagrama BD 🌐">Diagrama BD 🌐</a></li>
    <li><a href="##Instalaciónenlocal 💻"> Instalación en local 💻</a></li>
    <li><a href="##Endpoints 🎢">Endpoints 🎢</a></li>
    <li><a href="##Futurasfuncionalidades ✅">Futuras funcionalidades ✅</a></li>
    <li><a href="##Webgrafia 👓">Webgrafia 👓</a></li>
    <li><a href="##Compañerosdeequipo 🐱‍👤:"> Compañeros de equipo 🐱‍👤:</a></li>    
  </ol>
</details>

## Objetivo🎯

Este proyecto requería una API funcional conectada a una base de datos en la que simule un entorno laboral en el que los projects managers asocian a trabajadores con proyectos, y dentro de estos, les asignan tareas individualmente.

## Sobre el proyecto 📰

Esta herramienta de organización de equipos de trabajo, permite crear editar y borrar tanto usuarios, como proyectos y tareas. También se pueden dejar comentarios en las tareas. Además todas estas funciones cuentan con validaciones que aseguren que cada usuario solo puede interaccionar con proyectos o tareas a las que se le haya asociado.

## Stack ✨

Tecnologías utilizadas:

<div align="center">
<a href="">
    <img src= "https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white"/>
</a>
<a href="https:">
    <img src= "https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
</a>
<a href="https://">
    <img src= "https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
</a>

<a href="https://">
    <img src= "https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white"/>
</a>
<a href="https://">
    <img src= "https://img.shields.io/badge/GIT-E44C30?style=for-the-badge&logo=git&logoColor=white
    "/>
</a>
 </div>

## Diagrama BD 🌐

![alt text](<img/Diagrama WorkUp.png>)

La estructura de la base de datos y sus relaciones posicionan a la tabla usuarios como la tabla principal, siendo proyectos la siguiente en la que se engloban las tareas. Todo usuario debe pertenecer a un proyecto para poder asignársele tareas.

Se ha utilizado el framework Laravel en su versión mas reciente con migraciones y seeders para el manejo de la base de datos.



## Instalación en local 💻

Nota: para este proyecto será necesario tener instalado en local PHP y Composer

<a href="https://www.php.net/manual/en/install.php"> Descarga PHP </a>

<a href="https://getcomposer.org/download/"> Descarga Composer </a>

1. Crear container docker con el puerto que se desee para la base de datos y clonar el repositorio.
2. Instalamos dependencias
   `$ composer install`
3. Conectamos nuestro repositorio con la base de datos, para ello creamos el archivo .env copiando los datos de .env.example y rellenamos los campos con la conexión a nuestra base de datos en local.
4. Ejecutamos las migraciones
   `$ php artisan migrate`
5. Ejecutamos los seeders
   ` $ php artisan db:seed`
6. Iniciamos el servidor
   `$ php artisan serve`
7. ...

## Funciones

- Login con validación, hasheo de contraseña y creación de token
- Logout
- Crear, editar y borrar usuarios.
- Crear, editar y borrar proyectos.
- Crear, editar y borrar tareas.
- Traer proyectos de un usuario
- Marcar tara como completada
- Añadir usuario a Proyecto (project managers o admin)
- Crear comentarios en tareas (solo si el usuario la tiene asignada o es project manager)
- Hacer project manager a usuario (project managers)
- Hacer superadmin o bajar rol o otros usuarios (admin)



## Webgrafia 👓

Para conseguir mi objetivo he recopilado información de:

-   <a href="https://laravel.com/docs/9.x/"> Laravel 9.x </a>