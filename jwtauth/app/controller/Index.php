<?php
namespace app\controller;

use app\BaseController;
use app\middleware\AdminToken;

class Index extends BaseController
{
    protected $middleware = [
        AdminToken::class
    ];
    
    public function index()
    {

        return json();
    }

    public function single()
    {

        return json(1111);
    }

}