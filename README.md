# Simple demo

Laravel, Vue, Tailwindcss.

### Install

Clone and install composer and nmp dependencies

```
$ git clone https://github.com/LucasLeandro1204/simple-demo.git
$ cd simple-vue
$ composer update && npm install
```

Copy and edit the .env.example

```
$ cp .env.example .env
```

Run the migrations and seeds

```
$ php artisan migrate --seed
```

### Tests

To run them

```
$ composer test
```