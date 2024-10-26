<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\User\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

class UpdateEmailCommand implements UserCommand
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function execute(User $user): void
    {
        $user->setEmail($this->email);
    }
}