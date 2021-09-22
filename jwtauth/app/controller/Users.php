<?php


namespace app\controller;


use app\BaseController;
use app\common\exception\AdminException;
use app\common\logic\RegisterLogic;
use app\common\logic\UserLogic;
use app\common\validate\AdminsValidate;
use think\exception\ValidateException;

class Users extends BaseController
{
    public function list()
    {
        $server = new UserLogic();
        $server->list();
        return json();
    }

    public function login()
    {
        $data = $this->request->only(['phone', 'password'], 'post');
        validate(AdminsValidate::class)->scene('login')->check($data);
        $registerLogic = new RegisterLogic();
        $login = $registerLogic->makeMd5UniquePassword($data)->checkPassword()->setAdminTokenToRedis()->getAdminToken();
        return json($login);
    }

    public function register()
    {
        $data = $this->request->only(['phone', 'password'], 'post');
        validate(AdminsValidate::class)->scene('register')->check($data);
        $registerLogic = new RegisterLogic();
        $register = $registerLogic->makeMd5UniquePassword($data)->checkUniquePhone()->register()->getUserId();
        return json($register);
    }
}