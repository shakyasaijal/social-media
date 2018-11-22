<?php
namespace App\Facade;
use Illuminate\Support\Facades\Facade;

class Dog extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'Dog';
    }
}