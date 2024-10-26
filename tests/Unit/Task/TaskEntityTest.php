<?php

namespace L4ur3l3i\Hexatodo\Tests\Unit;

use L4ur3l3i\Hexatodo\Core\Domain\Entities\Task\Task;
use L4ur3l3i\Hexatodo\Core\Domain\Entities\User\User;
use PHPUnit\Framework\TestCase;

#[\PHPUnit\Framework\Attributes\CoversClass(Task::class)]
class TaskEntityTest extends TestCase
{
    public function testTaskTitleCanBeUpdated(): void
    {
        $user = new User(1, 'testuser', 'user@example.com', 'password123');
        $task = new Task(1, 'Initial Title', 'Description', 1, $user);

        $task->setTitle('Updated Title');
        $this->assertEquals('Updated Title', $task->getTitle());
    }
}
