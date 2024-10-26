<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\User;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;
use L4ur3l3i\Hexatodo\Core\Domain\Ports\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateUser(User $user, array $commands): User
    {
        foreach ($commands as $command) {
            $command->execute($user);
        }

        $this->userRepository->save($user);
        return $user;
    }
}