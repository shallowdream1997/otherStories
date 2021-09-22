<?php

namespace app\common\exception;
/**
 * Admin异常类
 */
class AdminException extends \Exception
{
    protected $code = -1;
    protected $message = 'invalid parameters';
    private array $params_map = [
        2001 => '密码不正确',
        2002 => '手机号码已存在',
        2003 => '非法登录',
    ];

    public function __construct($code = 0)
    {
        $this->code($code);
        parent::__construct($this->message, $this->code);
    }

    private function code($code)
    {
        $map = $this->params_map;
        $this->message = $map[$code] ?? $this->message;
        $this->code = $code ?? $this->code;
    }
}