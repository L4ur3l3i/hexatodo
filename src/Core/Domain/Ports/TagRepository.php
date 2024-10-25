<?php

interface TagRepository
{
    public function findById(int $id): ?Tag;
    public function findByTask(int $taskId): array;
    public function save(Tag $tag): void;
    public function delete(Tag $tag): void;
}
