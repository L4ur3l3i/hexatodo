<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\User\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

class UpdateUsernameCommand implements UserCommand
{
    private string $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function execute(User $user): void
    {
        $user->setUsername($this->username);
    }
}