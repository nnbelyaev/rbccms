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

