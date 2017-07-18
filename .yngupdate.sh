#/bin/bash

chown -R pi:www-data /var/www/html/Manipulate/.git
chown -R pi:www-data /var/www/html/Reveal3D-UI/.git
chmod -R 775 /var/www/html/Manipulate/.git
chmod -R 775 /var/www/html/Reveal3D-UI/.git
echo "change complete"
