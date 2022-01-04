<?php

namespace App\Repository\Task;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function all()
    {
        return Task::where('user_id', auth()->user()->id)->orderBy('datetime', 'ASC')->paginate(10);
    }

    public function create($task)
    {
        return Task::create($task);
    }

    public function get($id)
    {
        return Task::find($id);
    }

    public function update($id, $task)
    {
        $db_task = Task::find($id);
        return $db_task->update($task);
    }

    public function delete($id)
    {
        return Task::destroy($id);
    }
}
