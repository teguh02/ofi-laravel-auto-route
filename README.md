# Laravel auto route
(Unofficial Package) This package can make laravel to auto route

Tested on :
1. laravel 7 at March 19 2021
2. Laravel 8 at March 20 2021

[![Hits](https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=https%3A%2F%2Fgithub.com%2Fteguh02%2Fofi-laravel-auto-route&count_bg=%2379C83D&title_bg=%23555555&icon=&icon_color=%23E7E7E7&title=People+Visit&edge_flat=false)](https://hits.seeyoufarm.com)

# Demo
We already install laravel 8 in heroku app and we install this package in version v1.4, you can visit <a href="https://ofi-laravel-auto-route.herokuapp.com">here</a>, and see sample.php below you can visit like this
```
    https://ofi-laravel-auto-route.herokuapp.com/sample
    https://ofi-laravel-auto-route.herokuapp.com/sample/time
```
Youtube video here 
1. https://www.youtube.com/watch?v=OM6fz1ZGF6U

# Installation & Sample
## Installation
1. Install laravel framework
2. Install this package in laravel framework with <code>composer require ofi/laravel-auto-route</code>
3. Wait until finish
4. Publish config file with <code>php artisan vendor:publish --provider="Ofi\Route\OfiServiceProvider" --tag=autoroute.config</code>
5. Open your routes/web.php and import this package class with <code>use Ofi\Route\AutoRoute;</code>
6. Add package init (see the sample) in your route file <a href="#webphp">here</a>
7. Create sample.php controller in App/Http/Controllers (see controller sample <a href="#samplephp">below</a>)
8. (skip to step 8 when you alerady running your laravel application) now run your laravel application with serve command
9. try to call <code>/sample</code> or <code>/sample/time</code> or <code>/sample/index</code> (see in screenshoot section <a href="#screenshoot">below</a>) . Is it works? if does'nt work you can open new issue here. Thanks
10. For other documentation you can see <a href="https://github.com/teguh02/ofi-laravel-auto-route/wiki">wiki page</a>

## Sample
### web.php
See my web.php file below

```php
<?php

use Illuminate\Support\Facades\Route;
use Ofi\Route\AutoRoute;

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
AutoRoute::init();
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
See autoroute.php file in /yourLaravelFolder/config/autoroute.php
## 1. Namespace
The default namespace is <b>App\Http\Controllers</b>
like a laravel default RouteServiceProvider <a href="https://github.com/laravel/laravel/blob/8.x/app/Providers/RouteServiceProvider.php">here</a>
You can change with change default namespace in config file <a href="https://github.com/coziboy/ofi-laravel-auto-route/blob/5d8d0db8c25b4883bd5b53179e23f8139016b3c6/config/autoroute.php#L5">here</a>
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

You can change default method with change default method in config file <a href="https://github.com/coziboy/ofi-laravel-auto-route/blob/5d8d0db8c25b4883bd5b53179e23f8139016b3c6/config/autoroute.php#L8">here</a>

## 3. Allowed Http Method
See <a href="https://github.com/teguh02/ofi-laravel-auto-route/blob/d955d16f1e332c60da3c59b6af1f8ae6ca06ed17/config/autoroute.php#L14">here</a>. For example if you just only define GET in allowedHttp array, so you can visit your auto routing url in GET Method only.

# Contributor
If you want to be our contributor you can open new issue and tell whats your problem, and we will fix it. Thanks

<p>Thanks to :</p>

@coziboy - coziboy profile <a href="https://github.com/coziboy">here</a>

# Screenshoot
![image](https://user-images.githubusercontent.com/43981051/111856122-3dfdbb00-895b-11eb-99f7-a6f7dbd4612b.png)

![image](https://user-images.githubusercontent.com/43981051/111856150-6685b500-895b-11eb-8eff-2df57d93a550.png)
