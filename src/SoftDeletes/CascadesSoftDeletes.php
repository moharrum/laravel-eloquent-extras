<?php

namespace Moharrum\LaravelEloquentExtras\SoftDeletes;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait CascadesSoftDeletes
{
    protected static function bootCascadesSoftDeletes()
    {
        static::deleting(function ($model) {
            $model->areWeImplementingSoftDeletes();

            $model->areWeUsingValidRelationInstances();

            $method = $model->figureOutDeletingMethod($model);

            foreach ($model->getCascadingRelations() as $relationship) {
                if (is_null($model->{$relationship})) {
                    continue;
                }

                if ($model->{$relationship} instanceof Collection) {
                    foreach ($model->{$relationship} as $related) {
                        $related->{$method}();
                    }
                }

                if ($model->{$relationship} instanceof Model) {
                    $model->{$relationship}->{$method}();
                }
            }
        });
    }

    protected function getCascadingRelations() : array
    {
        if (! property_exists($this, 'cascadingSoftDeletes')) {
            return [];
        }

        return $this->cascadingSoftDeletes;
    }
}
