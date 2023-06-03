<?php

namespace App\Router;

use DirectoryIterator;

class CallAction
{
    public function __construct()
    {
        $dirRoutes = BASE_PATH . '/routes';
        $routeFiles = new DirectoryIterator($dirRoutes);
        foreach ($routeFiles as $filename) {
            if ($filename->isDot ()) continue;
            require $dirRoutes . '/' . $filename;
        }
    }

}