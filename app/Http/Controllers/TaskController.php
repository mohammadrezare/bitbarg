<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Task\TaskRepositoryInterface;
use App\Models\Task;

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:400|min:1',
            'description' => 'required|max:1200|min:1',
            'datetime' => 'required|date',
        ]);
        $request = request()->merge(
            ['user_id' => auth()->id(), 'datetime' => str_replace('T', ' ', request()->datetime)]
        );
        $this->taskRepository->create($request->all());

        return redirect('tasks')->banner(__('Great! You have created the task :team.', ['team' => auth()->user()->name]),);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:400',
            'description' => 'required|max:1200',
            'datetime' => 'required|date',
        ]);
        $request = request()->merge(
            ['user_id' => auth()->id(), 'datetime' => str_replace('T', ' ', request()->datetime)]
        );

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
