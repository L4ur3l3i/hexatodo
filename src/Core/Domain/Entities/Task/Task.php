<?php

namespace L4ur3l3i\Hexatodo\Core\Domain\Entities\Task;

use InvalidArgumentException;
use L4ur3l3i\Hexatodo\Core\Domain\Entities\Tag\Tag;
use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;

class Task
{
    private int $id;
    private string $title;
    private string $description;
    private string $status;
    private int $priority;
    private User $user;
    private array $tags;

    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in progress';
    const STATUS_DONE = 'done';

    public function __construct(
        int $id,
        string $title,
        string $description,
        int $priority,
        User $user,
        string $status = self::STATUS_NEW,
        array $tags = [] 
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->priority = $priority;
        $this->user = $user;
        $this->tags = $tags; 
    }    

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, [self::STATUS_NEW, self::STATUS_IN_PROGRESS, self::STATUS_DONE])) {
            throw new InvalidArgumentException('Invalid task status');
        }
        $this->status = $status;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $index = array_search($tag, $this->tags, true);
        if ($index !== false) {
            unset($this->tags[$index]);
        }
        return $this;
    }
}
