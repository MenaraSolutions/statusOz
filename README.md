# statusOz

statusOz ([https://www.statusoz.com](https://www.statusoz.com)) is a simple network speed dashboard based on Speedtest.net CLI tool 
and Laravel 5 PHP framework. We use it to monitor network congestion of Australian Internet providers but you could
easily swap the servers. 

# Installation

After you downloaded the repository, make sure all vendor packages including Laravel are loaded:

```
composer install
```

Rename .env.example to .env and put your real database credentials there. Afterwards, you can migrate and
seed the database (seeding is optional):

```
php artisan migrate --seed
```


# Copyright

Menara Solutions Pty Ltd (c) 2015
Contact us at [https://www.menara.com.au](https://www.menara.com.au)