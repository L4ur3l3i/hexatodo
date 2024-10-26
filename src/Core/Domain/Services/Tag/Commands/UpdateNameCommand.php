<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Tag\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;

class UpdateNameCommand implements TagCommand
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function execute(Tag $tag): void
    {
        $tag->setName($this->name);
    }
}