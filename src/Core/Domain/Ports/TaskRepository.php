<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Ports;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

interface TaskRepository
{
    public function findById(int $id): ?Task;
    public function findByUser(int $userId): array;
    public function findByTag(int $tagId): array;
    public function save(Task $task): void;
    public function delete(Task $task): void;
}
