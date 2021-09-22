<?php


namespace app\common\logic;


use app\common\exception\AdminException;
use app\common\statics\JwtToken;
use app\model\Admins;
use thans\jwt\facade\JWTAuth;
use think\cache\driver\Redis;
use think\facade\Cache;

class RegisterLogic
{
    /**
     * @var string $password 密码
     */
    protected string $password;

    /**
     * @var string $phone 手机号
     */
    protected string $phone;

    /**
     * @var Admins
     */
    private Admins $userModel;
    /**
     * @var Admins|array|\think\Model|null
     */
    private $admin;

    private int $times;

    /**
     * @var int|string $adminId 用户id
     */
    private $adminId;

    private string $token;

    /**
     * 初始化类
     * RegisterLogic constructor.
     */
    public function __construct()
    {
        $this->userModel = new Admins();
        $this->times = time();
    }

    /**
     * 密码加密,赋值密码，手机号码
     * @param $data
     * @return $this
     */
    public function makeMd5UniquePassword($data): RegisterLogic
    {
        $this->password = md5(md5($data['password']) . $data['phone']);
        $this->phone = $data['phone'];
        return $this;
    }

    /**
     * 检查密码
     * @return $this
     * @throws AdminException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function checkPassword(): RegisterLogic
    {
        $this->admin = $this->userModel
            ->where([['phone', '=', $this->phone], ['password', '=', $this->password]])
            ->field('id,phone,level,create_time')
            ->find();
        if (empty($this->admin)) {
            throw new AdminException(2001);
        }
        return $this;
    }

    /**
     * 检查手机号唯一
     * @return $this
     * @throws AdminException
     */
    public function checkUniquePhone(): RegisterLogic
    {
        $bool = $this->userModel
            ->where([['phone', '=', $this->phone]])
            ->column('phone');
        if (!empty($bool)) {
            throw new AdminException(2002);
        }
        return $this;
    }

    /**
     * 注册用户
     * @return $this
     */
    public function register()
    {
        $this->adminId = $this->userModel->insertGetId([
            'phone'       => $this->phone,
            'password'    => $this->password,
            'create_time' => $this->times,
        ]);
        return $this;
    }

    /**
     * 设置用户token到缓存
     * @return $this
     */
    public function setAdminTokenToRedis(): RegisterLogic
    {
        $this->token = JwtToken::setToken($this->phone, $this->admin);
        Cache::set($this->token, $this->phone);
        return $this;
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    public function getAdminInfo()
    {
        return $this->admin->getData();
    }

    /**
     * 获取用户id
     * @return int
     */
    public function getUserId(): int
    {
        return (int)$this->adminId;
    }

    public function getAdminToken(): string
    {
        return $this->token;
    }
}