<x-app-layout xmlns="http://www.w3.org/1999/html">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
            <a href="{{route('tasks.index')}}" type="button" class="btn btn-success btn-sm">
                <i class="fas fa-list"></i>
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{route('tasks.store')}}" method="post">
                @csrf
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                               maxlength="400" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"
                                  maxlength="1200" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Creator</label>
                        <input class="form-control" type="text" value="{{auth()->user()->name}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Date time</label>
                        <input class="form-control" name="datetime" type="datetime-local"
                               value="{{date('Y-m-d').'T'.date('h:i')}}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="form-control btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
