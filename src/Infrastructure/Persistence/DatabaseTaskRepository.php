<?php

namespace L4ur3l3i\Hexatodo\Infrastructure\Persistence;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;
use L4ur3l3i\Hexatodo\Core\Domain\Ports\TaskRepository;
use L4ur3l3i\Hexatodo\Infrastructure\DatabaseConnection;
use PDO;

class DatabaseTaskRepository implements TaskRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnection::getConnection();
    }

    public function findById(int $id): ?Task
    {
        $stmt = $this->connection->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new Task($data['id'], $data['title'], $data['description'], $data['priority'], $data['status']) : null;
    }

    public function findByUser(int $userId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tasks = [];
        foreach ($data as $task) {
            $tasks[] = new Task($task['id'], $task['title'], $task['description'], $task['priority'], $task['status']);
        }

        return $tasks;
    }

    public function findByTag(int $tagId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM tasks WHERE tag_id = :tag_id');
        $stmt->bindParam(':tag_id', $tagId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $tasks = [];
        foreach ($data as $task) {
            $tasks[] = new Task($task['id'], $task['title'], $task['description'], $task['priority'], $task['status']);
        }

        return $tasks;
    }

    public function save(Task $task): void
    {
        $stmt = $this->connection->prepare('INSERT INTO tasks (title, description, priority, status) VALUES (:title, :description, :priority, :status)');
        $stmt->bindParam(':title', $task->getTitle());
        $stmt->bindParam(':description', $task->getDescription());
        $stmt->bindParam(':priority', $task->getPriority());
        $stmt->bindParam(':status', $task->getStatus());
        $stmt->execute();
    }

    public function delete(Task $task): void
    {
        $stmt = $this->connection->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $task->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}
