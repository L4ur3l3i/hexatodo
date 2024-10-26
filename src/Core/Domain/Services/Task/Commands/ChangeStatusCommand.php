<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

class ChangeStatusCommand implements TaskCommand
{
    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function execute(Task $task): void
    {
        $task->setStatus($this->status);
    }
}
