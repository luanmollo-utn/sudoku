#!/bin/bash
# -*- ENCODING: UTF-8 -*-
if ! command -v php >/dev/null 2>&1; then
  echo "PHP CLI no está instalado. Se procederá con la instalación..."
  sudo apt-get update
  sudo apt-get install -y php-cli
  echo "PHP CLI se ha instalado correctamente."
else
  echo "PHP CLI ya está instalado."
fi
xdg-open http://127.0.0.1:8080
sudo php -S 127.0.0.1:8080

exit
