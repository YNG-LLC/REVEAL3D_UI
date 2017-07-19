#/bin/bash

if [ -d "/home/pi/" ]; then
  # Control will enter here if $DIRECTORY exists.
  chown -R pi:www-data /var/www/html/Manipulate/.git
  chown -R pi:www-data /var/www/html/Reveal3D-UI/.git
  chmod -R 775 /var/www/html/Manipulate/.git
  chmod -R 775 /var/www/html/Reveal3D-UI/.git
  echo "file changes complete"
fi

if [ -d "/home/odroid/" ]; then
  # Control will enter here if $DIRECTORY exists.
  chown -R odroid:www-data /var/www/html/Manipulate/.git
  chown -R odroid:www-data /var/www/html/Reveal3D-UI/.git
  chmod -R 775 /var/www/html/Manipulate/.git
  chmod -R 775 /var/www/html/Reveal3D-UI/.git
  echo "file changes complete"
fi



