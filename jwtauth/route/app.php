<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

$routes = \app\common\statics\Router::routeList();
foreach ($routes as $route){
    switch ($route['method']){
        case "get":
            Route::get($route['rule'],$route['route']);
            break;
        case "post":
            Route::post($route['rule'],$route['route']);
            break;
        default:
            break;
    }
}
