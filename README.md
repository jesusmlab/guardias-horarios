# Aplicación de Guardias y Horarios de Profesores

Está aplicación pretende ayudar a las Jefaturas de Estudio de colegios e institutos a gestionar las guardias que cubran las faltas del profesorado.

Se soporta sobre la información previa de los horarios de los profesores, la cual es posible importar desde un fichero XML (Kronos).

También es posible partir desde 0, proveyendo de datos a las tablas auxiliares (Grupos, Cursos, Materias, etc.) y entrando el horario de cada profesor. Está entrada está facilitada por una interfaz que permite arrastrar y soltar los diferentes datos de cada periodo lectivo.

Los turnos de guardia se generan automáticamente a partir de los horarios, tomando de cada uno la actividad Guardia de cada periodo. Estos turnos pueden cambiar para adaptarse a la rotación de los profesores en dichas guardias. Podremos rotar los profesores semanalmente o hacer que cuando un profesor haga una guardia pase automáticamente al final de su turno.

El uso siempre estará precedido por una autenticación en la misma. Existen dos Roles: profesor o administrador. El primero será con el que pueden entrar todos los profesores y solo tendrán acceso a ver las guardias del día, los turnos de guardia y los horarios de profesores, aulas y grupos para consultarlos.

EL acceso de administrador (Jefes de estudio y Director) permite el acceso a todo lo demás, a saber:

- Mantener las faltas de profesores y sus causas
- Mantener todas las tablas de la aplicación
- Efectuar la rotación de turnos de guardia
- Sacar un informe de las faltas
- Ver las faltas en un calendario filtradas por su causa
- Generar Horarios a PDF
- Importar datos desde ficheros XML.

# Tecnologia utilizada en esta aplicación

- Servidor LAMP o WAMP (Linux/Windows Apache2 Mysql/MariaDB y PHP)
- Framework Codeigniter 3.3
- Grocery CRUD
- Bootstrap 3
- Jquery 3.1
- TCPDF

# Instalación

La instalación es la típica de una aplicación LAMP, basta con copiar la aplicación en una carpeta de nuestro servidor WEB, crear la BBDD con el script guardias.sql y ya está.

Se recomienda crear un usuario diferente s root en la BBDD (**guardias_user**, por ejemplo) con privilegios totales sobre la BBDD de guardias

Hay que configurar el fichero **application/config/config.php** con las credenciales de acceso a la BBDD.

Debemos asegurarnos de que en nuestro PHP tenemos activada la opcion short_open_tag, asi como que esté cargado el módulo de PHP xml-php

En el fichero **.htaccess** del raiz, hay que modificar el nombre de la carpeta en la que hemos puesto nuestra aplicación. Por defecto es _guardias_

Esta aplicación funciona redirigiendo todas las peticiones (excepto algunas) al fichero index.php del raiz mediante la sobreescritura de la URL, por lo que nos aseguraremos de que nuestro apache tenga instalado y activo dicho módulo (mod_rewrite).

En el inicio hay un usuario **Profesor** y otro **admin**, con las claves _prf123456_ y _adm123456_ respectivamente.
