<?php

class Tag
{
    private int $id;
    private string $name;
    private array $tasks;

    public function __construct(
        int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->tasks = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!in_array($task, $this->tasks)) {
            $this->tasks[] = $task;
        }
        return $this;
    }

    public function removeTask(Task $task): self
    {
        $index = array_search($task, $this->tasks, true);
        if ($index !== false) {
            unset($this->tasks[$index]);
        }
        return $this;
    }
}
