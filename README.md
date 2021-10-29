<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

Sistema para cadastro de veículos utilizando PHP e o framework laravel

Configuração inicial
Configurar o arquivo .env
APP_URL -> Digite o link principal do projeto
FILESYSTEM_DRIVER -> Digite 'public' nessa diretiva para que os uploads carreguem no diretório correto

No terminal digite os seguintes comandos
php artisan migrate
php artisan storage:link
php artisan db:seed (Aqui irá criar o usuário administrador)
npm run dev (Para gerar os assets em desenvolvimento)
npm run production (Para gerar os assets em produção)

Bibliotecas externas utilizadas
Jquery 1.6
Bootstrap 5
Light Gallery

Recursos utilizados
Validação de placa: https://ricardo.coelho.eti.br/regex-mercosul/