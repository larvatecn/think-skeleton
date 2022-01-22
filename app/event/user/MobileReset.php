<?php

declare(strict_types=1);

namespace app\event\user;

use app\model\User;

/**
 * 手机号重置事件
 */
class MobileReset
{
    /**
     * The user.
     *
     * @var User|null
     */
    public ?User $user = null;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
