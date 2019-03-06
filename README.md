# rbccms #

## install ##

run command in project directory

```bash
$ composer update
```

if problem with autoload file

```bash
$ composer dump-autoload
```

## config ##

rename .env.example to .env

run command

```bash
$ php artisan key:generate
```


edit your .env file

```
CACHE_DRIVER=memcached

```

next step create db tables

```bash
$ php artisan migrate
```

if your want generate demo data run command

```bash
$ php artisan migrate --seed
```