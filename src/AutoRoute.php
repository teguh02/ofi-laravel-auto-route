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

    // default allowed http method
    protected static $allowedHttp;

    /**
     * To turn on auto route.
     */
    public static function init()
    {
        self::loadConfig();
        return self::core();
    }

    /**
     * Core from this package
     */
    private static function core()
    {
        Route::match(self::allowedHttpMethod(), '/{path}/{path2?}/{path3?}/{path4?}/{path5?}/{path6?}/{path7?}/{path8?}/{path9?}/{path10?}/{path11?}/{path12?}/{path13?}/{path14?}/{path15?}', function (
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
            $path2 = self::_cleanPath($path2);
            $path3 = self::_cleanPath($path3);
            $path4 = self::_cleanPath($path4);
            $path5 = self::_cleanPath($path5);
            $path6 = self::_cleanPath($path6);
            $path7 = self::_cleanPath($path7);
            $path8 = self::_cleanPath($path8);
            $path9 = self::_cleanPath($path9);
            $path10 = self::_cleanPath($path10);
            $path11 = self::_cleanPath($path11);
            $path12 = self::_cleanPath($path12);
            $path13 = self::_cleanPath($path13);
            $path14 = self::_cleanPath($path14);
            $path15 = self::_cleanPath($path15);

            // merge all path
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

                // if class does not exists
                if (! method_exists($newClass, $methodName)) {
                    return abort(404);
                }

                // check is ____() method is exists?
                if (method_exists($arrangeClassName, '____')) {
                    self::handleMiddlewareMethod($arrangeClassName, $methodName);
                }

                if ($methodName == '____') {
                    abort(403, "Auto Route: You can't access this method");
                }

                // call the method now
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
     * To clean and arrange path
     */
    private static function _cleanPath($params)
    {
        if ($params == '\\') {
            return '\\';
        }

        return '\\'.$params;
    }

    /**
     * To load all default allowed http method
     */
    private static function allowedHttpMethod(): array
    {
        $result = self::$allowedHttp;

        // Uppercase all result
        return (array) array_change_key_case($result, CASE_UPPER);
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

        // set default allowed method
        self::$allowedHttp = $config->allowedHttp;
    }

    /**
     * To handle ____() method
     * ____() is a auto routing middleware method
     */
    private static function handleMiddlewareMethod($className, $methodName)
    {
        $middlewareArray = (array) $className::____();

        foreach ($middlewareArray as $key => $value) {
            if ($methodName == $key) {
                $method = $middlewareArray[$key];

                if ('boolean' != gettype($method())) {
                    throw new \Exception("Auto Route Error: Middleware [" . $key . "] is a " . gettype($method()) . " and return '". $method() ."' . Middleware [" . $key . "] must a boolean");
                }

                // if false show forbiden error
                if (!$method()) {
                    return abort(403, "Auto Route: You can't access this method");
                }
            }
        }

        return true;
    }
}