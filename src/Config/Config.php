<?php

namespace App\Config;
use App\Providers\ServicesProviders\RouteServiceProvider;

class Config
{
    public static function providers(): array
    {
        return [
            RouteServiceProvider::class,
        ];
    }

}