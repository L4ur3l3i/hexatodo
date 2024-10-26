<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;
use L4ur3l3i\Hexatodo\Core\Domain\Ports\TaskRepository;

class TaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function updateTask(Task $task, array $commands): Task
    {
        foreach ($commands as $command) {
            $command->execute($task);
        }

        $this->taskRepository->save($task);
        return $task;
    }
}
