<?php

namespace Ofi\Route;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

class AutoRoute extends Controller
{
    // default namespace
    protected static $namespace;

    // default method
    protected static $defaultMethod;

    /**
     * To turn on auto route.
     */
    public static function init()
    {
        self::loadConfig();
        return self::core();
    }

    private static function core()
    {
        Route::any('/{path}/{path2?}/{path3?}/{path4?}/{path5?}/{path6?}/{path7?}/{path8?}/{path9?}/{path10?}/{path11?}/{path12?}/{path13?}/{path14?}/{path15?}', function (
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
            $path11 = '\\',
            $path12 = '\\',
            $path13 = '\\',
            $path14 = '\\',
            $path15 = '\\'
        ) {
            // clean path
            $path = strtok($path, '?');
            $path2 = $path2 == '\\' ? '\\' : '\\'.strtok($path2, '?');
            $path3 = $path3 == '\\' ? '\\' : '\\'.strtok($path3, '?');
            $path4 = $path4 == '\\' ? '\\' : '\\'.strtok($path4, '?');
            $path5 = $path5 == '\\' ? '\\' : '\\'.strtok($path5, '?');
            $path6 = $path6 == '\\' ? '\\' : '\\'.strtok($path6, '?');
            $path7 = $path7 == '\\' ? '\\' : '\\'.strtok($path7, '?');
            $path8 = $path8 == '\\' ? '\\' : '\\'.strtok($path8, '?');
            $path9 = $path9 == '\\' ? '\\' : '\\'.strtok($path9, '?');
            $path10 = $path10 == '\\' ? '\\' : '\\'.strtok($path10, '?');
            $path11 = $path11 == '\\' ? '\\' : '\\'.strtok($path11, '?');
            $path12 = $path12 == '\\' ? '\\' : '\\'.strtok($path12, '?');
            $path13 = $path13 == '\\' ? '\\' : '\\'.strtok($path13, '?');
            $path14 = $path14 == '\\' ? '\\' : '\\'.strtok($path14, '?');
            $path15 = $path15 == '\\' ? '\\' : '\\'.strtok($path15, '?');

            // arrange all path
            $path = $path.
                $path2.
                $path3.
                $path4.
                $path5.
                $path6.
                $path7.
                $path8.
                $path9.
                $path10.
                $path11.
                $path12.
                $path13.
                $path14.
                $path15;

            // remove \\ from last path
            $path = rtrim($path, '\\');

            // get class and method name
            $explode = explode('\\', $path);
            if (count($explode) === 1) {
                $methodName = self::$defaultMethod;
            } else {
                $methodName = $explode[count($explode) - 1];
            }
            $path = str_replace('\\'.$methodName, '', $path);

            // arrange class name
            $arrangeClassName = self::defaultNamespace().'\\'.$path;

            // if class exists
            if (class_exists($arrangeClassName)) {
                // create new class
                $newClass = new $arrangeClassName;

                // call the method now

                // if class does not exists
                if (! method_exists($newClass, $methodName)) {
                    return abort(404);
                }

                // if class exists
                return $newClass->$methodName();
            }

            // if class does not exists
            abort(404);
        })
            ->name('autoRouting');
    }

    /**
     * Get default Controllers namespace.
     */
    private static function defaultNamespace()
    {
        return '\\'.trim(str_replace('/', '\\', self::$namespace), '\\');
    }

    /**
     * To load all configuration from config.file
     */
    private static function loadConfig(): void
    {
        // load all configuration from
        $config = (object) config('autoroute');

        // set default namespace
        self::$namespace = $config->namespace;

        // set default method
        self::$defaultMethod = $config->defaultMethod;
    }
}