# Instrucciones

Bienvenido al mini proyect del nivel 3. En este proyecto estaremos aplicando los conocimientos adquiridos a lo largo del nivel. Sigue las instrucciones de este archivo para completar el proyecto y ten en cuenta que estas mismas se tomarán en cuenta para la evaluación final del proyecto.

## Instrucciones generales

Debes crear un sistema de login. El diseño de la página web está terminado, por lo que tendrás que guiarte de lo que te indica el siguiente FIGMA: [Authentication App](https://www.figma.com/file/ZM0DPZbzK39o3rqwiaOPTD/Authentication-App?type=design&node-id=0-1&mode=design)

## Instrucciones del proyecto

Para este proyecto debes crear una plataforma que permita:

- Crear una nueva cuenta.
- Iniciar sesión con una cuenta existente
- Actualizar los datos de la cuenta con la que inicio sesión.

## Flujo del programa

```
Acción: Registrarse -> Vista: Información Personal (Personal Info)

Acción: Iniciar sesión -> Vista: Información Personal (Personal Info)

Acción: Cerrar sesión -> Vista: Iniciar sesión

Acción: Botón "Edit" -> Vista: Editar información
```

## Consideraciones para la calificación

A continuación te presentaremos los puntos que se tomarán en cuenta para la calificacion del proyecto:

- El diseño debe ser lo más fiel posible al proporcionado en el archivo Figma.
  Los colores, fuentes, tamaños de letra, etc. deben ser los proporcionados en el archivo Figma.
- El proyecto debe ser estructurado de forma que sea fácil de entender y mantener (estructura de carpetas que represente órden).
- El proyecto debe estar en un repositorio en GitHub y el enlace debe ser enviado para su revisión.
- Las contraeñas guardadas deben estar hasheadas o encriptadas con ``` password_hash() ```.
- Al iniciar sesión, se debe corroborar si la contraseña encriptada de la base de datos coincide con la que el usuario ingresa. Se hace con ``` password_verify() ```.
- La base de datos para tu proyecto debe llamarse ``` login_db ```.
- En tu repositorio en GitHub debe estar tu base de datos exportada y esta debe tener los datos de **2 cuentas**. Recuerda que sí o sí debe tener estos datos.

```
- Usuario 1:
    Email: admin@admin
    Contraseña: admin
    Photo: A tu elección
    Name: A tu elección
    Bio: A tu elección
    Phone: A tu elección

- Usuario 2:
    Email: test@test
    Contraseña: test
    Photo: A tu elección
    Name: A tu elección
    Bio: A tu elección
    Phone: A tu elección
```

- El archivo .sql en tu repositorio (base de datos exportada) debe tener el nombre que utilizaste originalmente para tu base de datos en tu programa (login_db). **Esta debes guardarla dentro de una carpeta que se llame "db_exportada"**.

```
/db_exportada   --> Carpeta
    login_db.sql   --> Base de datos exportada (dentro)
```

- El repositorio en GitHub debe tener más de un commit.
- Si existiesen requerimientos extras que se hayan realizado (de la lista de consideraciones opcionales o de tu propia iniciativa), debes dejar una nota en el archivo README.md de tu repositorio en GitHub que especifique uno a uno.

## Consideraciones OPCIONALES que suman puntos:

- El proyecto puede ser desarrollado con Bootstrap 5 u otra libreria CSS de tu preferencia (component UI, tailwind CSS, etc). Para los estilos que no se puedan lograr con alguna de estas librerias, puedes usar CSS puro.
- Hacer el modo oscuro de la aplicación.
- Cumplir con el diseño responsive que se proporcionan en el archivo Figma (para la vista mobile usa 375px, y para la vista desktop,1280px de ancho).
- Alguna otra funcionalidad que le agregues, siempre y cuando respetes el diseño y el resto de funcionalidades ya definidas, también sumarán puntos extras.