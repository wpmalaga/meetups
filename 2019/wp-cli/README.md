WP-CLI - Automatiza tus tareas y tómate un café
=======

![Image](img/cafe-central.jpg "Café Central Málaga")

Source: https://www.laopiniondemalaga.es/malaga/2015/05/06/cafe-medida-and-cafe-preparacion/763878.html

## Instalar WP-CLI
### Requisitos:

  * Entorno linux o consola Cygwin
  * PHP 5.4. Obligatorio **¡¡7.2!!**
  * WordPress >= 3.7. Obligatorio **¡¡5!!**

Descargamos:

<code>
$ curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

$ php wp-cli.phar --info

</code>

Hay más formas de instalación (Composer, Homebrew, Docker). Revisar la documentación para más info: https://wp-cli.org/

Para ejecutarlo directamente de forma global con el comando <code>wp</code>:

<code>
$ chmod +x wp-cli.phar

$ sudo mv wp-cli.phar /usr/local/bin/wp

$ wp --info

</code>

Actualizar WP-CLI cada vez que lo vayamos a usar:

<code>$ sudo wp cli update</code>

---

## Lista de comandos

<code>https://developer.wordpress.org/cli/commands/</code>

---

## Instalar WordPress

Para ello usaremos los comandos:
 * wp config - https://developer.wordpress.org/cli/commands/config/
 * wp db - https://developer.wordpress.org/cli/commands/db/
 * wp core - https://developer.wordpress.org/cli/commands/core/

<code>
$ wp core download --locale=es_ES

$ wp config create --dbname=cafes --dbuser=fcjurado --dbpass=mysql

$ wp db create

$ wp core install --url=wp-cli.local --title="Café Sombra" --admin_user=admin 
--admin_password=admin --admin_email=info@fcjurado.com

$ wp config list

</code>

> Whoops!! 

---

## Cambiar URL del site
<code>
$ wp option update home 'http://wp-cli.local/wp-cli/sombra/'

$ wp option update siteurl 'http://wp-cli.local/wp-cli/sombra/'
</code>

---

## Actualizar traducciones
<code>
$ wp language core update

$ wp language plugin update --all

$ wp language theme update --all
</code>

---

## Buscar y reemplazar
<code>
$ wp search-replace "cafes.local" "cafes.com" wp_posts --dry-run --verbose

$ wp search-replace "?utm_campaign=paid" "?utm_campaign=affiliate" wp_posts wp_postmeta --dry-run --verbose

</code>

---

## Actualizar core
Instalamos versión antigua de WP:

<code>
$ wp core download --locale=es_ES --version=4.6.1

$ wp config create --dbname=hidromiel --dbuser=fcjurado --dbpass=mysql

$ wp db create

$ wp core install --url=http://wpcli.local/wp-cli/hidromiel/ --title="Hidromiel" --admin_user=admin --admin_password=admin --admin_email=info@fcjurado.com

$ wp core check-update

$ wp core update
</code>

---

## Desactualizar core
<code>
$ wp core download --force --version=4.5

$ wp core update --version=4.5 --force
</code>

---

## Instalar tema
<code>$ wp theme install fury --activate</code>

---

## Actualizar plugins
Instalamos versión antigua de Plugin:

<code>
$ wp plugin install booking --version=8.0.1

$ wp plugin status

$ wp plugin update-all

</code>

---

## Actualizar temas
Instalamos versión antigua de Tema:

<code>
$ wp theme install hestia --version=2.2.0

$ wp theme status

$ wp theme update-all
</code>

---

## Crear usuarios desde CSV

<code>$ wp user import-csv </code>

---


## Limpiar la caché

---

## Realizar copia de seguridad

<code>
$ wp db export backup.sql
$ wp db import backup.sql

---

## Restaurar copia de seguridad

---

## Exportar contenido

---

## Importar contenido

---

## Crear contenido random
<code>$ wp post generate --count=10</code>
<code>$ wp post generate --count=10 --post_type=page</code>
<code>$ curl "https://baconipsum.com/api/?type=meat-and-filler&paras=10&format=html" | wp post generate --count=50 --post_content</code>

---

## Test de velocidad

---

## Optimizar base de datos

<code>$ wp db optimize</code>

<code>$ wp db repair</code>

---


## Consola MySQL

<code>$ wp db cli</code>

---

## Regenerar thumnails

<code>$ wp media regenerate </code>

---

## Extensiones
<code>$ wp package list </code>

<code>$ wp package install _package_ </code>

---

### Renombrar prefijo de la base de datos

<code>$ wp package install iandunn/wp-cli-rename-db-prefix</code>

<code>$ wp rename-db-prefix cafe_solo_</code>

---

### WP-SEC

WP-SEC es una extensión que realiza chequeo de vulnerabilidades con wpvulndb.com
<code>
$ wp package install markri/wp-sec

$ wp wp-sec check
</code>

---


## WooCommerce
---