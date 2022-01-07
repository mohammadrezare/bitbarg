<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repository\Task\TaskRepositoryInterface;
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
        return response()->json($tasks);
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
        
        $request = $request->merge(['user_id' => $user->id]);

        $this->taskRepository->create($request->all());

        return response()->json(['text' =>  __('Great! You have created the task :team.', ['team' => $user->name])]);
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
        $request = $request->merge(['user_id' => auth()->user()->id]);

        $this->taskRepository->update($id, $request->all());

        return response()->json(['text' =>  __('The task has been updated !')]);
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

        return response()->json(['text' =>  __('The task has been deleted !')]);
    }
}
