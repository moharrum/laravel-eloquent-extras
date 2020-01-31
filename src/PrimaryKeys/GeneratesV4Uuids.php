<?php

namespace Moharrum\LaravelEloquentExtras\PrimaryKeys;

use Ramsey\Uuid\Uuid;

/**
 * Generate version 4 UUIDs for primary keys.
 *
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
trait GeneratesV4Uuids
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
    protected static function bootGeneratesV4Uuids(): void
    {
        static::creating(
            function ($model) {
                $uuid = Uuid::uuid4();

                $model->{$model->getKeyName()} = $uuid->toString();
            }
        );
    }
}
