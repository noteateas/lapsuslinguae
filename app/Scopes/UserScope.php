<?php


namespace App\Scopes;

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('active', '=', 1);
    }
}
