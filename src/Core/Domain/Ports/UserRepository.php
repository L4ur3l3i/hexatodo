<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Ports;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

interface UserRepository
{
    public function findById(int $id): ?User;
    public function save(User $user): void;
    public function delete(User $user): void;
}
