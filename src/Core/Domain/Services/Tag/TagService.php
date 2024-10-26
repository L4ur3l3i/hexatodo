<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Services\Tag;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;
use L4ur3l3i\Hexatodo\Core\Domain\Ports\TagRepository;

class TagService
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function updateTag(Tag $tag, array $commands): Tag
    {
        foreach ($commands as $command) {
            $command->execute($tag);
        }

        $this->tagRepository->save($tag);
        return $tag;
    }
}