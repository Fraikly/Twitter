<?php

namespace App\Http\Filters;



use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{

    public const LOGIN = 'login';
    public function login(Builder $builder, $value){
        $builder->where('login','like',"%{$value}%");
    }

    protected function getCallbacks(): array
    {
            return [
                self::LOGIN=>[
                    $this,'login'
                ]
            ];
    }
}
