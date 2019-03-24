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

```
$ curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
$ php wp-cli.phar --info
```

Hay más formas de instalación (Composer, Homebrew, Docker). Revisar la documentación para más info: https://wp-cli.org/

Para ejecutarlo directamente de forma global con el comando ```wp```:

```
$ chmod +x wp-cli.phar
$ sudo mv wp-cli.phar /usr/local/bin/wp
$ wp --info
```

Actualizar WP-CLI cada vez que lo vayamos a usar:

```$ sudo wp cli update```



## Lista de comandos

```https://developer.wordpress.org/cli/commands/```



## Instalar WordPress

```
$ wp core download --locale=es_ES

$ wp config create --dbname=cafes --dbuser=fcjurado --dbpass=mysql

$ wp db create

$ wp core install --url=wp-cli.local --title="Café Sombra" --admin_user=admin --admin_password=admin --admin_email=wpcli@fcjurado.com

$ wp config list
```



## Cambiar URL del site, nombre y descripción del blog

```
$ wp option update home 'http://wp-cli.local/wp-cli/sombra/'

$ wp option update siteurl 'http://wp-cli.local/wp-cli/sombra/'

$ wp option update blogname 'A cup of café con leche'

$ wp option update blogdescription 'in Plaza Mayor'
```



## Cambiar idioma

```
$ wp language core install fi

$ wp site switch-language fi
```



## Actualizar traducciones

```
$ wp language core update

$ wp language plugin update --all

$ wp language theme update --all
```



## Buscar y reemplazar

```$ wp search-replace "cafes.local" "cafes.com" wp_posts --dry-run --verbose

$ wp search-replace "ipsum" "latte" wp_posts wp_postmeta --dry-run --verbose

$ wp search-replace "?utm_campaign=paid" "?utm_campaign=affiliate" wp_posts wp_postmeta --dry-run --verbose
```



## Actualizar core

Instalamos versión antigua de WP:

```
$ wp core download --locale=es_ES --version=4.6.1

$ wp config create --dbname=hidromiel --dbuser=fcjurado --dbpass=mysql

$ wp db create

$ wp core install --url=http://wpcli.local/wp-cli/hidromiel/ --title="Hidromiel" --admin_user=admin --admin_password=admin --admin_email=wpcli@fcjurado.com

$ wp core check-update

$ wp core update

$ wp core update-db
```



## Desactualizar core

```
$ wp core download --force --version=4.5

$ wp core update --version=4.5 --force

$ wp core update-db
```



## Instalar tema

```
$ wp theme install coffeeisle --activate 

$ wp theme install fury --activate
```



## Instalar plugin

```
$ wp plugin install coffee-cup-widget --activate

$ wp plugin install coffee-cup-widget --activate

$ wp plugin install contact-form-7 jetpack wordpress-seo user-registration google-sitemap-generator w3-total-cache vaultpress wp-smushit wp-optimize google-analytics-for-wordpress all-in-one-schemaorg-rich-snippets bj-lazy-load wordfence broken-link-checker social-icons cornify-for-wordpress hello-darth food-and-drink-menu tlp-food-menu tinycoffee --activate
```


## Instalar plugin con widget y agregar widget

```
$ wp plugin install coffee-cup-widget

$ wp sidebar list

$ wp option list | grep widget_ 

$ wp widget add coffeecup fury-sidebar 1 --title="Select Coffee"
```


## Actualizar plugins

Instalamos versión antigua de Plugin:

```
$ wp plugin install booking --version=8.0.1

$ wp plugin status

$ wp plugin update-all
```



## Actualizar temas
Instalamos versión antigua de Tema:

```
$ wp theme install hestia --version=2.2.0

$ wp theme status

$ wp theme update-all
```



## Crear contenido random

```
$ wp term generate category --count=100

$ wp term generate post_tag --count=100

$ wp post generate --count=1000

$ wp post generate --count=100 --post_type=page

$ wp user generate --count=5 --role=editor

$ wp user generate --count=10 --role=author

$ wp post generate --format=ids --count=100 | xargs -0 -d ' ' -I % wp comment generate --count=10 --post_id=%

$ curl "https://baconipsum.com/api/?type=meat-and-filler&paras=10&format=html" | wp post generate --count=5 --post_content --format=ids | xargs -0 -d ' ' -I % wp comment generate --count=10 --post_id=%
```


## Eliminar contenido

```
$ wp post delete $(wp post list --post_type='revision' --format=ids)

$ wp post delete $(wp post list --post_type='page' --format=ids)
```


## Eliminar comentarios marcados como spam

```$ wp comment delete $(wp comment list --status=spam --format=ids)```


## Importar usuarios desde CSV

```$ wp user import-csv ~/users.csv```

Sample users.csv file:

user_login,user_email,display_name,role    
bobjones,bobjones@example.com,Bob Jones,contributor    
newuser1,newuser1@example.com,New User,author    
existinguser,existinguser@example.com,Existing User,administrator    
...



## Limpiar la caché

```
$ wp transient delete --expired

$ wp cache flush
```



## Exportar contenido

```
$ wp plugin install wordpress-importer --activate 

$ wp export 
```



## Vaciar base de datos

```
$ wp db reset --yes 

$ wp core install --url=http://wpcli.local/wp-cli/hidromiel/ --title="Hidromiel" --admin_user=admin --admin_password=admin --admin_email=wpcli@fcjurado.com 
```


## Importar contenido

```
$ wp plugin install wordpress-importer --activate

$ wp import sombra.wordpress.2019-03-20.000.xml --authors=create
```



## Realizar copia de seguridad BD

```$ wp db export ~/cafes.sql```



## Restaurar copia de seguridad BD

```$ wp db import ~/cafes.sql```



## Crear staging site 

Recomendado al hacer acciones automáticas de actualizaciones

```
$ mkdir staging 

$ cd staging

$ cp -R ../sombra/* ./ 

$ wp config set DB_NAME staging

$ wp db create

$ wp db import ~/cafes.sql

$ wp search-replace 'http://wpcli.local/wp-cli/cafes/' 'http://wpcli.local/wp-cli/staging/' 

$ wp option update home 'http://wp-cli.local/wp-cli/staging/'

$ wp option update siteurl 'http://wp-cli.local/wp-cli/staging/'
```



## Optimizar base de datos

```
$ wp db optimize

$ wp db repair

$ wp db size
```



## BSOD - Panic mode ON

```
$ wp config set WP_DEBUG true

$ wp plugin deactivate --all

$ wp theme activate twentynineteen 

$ wp core update -–version=4.6.1 –-force 

$ wp core update-db 

$ wp plugin activate <plugins>

$ wp config set WP_DEBUG false
```


## Consola MySQL

```$ wp db cli```



## Subir imágenes desde local

```
$ wp media import ../images/*.jpg 

wp media import ../images/DSC_4321.png --post_id=1 \
--title="A little cat" --featured_image
```



## Regenerar thumnails

Cambiamos el tema para necesitar regenerar

```
$ wp theme install coffeecafe --activate 

$ wp media regenerate --yes 
```


## Extensiones

```
$ wp package list 

$ wp package install _package_ 
```



### Renombrar prefijo de la base de datos

```
$ wp package install iandunn/wp-cli-rename-db-prefix

$ wp rename-db-prefix cafe_solo_
```


### WP-SEC

WP-SEC es una extensión que realiza chequeo de vulnerabilidades con wpvulndb.com

```
$ wp package install markri/wp-sec

$ wp wp-sec check
```


## Varios servidores - Alias

~/.wp-cli/config.yml

```
@solo:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/solo.fcjurado.com
@largo:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/largo.fcjurado.com
@semilargo:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/semilargo.fcjurado.com
@solocorto:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/solocorto.fcjurado.com
@mitad:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/mitad.fcjurado.com
@entrecorto:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/entrecorto.fcjurado.com
@corto:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/corto.fcjurado.com
@sombra:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/sombra.fcjurado.com
@nube:
  ssh: fcjurado@cofeeshop.com:/home/coffeeshop/nube.fcjurado.com
@fry:
  - @solo
  - @largo
  - @semilargo
  - @solocorto
  - @mitad
  - @entrecorto
  - @corto
  - @sombra
  - @nube


[Update](update.sh)