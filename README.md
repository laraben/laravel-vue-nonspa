# Laravel - Vue - NonSPA (BOILERPLATE)

This is a boilerplate to create a non spa application/website.

## Main dependencies

- Laravel 7
- Vue.js
- Laravel Passport
- Vuex
- Axios
- Vuex- i18n
- Permissions (spatie)
- Laravel Debugbar
- PurgeCss (spatie)

## Description

This boilerplate is to use vue with Laravel. The authentication of Laravel is used and the api authentication middelware is handled by Laravel Passport. Some example scripts has already been set in place.


## Installation

Install PHP and JavaScript dependencies:

```bash
composer install
npm install
```

Generate Laravel keys:

```bash
php artisan key:generate
```

Migrate Database:

```bash
php artisan migrate
```

Generate i18n string for Vue, based on Laravel i18n files:

```bash
php artisan vue-i18n:generate
```

Compile the front-end:

```bash
npm run dev
```
