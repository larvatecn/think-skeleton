<?php

declare(strict_types=1);

namespace app\event\user;

use app\model\User;

/**
 * 密码修改事件
 */
class PasswordReset
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
