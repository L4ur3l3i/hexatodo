<?php

interface TagRepository
{
    public function findById(int $id): ?Category;
    public function findByTask(int $taskId): array;
    public function save(Category $category): void;
    public function delete(Category $category): void;
}
