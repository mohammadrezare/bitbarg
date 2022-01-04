<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
            <a href="{{route('tasks.create')}}" type="button" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Creator</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{$task->id}}</th>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{str_replace('T', ' ', $task->datetime)}}</td>
                            <td>{{$task->user->name}}</td>
                            <td>
                                <a href="{{route('tasks.edit', $task->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{route('tasks.destroy' ,$task->id)}}"
                                      method="POST"> @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$tasks->links()}}
        </div>
    </div>
</x-app-layout>
