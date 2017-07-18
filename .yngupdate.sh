#/bin/bash

chown -R odroid:www-data /var/www/html/Manipulate/.git
chown -R odroid:www-data /var/www/html/Reveal3D-UI/.git
chmod -R 775 /var/www/html/Manipulate/.git
chmod -R 775 /var/www/html/Reveal3D-UI/.git
