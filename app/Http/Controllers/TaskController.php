<?php

namespace App\Http\Controllers;

use App\Repository\Task\TaskRepositoryInterface;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskRepository->all();
        return view('todos/list')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $user = auth()->user();

        $request->merge(['user_id' => $user->id, 'datetime' => str_replace('T', ' ', $request->datetime)]);

        $this->taskRepository->create($request->all());

        return redirect('tasks')->banner(__('Great! You have created the task :team.', ['team' => $user->name]),);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->taskRepository->get($id);

        return view('todos/edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $request->merge(['user_id' => auth()->user()->id, 'datetime' => str_replace('T', ' ', $request->datetime)]);

        $this->taskRepository->update($id, $request->all());

        return redirect('tasks')->banner(__('The task has been updated !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taskRepository->delete($id);

        return redirect('tasks')->banner(__('The task has been deleted !'));
    }
}
