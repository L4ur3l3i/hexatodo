<?php

interface UserRepository
{
    public function findById(int $id): ?User;
    public function save(User $user): void;
    public function delete(User $user): void;
}
