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
        $user = ['name' => 'admin','list'=>[['id'=>1,'cat'=>'12arc'],['id'=>2,'cat'=>'hera4'],['id'=>3,'cat'=>'ajj4t']]];
        return json($user);
    }

    public function single()
    {

        return json(1111);
    }

}