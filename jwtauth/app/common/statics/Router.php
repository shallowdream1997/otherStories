<?php


namespace app\common\statics;


use app\model\Route;

class Router
{
    static public function routeList()
    {
        return (new Route())->routeList();
    }
}