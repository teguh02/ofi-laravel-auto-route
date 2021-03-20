# Laravel auto route
(Unofficial Package) This package can make laravel to auto route

Tested on :
1. laravel 7 at March 19 2021
2. Laravel 8 at March 20 2021

# Demo
We already install laravel 8 in heroku app, you can visit <a href="https://ofi-laravel-auto-route.herokuapp.com">here</a>, and see sample.php below you can visit like this
```
    https://ofi-laravel-auto-route.herokuapp.com/sample
    https://ofi-laravel-auto-route.herokuapp.com/sample/time
```
Youtube video here https://www.youtube.com/watch?v=OM6fz1ZGF6U

# Installation & Sample
## Installation
1. Install laravel framework
2. Install this package in laravel framework with <code>composer require ofi/laravel-auto-route</code>
3. Wait until finish
4. Open your routes/web.php and import this package class with <code>use ofi\route\autoRoute;</code>
5. Add package init (see the sample) in your route file
6. Create sample.php controller in App/Http/Controllers (see controller sample below)
7. (skip to step 8 when you alerady running your laravel application) now run your laravel application with serve command
8. try to call <code>/sample</code> or <code>/sample/time</code> or <code>/sample/index</code> (see in screenshoot section below) . Is it works? if does'nt work you can open new issue here. Thanks

## Sample
### web.php
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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/otherroute', function () {
    var_dump("other route");
});


// put it at the bottom from other script
autoRoute::init();
// or
// autoRoute::init([
//     'defaultMethod' => "defaultMethod", 
//     'namespace' => "App\Http\Controllers\otherFolder"
// ]);
```

### sample.php
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * We will call this controller later
 * using auto route
 */

class sample extends Controller
{
    public function index()
    {
        var_dump('index');
    }

    public function time()
    {
        var_dump(now());
    }

    public function defaultMethod()
    {
        var_dump('default method');
    }
}

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
If you want to be our contributor you can open new issue and tell whats your problem, and we will fix it. Thanks

# Screenshoot
![image](https://user-images.githubusercontent.com/43981051/111856122-3dfdbb00-895b-11eb-99f7-a6f7dbd4612b.png)

![image](https://user-images.githubusercontent.com/43981051/111856150-6685b500-895b-11eb-8eff-2df57d93a550.png)
