<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

class UpdatePriorityCommand implements TaskCommand
{
    private int $priority;

    public function __construct(int $priority)
    {
        $this->priority = $priority;
    }

    public function execute(Task $task): void
    {
        $task->setPriority($this->priority);
    }
}