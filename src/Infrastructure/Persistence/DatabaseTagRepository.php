<?php

namespace L4ur3l3i\Hexatodo\Infrastructure\Persistence;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;
use PDO;

class DatabaseTagRepository implements \L4ur3l3i\Hexatodo\Core\Domain\Ports\TagRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): ?Tag
    {
        $stmt = $this->connection->prepare('SELECT * FROM tags WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Tag($data['id'], $data['name']) : null;
    }

    public function findByTask(int $taskId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM tags WHERE task_id = :task_id');
        $stmt->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tags = [];
        foreach ($data as $tag) {
            $tags[] = new Tag($tag['id'], $tag['name']);
        }

        return $tags;
    }

    public function save(Tag $tag): void
    {
        $stmt = $this->connection->prepare('INSERT INTO tags (name) VALUES (:name)');
        $stmt->bindParam(':name', $tag->getName(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(Tag $tag): void
    {
        $stmt = $this->connection->prepare('DELETE FROM tags WHERE id = :id');
        $stmt->bindParam(':id', $tag->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}