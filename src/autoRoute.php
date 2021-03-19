<?php

namespace ofi\route;

// import laravel class
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class autoRoute extends BaseController {

    /**
     * To turn on auto route
     */
    static public function init()
    {
        return Route::any('/{path}', function($path) {
            $classname = null;
            $folderName = null;

            $path = strtok($path, '?');
            $explode = explode('/', $path);

            $classname = $explode[ count($explode) - 1 ];
            $folder = str_replace($classname, "", $path);

            echo $class = "\App\Http\Controller\\" . $folder;
        });
    }

}