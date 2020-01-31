<?php

namespace Moharrum\LaravelEloquentExtras\SoftDeletes;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait CascadesSoftRestores
{
    protected static function bootCascadesSoftRestores()
    {
        static::restoring(function ($model) {
            $model->areWeImplementingSoftDeletes();

            $model->areWeUsingValidRelationInstances();

            $method = 'restore';

            foreach ($model->getRestoringRelations() as $relationship) {
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

    protected function getRestoringRelations() : array
    {
        if (! property_exists($this, 'restoringSoftDeletes')) {
            return [];
        }

        return $this->restoringSoftDeletes;
    }
}
