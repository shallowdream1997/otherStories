<?php
declare (strict_types=1);

namespace app\middleware;

use app\common\exception\AdminException;
use app\common\statics\JwtToken;
use think\facade\Cache;

class AdminToken
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $token = $request->post('token');
        $cache = Cache::get($token);
        $bool = JwtToken::getPayload($token, $cache);
        if (empty($bool)) {
            throw new AdminException(2003);
        }
        return $next($request);
    }
}
