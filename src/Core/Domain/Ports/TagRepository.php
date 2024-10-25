<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Ports;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;

interface TagRepository
{
    public function findById(int $id): ?Tag;
    public function findByTask(int $taskId): array;
    public function save(Tag $tag): void;
    public function delete(Tag $tag): void;
}
