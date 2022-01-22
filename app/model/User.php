<?php

declare(strict_types=1);

namespace app\model;

use Larva\Hashing\Hash;
use think\facade\Cache;
use think\model\concern\SoftDelete;

/**
 * 用户模型
 * @property int $id
 * @property string|int $mobile 手机号码
 *
 * @property string $password
 * @property string $create_time 创建时间戳
 * @property string $update_time 更新时间戳
 * @property string|null $delete_time 软删除时间戳
 * @mixin \think\Model
 */
class User extends Model
{
    use SoftDelete;

    public const CACHE_TAG = 'users:';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'users';

    /**
     * 隐藏输出的属性
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * 字段自动类型转换
     * @var array
     */
    protected $type = [
        'id' => 'int',
        'password' => 'string',
        'created_time' => 'datetime',
        'updated_time' => 'datetime',
        'delete_time' => 'datetime',
    ];

    /**
     * 设置密码
     */
    public function setPasswordAttr($value): string
    {
        return Hash::make($value);
    }

    /**
     * 重置用户密码
     * @param string $password
     * @return bool
     */
    public function resetPassword(string $password): bool
    {
        $this->password = $password;
        $status = $this->save();
        event(new \app\event\user\PasswordReset($this));
        return $status;
    }

    /**
     * 重置用户手机号
     * @param int|string $mobile
     * @return bool
     */
    public function resetMobile(int|string $mobile): bool
    {
        $this->mobile = $mobile;
        $status = $this->save();
        event(new \app\event\user\MobileReset($this));
        return $status;
    }

    /**
     * 创建前执行
     * @param User $model
     * @return void
     */
    public static function onBeforeInsert(User $model): void
    {
    }

    /**
     * 创建后执行
     * @param User $model
     */
    public static function onAfterInsert(User $model): void
    {
    }

    /**
     * 删除前执行
     * @param User $model
     * @return void
     */
    public static function onBeforeDelete(User $model): void
    {
    }

    /**
     * 删除后执行
     * @param User $model
     */
    public static function onAfterDelete(User $model): void
    {
        Cache::tag(static::CACHE_TAG)->clear();
    }

    /**
     * 写入前执行
     * @param User $model
     * @return void
     */
    public static function onBeforeWrite(User $model): void
    {
    }

    /**
     * 写入后执行
     * @param User $model
     */
    public static function onAfterWrite(User $model): void
    {
        Cache::tag(static::CACHE_TAG)->clear();
    }

    /**
     * Fetch a user from cache.
     * @param int|string $id
     * @return User|null
     */
    public static function findFromCache(int|string $id): ?User
    {
        if (($data = Cache::get('uid:' . $id)) == null) {
            $data = static::find($id);
            Cache::tag(static::CACHE_TAG)->set('uid:' . $id, $data);
        }
        return $data;
    }
}
