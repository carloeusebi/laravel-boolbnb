# STEPS INSTALLAZIONE

-   Da terminale scrivere `git clone https://github.com/carloeusebi/laravel-boolbnb`
-   `cp .env.example .env`
-   nel file `.env` scrivere i dati del proprio database locale
-   `composer install`
-   `php artisan key:generate`
-   `php artisan migrate --seed` per riempire il database
-   `php arisan serve`, NON fare npm run dev
