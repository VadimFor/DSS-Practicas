## Instrucciones de despliegue (Desde la carpeta raiz)

1. Iniciar contenedor de BD:
  - sudo docker compose up
2. Refrescar enlace simbólico con los siguientes comandos (para que se vean las imagenes):
  - rm -R public/storage
  - php artisan optimize:clear
  - php artisan storage:link
3. 'Sembrar' la BD con los seeders:
  - php artisan migrate:refresh --seed
4. Iniciar servidor de la página web con el comando:
  - php artisan serve


![Screenshot](fudrater_principal.jpg)
