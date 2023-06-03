<?php

namespace App\Providers\ServicesProviders;

use App\Providers\Interfaces\ServiceProviderInterface;
use App\Router\CallAction;
use Exception;
use Pimple\Container;

class RouteServiceProvider implements ServiceProviderInterface
{
    public function boot(Container $container)
    {
        $callAction = new CallAction();
    }

    public function failed(Exception $exception)
    {
        // TODO: Implement failed() method.
    }

    public function end()
    {
        // TODO: Implement end() method.
    }
}