<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\User\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

class ChangePasswordCommand implements UserCommand
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function execute(User $user): void
    {
        $user->setPassword($this->password);
    }
}