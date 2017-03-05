<?php

namespace App\Helpers;

use Illuminate\Support\Collection as LaravelCollection;

class Collection extends LaravelCollection
{

    public function prop($args)
    {
        foreach((object)$args as $k => $v){
            $this->{$k} = $v;
        }
    }

}