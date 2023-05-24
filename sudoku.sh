#!/bin/bash
# -*- ENCODING: UTF-8 -*-

# Verificar si PHP CLI está instalado
if ! command -v php >/dev/null 2>&1; then
  echo "PHP CLI no está instalado. Se procederá con la instalación..."
  sudo apt-get update
  sudo apt-get install -y php-cli
  if [ $? -eq 0 ]; then
    echo "PHP CLI se ha instalado correctamente."
  else
    echo "Error al instalar PHP CLI. Por favor, verifica los errores y vuelve a intentarlo."
    exit 1
  fi
else
  echo "PHP CLI ya está instalado."
fi

# Definir URL y comandos
url="http://127.0.0.1:8080"
firefox_command="firefox"

# Iniciar servidor PHP en segundo plano
sudo php -S 127.0.0.1:8080 > /dev/null 2>&1 &

# Esperar un tiempo para que el servidor se inicie correctamente
sleep 5

# Verificar si Firefox está abierto
if pgrep -x $firefox_command >/dev/null; then
  echo "Firefox está abierto."
  $firefox_command -new-tab $url
else
  echo "Firefox no está abierto. Abriendo Firefox..."
  if $firefox_command $url >/dev/null 2>&1; then
    echo "Firefox se abrió en la página: $url"
  else
    echo "Error al abrir Firefox en la página: $url"
    exit 1
  fi
fi

# Mantener el script en ejecución mientras se utiliza el servidor PHP
read -rp "Presiona Enter para detener el servidor PHP."

# Detener el servidor PHP
sudo pkill -f "php -S 127.0.0.1:8080"

exit

