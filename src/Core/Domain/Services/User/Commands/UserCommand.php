<?php 

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\User\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

interface UserCommand
{
    public function execute(User $user): void;
}