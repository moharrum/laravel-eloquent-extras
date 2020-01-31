<?php

namespace Moharrum\LaravelEloquentExtras\SoftDeletes;

use Exception;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @author Khalid Moharrum <khalid.moharram@gmail.com>
 */
trait InteractsWithSoftDeletes
{
    use CascadesSoftDeletes, CascadesSoftRestores;

    protected function areWeImplementingSoftDeletes(): void
    {
        if (! method_exists($this, 'runSoftDelete')) {
            throw new Exception;
        }
    }

    protected function areWeUsingValidRelationInstances(): void
    {
        foreach ($this->getCascadingRelations() as $relationship) {
            if (! $this->{$relationship}() instanceof Relation) {
                throw new Exception;
            }
        }
    }

    protected function figureOutDeletingMethod($model): string
    {
        $method = 'delete';

        if ($model->forceDeleting) {
            $method = 'forceDelete';
        }

        return $method;
    }
}
