#!/bin/bash

# Rodar o servidor PHP (Laravel)
php artisan serve --host=0.0.0.0 --port=8000 &

# Rodar o processo de fila do Laravel
php artisan queue:listen --tries=1 &

# Rodar o Vite (frontend)
npm run dev &

#!/bin/bash

# Rodar o comando "composer run dev" para iniciar o Laravel e o Vite
composer run dev

# Manter o container em execução
wait -n

# Manter o container em execução
wait -n
