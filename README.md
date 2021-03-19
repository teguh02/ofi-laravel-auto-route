# Laravel auto route
(Unofficial Package) This package can make laravel to auto route
Tested on laravel 7

# Installation & Sample
## Installation
1. Install laravel framework
2. Install this package in laravel framework with <code>composer require ofi/laravel-auto-route</code>
3. Wait until finish
4. Open your routes/web.php and import this package class with <code>use ofi\route\autoRoute;</code>
5. Add package init (see the sample) in your route file

## Sample
See my web.php file below

```php
<?php

use Illuminate\Support\Facades\Route;
use ofi\route\autoRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

autoRoute::init();
// or
// autoRoute::init(['namespace' => "App\Http\Controllers\otherFolder"]);
// or
// autoRoute::init(['defaultMethod' => "defaultMethod"]);

Route::get('/', function () {
    return view('welcome');
});
```

# Configuration
## 1. Namespace
The default namespace is <b>App\Http\Controllers</b>
like a laravel default RouteServiceProvider <a href="https://github.com/laravel/laravel/blob/8.x/app/Providers/RouteServiceProvider.php">here</a>
You can change with <code>autoRoute::init(['namespace' => "App\Http\Controllers\otherFolder"]);</code>
## 2. Method
The default method is index() (like a codeigniter auto route default method) will call when your request url is single request url
for example
```
  http://yourlaravelsite.com/singleRequest
  http://yourlaravelsite.com/sample
```
is same as
```
  http://yourlaravelsite.com/singleRequest/index
  http://yourlaravelsite.com/sample/index
```

You can change default method with <code>autoRoute::init(['defaultMethod' => "defaultMethod"]);</code>

# Contributor
If you want to our contributor you can open new issue and tell whats your problem, and we will fix it. Thanks
