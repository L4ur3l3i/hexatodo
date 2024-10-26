<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Tag\Commands;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;

interface TagCommand
{
    public function execute(Tag $tag): void;
}