<?php

interface TaskRepository
{
    public function findById(int $id): ?Task;
    public function findByUser(int $userId): array;
    public function findByTag(int $tagId): array;
    public function save(Task $task): void;
    public function delete(Task $task): void;
}
