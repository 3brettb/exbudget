<?php

    function test_helpers()
    {
        return "test helpers: Helpers are working";
    }

    function getAsArray(&$value){
        if($value == "" || $value == [""]){
            return array();
        }else if(gettype($value) == "array"){
            return $value;
        }else{
            return array($value);
        }
    }

    function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    function obj($args=null){
        if(isAssoc(getAsArray($args))){
            $o = new \App\Helpers\Collection();
            $o->prop($args);
        }
        else{
            $o = new \App\Helpers\Collection($args);
        }
        return $o;
    }

    function uuid($v=4, $namespace=null)
    {
        $n = ($namespace==null) ? "1546058f-5a25-4334-85ae-e68f2a44bbaf" : $namespace;
        switch($v){
            case 3:
            default:
                return \App\Helpers\UUID::v3($n, microtime(true));
            case 4:
                return \App\Helpers\UUID::v4();
            case 5:
                return \App\Helpers\UUID::v5($n, microtime(true));
        }
    }

    function month_int($arg=null)
    {
        return ($arg=null) ? \Carbon\Carbon::now()->month : \Carbon\Carbon::parse($arg)->month;
    }

    function month_string($arg=null)
    {
        return ($arg=null) ? \Carbon\Carbon::now()->format('F') : \Carbon\Carbon::parse($arg)->format('F');
    }

    function month_begin($arg=null)
    {
        return ($arg=null) ? \Carbon\Carbon::now()->startOfMonth() : \Carbon\Carbon::parse($arg)->startOfMonth();
    }

    function month_end($arg=null)
    {
        return ($arg=null) ? \Carbon\Carbon::now()->endOfMonth() : \Carbon\Carbon::parse($arg)->endOfMonth();
    }