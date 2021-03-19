<?php

namespace ofi\route;

// import laravel class
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class autoRoute extends BaseController {

    // default namespace
    protected static $namespace = 'App\Http\Controllers';

    // default method 
    protected static $defaultMethod = 'index';

    /**
     * To turn on auto route
     */
    static public function init(array $config = [])
    {
        if (
            isset($config['namespace']) &&
            !empty($config['namespace'])
        ) {
            self::$namespace = $config['namespace'];
        }

        if (
            isset($config['defaultMethod']) &&
            !empty($config['defaultMethod'])
        ) {
            self::$defaultMethod = $config['defaultMethod'];
        }

        return self::core();
    }

    static private function core()
    {
        Route::any('/{path}/{path2?}/{path3?}/{path4?}/{path5?}/{path6?}/{path7?}/{path8?}/{path9?}/{path10?}/{path11?}', function(
            $path, 
            $path2 = '\\', 
            $path3 = '\\',
            $path4 = '\\',
            $path5 = '\\',
            $path6 = '\\',
            $path7 = '\\',
            $path8 = '\\',
            $path9 = '\\',
            $path10 = '\\',
            $path11 = '\\'
        ) {
            // clean path
            $path = strtok($path, '?');
            $path2 = $path2 == '\\' ? "\\" : "\\" . strtok($path2, '?');
            $path3 = $path3 == '\\' ? "\\" : "\\" . strtok($path3, '?');
            $path4 = $path4 == '\\' ? "\\" : "\\" . strtok($path4, '?');
            $path5 = $path5 == '\\' ? "\\" : "\\" . strtok($path5, '?');
            $path6 = $path6 == '\\' ? "\\" : "\\" . strtok($path6, '?');
            $path7 = $path7 == '\\' ? "\\" : "\\" . strtok($path7, '?');
            $path8 = $path8 == '\\' ? "\\" : "\\" . strtok($path8, '?');
            $path9 = $path9 == '\\' ? "\\" : "\\" . strtok($path9, '?');
            $path10 = $path10 == '\\' ? "\\" : "\\" . strtok($path10, '?');
            $path11 = $path11 == '\\' ? "\\" : "\\" . strtok($path11, '?');

            // arrange all path
            $path = $path . $path2 . $path3 . $path4 . $path5 . $path6 . $path7 . $path8 . $path9 . $path10 . $path11;

            // remove \\ from last path
            $path = rtrim($path, "\\");
            
            // get class and method name
            $explode = explode("\\", $path);
            if (count($explode) === 1) {
                $methodName = self::$defaultMethod;
            } else {
                $methodName = $explode[ count($explode) - 1 ];
            }
            $path = str_replace("\\" . $methodName, "", $path);

            // arrange class name
            $arrangeClassName = self::defaultNamespace() . "\\" . $path;

            // if class exists
            if(class_exists($arrangeClassName)) {
                // create new class
                $newClass = new $arrangeClassName;

                // call the method now

                // if class does not exists
                if (!method_exists($newClass, $methodName)) {
                    return abort(404);
                }

                // if class exists
                return $newClass->$methodName();
            }

            // if class does not exists
            abort(404);
        });
    }

    /**
     * Get default Controllers namespace
     */
    static private function defaultNamespace()
    {
        return "\\" . trim(str_replace("/", "\\", self::$namespace), "\\");
    }

}