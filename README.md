# Laravel Eloquent Extras

Set of extra and useful Eloquent helpers to speed up development.

## Installing

Install the package via composer:

```bash
    composer require moharrum/laravel-eloquent-extras
```

## Usage

### Primary keys
* UUID - version 4
* UUID - version 5

Suppose we have a `User` model and we want that model to generate a `version {4|5} UUID` for a primary key.

```php
    <?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Moharrum\LaravelEloquentExtras\PrimaryKeys\GeneratesV5Uuids;
    // Moharrum\LaravelEloquentExtras\PrimaryKeys\GeneratesV4Uuids; -> or version 4

    class User extends Authenticatable
    {
        use Notifiable, GeneratesV5Uuids; // or GeneratesV4Uuids

        /**
         * Indicates if the IDs are auto-incrementing.
         *
         * @var bool
         */
        public $incrementing = false;
    }
```

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
