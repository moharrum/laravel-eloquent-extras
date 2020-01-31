<?php

namespace Moharrum\LaravelEloquentExtras\PrimaryKeys;

use Ramsey\Uuid\Uuid;

/**
 * Generate version 5 UUIDs for primary keys.
 *
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
trait GeneratesV5Uuids
{
    /**
     * Boot the trait.
     *
     * We listen for the creating event of the model, then we generate
     * a UUID primary key and attach it to model before sending the request
     * to storage.
     *
     * @throws \Ramsey\Uuid\Exception\UnsatisfiedDependencyException
     */
    protected static function bootGeneratesV5Uuids(): void
    {
        static::creating(
            function ($model) {
                $uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, env('APP_URL', 'php.net'));

                $model->{$model->getKeyName()} = $uuid->toString();
            }
        );
    }
}
