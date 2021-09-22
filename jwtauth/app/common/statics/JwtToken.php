<?php


namespace app\common\statics;

/**
 * jwt工具
 */
use Firebase\JWT\JWT;

class JwtToken
{
    static public function setToken($key,$payload)
    {
        $jwt = JWT::encode($payload, $key);

        return $jwt;
    }

    static public function getPayload($jwt,$key)
    {
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        JWT::$leeway = 60; // $leeway in seconds
        return (array)$decoded;
    }
}