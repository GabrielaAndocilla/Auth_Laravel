## Acerca de este projecto
El proyecto esta enfocado en mostrar como hacer la Autenticación y la Autorización de Usuarios basados en sus roles. 

Se manejará la administración de usuarios dependiendo de su rol, para el proyecto se mostrará 2 roles:
- Administrador : El usuario podrá ver los usuarios existentes, editarlos, crearlos y eliminarlos.
- Estudiante: El usuario podrá entrar al sistema y editar su perfil

Todos los usuarios serán manejados desde una sola tabla de usuarios y serán asignados a sus roles.

Las rutas:
- '/' => Pantalla de inicio con botón de Login
- '/login' => Login de usuarios con rol de estudiantes desde el cuál no podrán ingresar Administradores
- '/admin' => Login de usuarios con rol de Administradores desde el cuál no podrán ingresar estudiantes
- '/usuarios' => Pantalla solo para rol de Administrador donde se puede gestionar los usuarios

### Tech Stack

El proyecto fue realizado con [Laravel 10](https://laravel.com/docs/10.x) usando el [Starter Kit](https://laravel.com/docs/10.x/starter-kits) que provee Laravel.En el caso del front fue hecho con Blades(https://laravel.com/docs/10.x/blade)

Para ejecutar sistema se esta usando:
- Nginx o Apache o cualquier seridor que ejecute php (en este caso [XAMPP](https://www.apachefriends.org/es/download.html))
- PHP 8.0.28
- Node 14.21.2
### Pasos para ejecutarlo

1. Clonar el proyecto `git@github.com:GabrielaAndocilla/Auth_Laravel.git`
2. Ejecutar `composer install`
3. Ejecutar `php artisan key:generate`
4. Crear archivo .env , es importante colocar **las cofiguraciones de la base**
    Ejemplo
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=root
    DB_PASSWORD=
    ```
5. Ejecutar `npm install`
6. Ejecutar `php artisan migrate --seed` antes de ejecutar este comando verificar que la base haya sido creada
7. Si todo fue configurado correctamente el sistema debería ejecurtarse sino porfavor poner TRUE al APP_DEBUG para tener mayor información
8. Ejecutar en una terminal `php artisan serve`
9. Ejecutar en otra terminal `npm run dev` mientras se esta cambiando los estilos del blade ya que esto mantendrá actualizando la importación de los estilos de tailwind. Si ya son los definitivos se puede ejecutar `npm run build`

### Cómo se implementará la autenticación y autorización de usuarios?

Para la autenticación se uso el starter kit con blade siguiendo los pasos que menciona la documentación. [Link a las instructiones](https://laravel.com/docs/10.x/starter-kits#laravel-breeze-installation)

Este kit nos crearan una variedad de archivos los cuales podemos editar o eliminar acorde a nuestras necesidades. En nuestro caso eliminamos algunas vistas, rutas y controladores relacionados a la verificación del correo, el registro y la recuperación de contraseñas.

Para la autorización se sigio la documentación igual de [Laravel](https://laravel.com/docs/10.x/authorization), donde se habla sobre los Gates y Policies. La Autorización la estamos manejando para el manejo de **roles**.

Es interesante el tema de roles en este contexto ya que muchas veces se utiliza los **guards** como método de implementación de roles. Se piensa que los guards son los roles, pero los guard son principalmente es un mecanismo de autenticación , siendo al más amplio que manejo de roles. 

Veamos lo con mayor deteminiento, si revisamos el `config/auth.php` en la sección de los guards, menciona que los guards ** define como los usuarios son obtenidos de la base o de un mecanismo de almacenamiento .**  Si revisamos el guard por default este obtiene los usuarios de la tabla Users que es exactamente lo que queremos para el proyecto por lo que no habría que cambiar. 
Entonces cuándo los usamos?
Los usaríamos si quisiéramos tener dos fuentes diferentes de autenticación por ejemplo si tendríamos dos tablas Administradores los empleados de la empresa y Estudiantes otra entidad diferente con otros atributo y otra tabla diferente.

Puedes revisar estos foro donde se habla del tema:
- https://laracasts.com/discuss/channels/laravel/laravel-guards-vs-gates
- https://stackoverflow.com/questions/57475132/creating-admin-guard-vs-using-the-default-guard-for-both-users-and-admins
