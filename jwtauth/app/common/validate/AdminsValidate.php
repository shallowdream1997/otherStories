<?php


namespace app\common\validate;


use think\Validate;

class AdminsValidate extends Validate
{
    protected $rule = [
        'id'       => 'require',
        'phone'    => ['require', 'regex' => '/^(13[0-9]|14[5|7]|15[0|1|2|3|4|5|6|7|8|9]|17[6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/'],
        'password' => 'require|min:8',
    ];

    protected $message = [
        'id'               => '请选择指定用户',
        'phone.require'    => '请填写手机号',
        'phone.regex'      => '手机格式不正确',
        'password.require' => '密码不能为空',
        'password.min'     => '密码至少8位',
    ];

    protected $scene = [
        'register' => [
            'phone',
            'password'
        ],
        'login'    => [
            'phone',
            'password'
        ]
    ];
}