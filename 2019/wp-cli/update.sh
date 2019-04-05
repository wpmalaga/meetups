#!/bin/sh
#
#

echo "Core check-update"
wp @cafes core check-update 

echo "Hago Backup"
wp @cafes db export

echo "Actualizo Core"
wp @cafes core download
wp @cafes core update
wp @cafes core update-db

echo "Instalo tema"
wp @cafes theme install skt-cafe --activate 

echo "Actualizo temas"
wp @cafes theme update-all

echo "Actualizo plugins"
wp @cafes plugin update-all

echo "Actualizo traducciones"
wp @cafes language core update
wp @cafes language plugin update --all
wp @cafes language theme update --all

echo "Limpieza y optimización"
wp @cafes media regenerate --yes 
wp @cafes transient delete --expired
wp @cafes comment delete $(wp comment list --status=spam --format=ids)
wp @cafes cache flush
wp @cafes db optimize
wp @cafes db repair
wp @cafes db size

echo "Informe seguridad"
wp @cafes wp-sec check 