## Comandos
Comando para o cron: 
    LINUX => php artisan schedule:run >> /dev/null 2>&1
    WINDOWS => php artisan schedule:run > $null 2>&1

Comando para às filas
    php artisan queue:work