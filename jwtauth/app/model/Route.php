<?php
declare (strict_types = 1);

namespace app\model;

use app\common\enum\RouteStatus;
use think\Model;

/**
 * @mixin think\Model
 */
class Route extends Model
{

    public function routeList(): array
    {
        return self::where('status','=',RouteStatus::OPEN)->column('method,rule,route');
    }
}
