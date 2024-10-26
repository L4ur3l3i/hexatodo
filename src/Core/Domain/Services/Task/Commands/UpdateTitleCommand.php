<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

class UpdateTitleCommand implements TaskCommand
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function execute(Task $task): void
    {
        $task->setTitle($this->title);
    }
}
