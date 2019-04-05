#!/bin/sh
#
#

wp plugin deactivate --skip-plugins --all
for p in $(wp plugin list --field=name --status=inactive)
do
    wp plugin activate $p 
    echo "\n"
    echo $p
    for i in {1..2}
    do
        curl -so /dev/null -w "%{time_total}\n" \ -H "Pragma: no-cache" http://wpcli.local/wp-cli/cafes/
    done
done