<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Task\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;
use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;

class AddTagCommand implements TaskCommand
{
    private Tag $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function execute(Task $task): void
    {
        $task->addTag($this->tag);
    }
}
