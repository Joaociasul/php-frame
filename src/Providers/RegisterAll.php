<?php

namespace App\Providers;

use App\Config\Config;
use App\Providers\Interfaces\ServiceProviderInterface;
use Pimple\Container;
use ReflectionClass;

class RegisterAll
{
    /**
     * @throws \ReflectionException
     */
    public function boot()
    {
        $providers = Config::providers();
        $container = new Container();
        foreach ($providers as $provider) {
            /**
             * @var ServiceProviderInterface $instance
             */
            $instance = (new ReflectionClass($provider))->newInstance();
            try {
                $instance->boot($container);
                $instance->end();
            } catch (\Exception $exception) {
                $instance->failed($exception);
                break;
            }
        }
    }

}