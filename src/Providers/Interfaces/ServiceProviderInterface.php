<?php

namespace App\Providers\Interfaces;
use Exception;
use Pimple\Container;

interface ServiceProviderInterface
{
    public function boot(Container $container);
    public function failed(Exception $exception);
    public function end();

}