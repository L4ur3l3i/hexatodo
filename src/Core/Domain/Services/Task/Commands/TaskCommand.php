<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

interface TaskCommand
{
    public function execute(Task $task): void;
}
