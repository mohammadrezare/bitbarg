<?php

namespace App\Repository\Task;

interface TaskRepositoryInterface
{
    public function all();
    public function create($task);
    public function get($id);
    public function update($id, $task);
    public function delete($id);
}
