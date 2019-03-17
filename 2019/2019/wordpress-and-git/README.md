# Creando un tema WordPress colaborativo usando Git

1. [Introducción](#introduccion)
2. [Configurando mi entorno de desarrollo](#configurando-mi-entorno-de-desarrollo)
3. [Fundamentos para la creación de temas WordPress](#fundamentos-para-la-creacion-de-temas-WordPress)
4. [Empezando con Git](#fundamentos-de-git)
5. [Creando tu Tema usando Git y GitHub paso a paso](creando-tu-tema-usando-git.-paso-a-paso)

## Introducción

En este taller crearemos un tema básico para WordPress aplicando un control de versiones con Git para que pueda ser mejorado en equipo como punto de partida para tener un tema propio para la comunidad de WordPress Málaga.

Git es un sistema de control de versiones que permite acceder a un histórico de todas las modificaciones en el código, pudiendo trabajar tanto individualmente en un entorno local como en equipo de manera inteligente y rápida.

En el taller:

- Aprenderás cómo configurar un entorno de desarrollo para crear un tema WordPress, cuáles son los aspectos fundamentales para la creación de temas y qué ventajas te ofrece Git y cómo puede mejorar tu flujo de trabajo.

- Conoceremos los principales comandos de Git y cómo utilizar alguna de las interfaces gráficas multiplataforma que existen para su gestión.

- Daremos una serie seguir de pautas y buenas prácticas para aprovechar todo su potencial y disfrutar de una experiencia única de trabajo colaborativo contribuyendo a proyectos de otros desarrolladores/diseñadores o compartiendo tus propios proyectos.

Sean cuales sean tus conocimientos y seas o no desarrollador, Git es una potente herramienta que puede suponer un antes y un después en tu trabajo.

**¡Anímate a participar con otros miembros de la comunidad!**

Nota: Aunque el sistema de control de versiones que emplea WordPress en su core, plug-ins y temas es Subversion (SVN), usaremos Git por ser una herramientas más extendida.

## Configurando mi entorno de desarrollo

Si no dispones ya de un entorno de desarrollo en WordPress, sigue los siguientes pasos.

### Instalación de Visual Studio Code

**Visual Studio** Code es un editor de código abierto y gratuito, optimizado para el desarrollo y la depuración de aplicaciones web modernas, multi-lenguaje, con integración con Git, extensible y customizable.

Descarga e instala [Visual Studio Code](https://code.visualstudio.com/#alt-downloads) en tu equipo.

### Instalación de un servidor local

Para crear un entorno de desarrollo local de WordPress necesitarás un servidor con arquitectura AMP (Apache, MySQL/MariaDB y PHP). Existen distintas opciones: instalando una distribución que contenga Apache, MySQL y PHP, empleando una máquina virtual como VirtualBox con Vagrant o haciendo uso de contenedores con Docker.

Para este taller haremos uso de **XAMPP**, un paquete de software libre que consiste principalmente en el sistema de gestión de bases de datos MySQL, el servidor web Apache y los intérpretes para lenguajes de script PHP y Perl. El nombre es en realidad un acrónimo: X - para cualquiera de los diferentes sistemas operativos, Apache, MariaDB/MySQL, PHP, Perl.

Descarga e instala [XAMPP de apachefriends.org](https://www.apachefriends.org).

### Iniciando el servidor local e instalando WordPress

Ejecuta la aplicación XAMPP e inicia los servicios **Apache y MySQL** en el XAMPP Control Panel para arrancar el servidor local.

El primer paso será crear una nueva **base de datos**. Para ello, haz clic en el botón "Admin" de MySQL o escribe en la barra de direcciones de tu navegador `http://localhost/phpmyadmin/` para ejecutar phpMyAdmin.

Crearemos un nuevo **usuario** al que otorgaremos permisos para una nueva base de datos con el mismo nombre. Para ello haz clic en 'Cuentas de usuarios' y pulsa en 'Agregar cuenta de usuario'. Elige un nombre de usuario, por ejemplo `wordpress` y una contraseña. Temporalmente utilizaremos el nombre de usuario como contraseña `wordpress` pero ten en cuenta que se trata sólo de un servidor local. Nunca utilices nombre de usuario y contraseñas inseguras en otros entornos. Marca la casilla 'Crear base de datos con el mismo nombre y otorgar todos los permisos' y pulsa en continuar.

Descarga la última versión de [WordPress](https://es.wordpress.org/download/) y descomprime el paquete si aún no lo has hecho. Copia la carpeta `wordpress` y pégala en el directorio `xampp/htdocs`.

Renombra el archivo `wp-config-sample.php` con el nombre `wp-config.php` y ábrelo en tu editor de texto para completar, al menos, los siguientes datos por los de tu nueva base de datos:

```php
// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'nombredetubasededatos');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'nombredeusuario');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'contraseña');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

```

Es recomendable modificar los siguientes valores en entornos de producción para incrementar la seguridad de tu instalación:

```php
/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'pon aquí tu frase aleatoria'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';
```

Ejecuta el script de instalación de WordPress accediendo a `http://localhost/wordpress/wp-admin/install.php` en tu navegador web y completa el formulario que aparece.

¡Eso es todo! WordPress ya debe estar instalado y puedes acceder al panel de administración en `http://localhost/wordpress/wp-admin`

Consulta la [Guía oficial de instalación de WordPress](https://codex.wordpress.org/Installing_WordPress), también disponible en [español](https://codex.wordpress.org/es:Instalando_Wordpress) para obtener información detallada y consultar errores comunes en la instalación.

## Fundamentos para la creación de temas WordPress

Un **tema de WordPress** define la apariencia de una web y está formado por un conjunto de archivos HTML, PHP, CSS y JavaScript que determinan el diseño de cada página y publicación.

Cada tema de WordPress está compuesto necesariamente al menos por dos archivos:

- **style.css**. Además de ser el archivo donde definiremos los estilos del tema, es donde especificaremos los parámetros principales del mismo.
- **index.php**. Es el archivo principal del tema que se utilizará como plantilla base y controla el modo en que las paginas del sitio generan la información desde tu base de datos de WordPress para ser mostrada en el sitio.

Opcionalmente, podremos añadir un fichero de funciones (**functions.php**), varios ficheros de plantillas, etc. como parte de los ficheros del tema.

Finalmente, para que un tema aparezca en la sección correspondiente de un sitio WordPress y poder activarlo, debemos añadirlo al directorio por defecto: `wp-content/themes`.

WordPress incluye además un tema por defecto en cada nueva instalación. Puedes examinar los ficheros de este tema para hacerte una idea de como construir tus propias plantillas.

## Fundamento de Git

**Git** es el sistema de control de versiones distribuido más extendido en la actualidad. Desarollado por la comunidad Linux en 2005 para ofrecer una herramienta propia para el control de versiones, rápida y eficiente para grandes proyectos, con un importante sistema de ramificación y completamente distribuida.

La principal diferencia entre Git y cualquier otro sistema de control de versiones (VCS) es cómo Git modela sus datos. Mientras los demás sistemas almacenan la información como un conjunto de archivos y las modificaciones hechas sobre cada uno de ellos a lo largo del tiempo, Git gestiona los datos creando un **conjunto de instantáneas** de los archivos a lo largo del tiempo generando una referencia a cada instantánea.

Esta referencia es identificada mediante una suma de comprobación o **checksum** conocida como **hash SHA-1**. Se trata de una cadena de 40 caracteres hexadecimales (0-9 y a-f) calculada en base a los contenidos del archivo o estructura de directorios.

Un hash SHA-1 tiene esta pinta: `24b9da6552252987aa493b52f8696cd6d3b00373`

Git guarda la información no por nombre de archivo, sino por el valor hash de sus contenidos. Así, no puedes perder información o modificar un archivo o directorio sin que Git lo detecte. Esta funcionalidad está integrada al más bajo nivel y es parte integral de su filosofía.

La mayoría de las operaciones en Git tienen lugar en el **repositorio local**. Así, para navegar por la historia de un proyecto, Git simplemente leerá la información directamente de tu base de datos local.

Un proyecto de git local contiene tres áreas principales:

- El **directorio de Git** es donde Git almacena los metadatos y la base de datos de objetos para tu proyecto.

- El **directorio de trabajo** es una copia de una versión del proyecto sobre la que puedes realizar modificaciones.

- El **área de preparación** o índice almacena información acerca de lo que va a ir en tu próxima confirmación.

No obstante, en general, trabajaremos con un repositorio local en nuestro ordenador y un **repositorio remoto** en la nube, alojado en servicios como GitHub, GitLab, Bitbucket, etc.

### Instalación de Git

Accede a la [sección de descargas de Git](#https://git-scm.com/downloads) y selecciona la versión para tu sistema operativo.

- Para **Windows**, ejecutamos el instalador y elegimos las opciones por defecto hasta finalizar el proceso de instalación.

- Para obtener la última versión estable en **Debian/Ubuntu** abrimos nuestro terminal y ejecutamos:

    ```sh
    apt-get install git
    ```

- Si tienes **Mac OS X**, la opción más sencilla es usar el instalador gráfico de Git y seguir las instrucciones que te indique.

Puedes leer la documentación sobre la [instalación de Git](#https://git-scm.com/book/es/v1/Empezando-Instalando-Git).

### Creando un repositorio remoto

Los repositorios remotos son versiones de tu proyecto alojadas en un servidor externo. La mayoría de desarrolladores utilizan servicios como GitHub, BitBucket o GitLab para alojar sus repositorios.

En el taller emplearemos **GitHub**, una plataforma de desarrollo colaborativo donde podemos alojar nuestros proyectos utilizando el sistema de control de versiones Git.

Empieza creando una nueva cuenta en [GitHub](https://github.com/), si no dispones ya de una.

Accede a tu perfil y crea un nuevo repositorio en la pestaña **Repositories**. Haz clic en **New** y rellena el formulario que aparece, indicando el nombre de tu repositorio. Ten en cuenta que utilizaremos este nombre como nombre del tema, por lo que es recomendable que usar minúsculas y no emplear espacios ni caracteres no permitidos (GitHub se encargará de reemplazarlos en caso de que los utilices). Añade una breve descripción y si es un repositorio público o privado. Selecciona crear tu repositorio con un documento README, en 'Add .gitignore' mantén seleccionada la opción None y como 'Licencia' selecciona GNU General Public License v3.0.

¡Enhorabuena! Ya tienes tu primer repositorio remoto.

### Configuración de Git

Una vez instalado git y creado tu repositorio local, definiremos un nombre de usuario y una dirección de correo global con los que identificar nuestros cambios y distinguirlos de los realizados por otros usuarios. Como nombre de usuario puedes elegir el mismo de GitHub y como correo tu nombre de usuario de GitHub seguido de @users.noreply.github.com:

```sh
git config --global user.name "Nombre de Usuario"
git config --global user.email nombredeusuario@users.noreply.github.com
```

Igualmente, `git config` te permite obtener y establecer otras variables de configuración que controlan el aspecto y funcionamiento de Git como el editor de texto por defecto, la herramienta para mostrar las diferencias entre archivos, etc.

Una vez realizada la configuración ya puedes comenzar a realizar cambios en tu repositorio.

## Creando tu Tema usando Git. Paso a paso

1. Crea un nuevo directorio donde descargar tu repositorio remoto y ejecuta `git clone url-de-tu-repositorio` para clonarlo.
    Aparecerá el mensaje: Clonning into 'nombre-de-tu-repositorio'

    Si accedes al directorio podrás encontrar una nueva carpeta `.git` que contiene todos los archivos necesarios para el control de versiones de tu repositorio.

2. Crea un nuevo fichero `style.css` empleando la siguiente estructura por defecto y e incluye la información de tu tema.

    ```css
    /* style.css */
    /*
    Theme Name: Nombre del tema
    Theme URI: Web del tema
    Author: Tu nombre
    Author URI: Tu web
    Description: Una descripción de tu tema
    Version: Número de versión (opcional)
    License: GNU General Public License v3
    License URI: http://www.gnu.org/licenses/gpl-3.0.html
    Text Domain: theme-text-domain
    Tags: Lista de etiquetas que definen tu tema (opcional)
    Template: Nombre del template del tema padre (opcional)
    */
    ```

3. Ejecuta `git status` para comprobar el estado del repositorio:

    ```bash
    On branch master

    No commits yet

    Untracked files:
    (use "git add <file>..." to include in what will be committed)

            style.css

    nothing added to commit but untracked files present (use "git add" to track)
    ```

4. Ejecuta `git add style.css` para incluir el nuevo fichero de estilos y comenzar el seguimiento de este archivo (staging). Si vuelves a ver el estado del proyecto con `git status`, verás que el archivo está siendo rastreado y está preparado para ser confirmado:

    ```bash
    On branch master

    No commits yet

    Changes to be committed:
    (use "git rm --cached <file>..." to unstage)

            new file:   style.css
    ```

5. Podemos ahora confirmar las modificaciones efectuadas y hacer commit de nuestros cambios. Al hacer commit, se guardará en el historial la versión del archivo `style.css`. Para ello ejecutamos `git commit -m "Configuración inicial de mi tema WordPress"`, y obtenemos:

    ```bash
    [master (root-commit) af34319] Configuración inicial de mi tema WordPress
    1 file changed, 13 insertions(+)
    create mode 100644 style.css
    ```

6. Crea un nuevo archivo `index.php` con el siguiente contenido:

    ```php
    <?php /* Main Template File*/ ?>

        <?php get_header(); ?>

        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

            <?php if ( have_posts() ) : ?>
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                <?php /* HTML5 article */ ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                        </header><!-- .entry-header -->
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-summary -->
                        <footer class="entry-meta">
                            <?php the_time(get_option('date_format')); ?>
                        </footer><!-- .entry-meta -->
                    <?php /* Close up the article */ ?>
                    </article>

                <?php endwhile; ?>
            <?php endif; ?>

            </div>
        </div>

        <?php get_sidebar(); ?>
        <?php get_footer(); ?>
    <?php /* End Main Template File*/ ?>
    ```

7. Ejecuta `git add index.php` para incluir el nuevo fichero y comprueba con `git status` que se ha añadido correctamente.

8. Confirma las modificaciones con `git commit -m "Añadiendo index.php"`.

    ```bash
    [master dae66fe] Añadiendo index.php
    1 file changed, 34 insertions(+)
    create mode 100644 index.php
    ```

9. Revisa ahora el historial de modificaciones que se han llevado a cabo. Para ello puedes usar el comando `git log --oneline` y obtendrás una salida similar a esta con información sobre los commit realizados. Si utilizas simplemente `git log` encontrarás más información sobre cada uno de los commits realizados:

    ```bash
    dae66fe (HEAD -> master) Añadiendo index.php
    af34319 Configuración inicial de mi tema WordPress
    ```

10. ¡Ya has creado tu primer tema básico! Súbelo al directorio `wp-content/themes` y actívalo desde el panel de administración de WordPress.

11. Desde aquí puedes continuar añadiendo estilos y nuevos templates y funciones a tu tema.

12. Por último, sube tu historial de cambios al repositorio remoto ejecutando `git push`.
