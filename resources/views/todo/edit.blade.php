<x-app-layout>
    <x-slot name="title">
        ToDo
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{ route('toDos.index') }}">ToDo</a> - Edit - {{ $toDo->todo()->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @include('errors.list')
                <form action="{{ route('toDos.update', $toDo->todo()) }}" method="post" class="p-4 mt-4">
                    @csrf
                    @method('PUT')
                    <div class="m-3 form-group">
                        <label for="title">Title</label>
                        <div>
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title', $toDo->todo()->title) }}" required>
                            @error('title')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="description">Description</label>
                        <div>
                            <textarea class="form-control" name="description" rows="3"
                                      required>{{ old('description', $toDo->todo()->description) }}</textarea>
                            @error('description')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="assign">Assign To</label>
                        <div>
                            <select class="form-control" name="assign" required>
                                <option>Select who to assign task to</option>
                                @foreach ($users as $user)
                                    <option @if(old('assign', $toDo->todoAssignedTo()->id)==$user->id) selected
                                            @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('assign')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="project">Project</label>
                        <div>
                            <select class="form-control" name="project" required>
                                <option>Select project</option>
                                @foreach ($projects as $project)
                                    <option @if(old('project', $toDo->project()->id)==$project->id) selected
                                            @endif value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                            @error('project')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="priority">Priority</label>
                        <div>
                            <select class="form-control" name="priority" required>
                                <option>Select priority</option>
                                <option @if(old('priority', $toDo->todo()->priority)=='low') selected
                                        @endif value="low">
                                    Low
                                </option>
                                <option @if(old('priority', $toDo->todo()->priority)=='medium') selected
                                        @endif value="medium">Medium
                                </option>
                                <option @if(old('priority', $toDo->todo()->priority)=='high') selected
                                        @endif value="medium">High
                                </option>
                            </select>
                            @error('priority')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="dueDate">Due Date</label>
                        <div>
                            {!! Form::date('dueDate', old('dueDate', $toDo->todo()->dueDate), ['required'=>'required']) !!}
                            @error('dueDate')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <input type="submit" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-green-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-green-500 border-solid rounded outline-none hover:bg-green-500 hover:text-white active:bg-green-600 focus:outline-none" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
