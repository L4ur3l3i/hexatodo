<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

class UpdateDescriptionCommand implements TaskCommand
{
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function execute(Task $task): void
    {
        $task->setDescription($this->description);
    }
}