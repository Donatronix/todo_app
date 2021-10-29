<x-app-layout>
    <x-slot name="title">
        Project
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="{{ route('projects.index') }}">Projects</a> - Edit {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @include('errors.list')
                <form action="{{ route('projects.update', $project) }}" method="post" class="p-4 mt-4">
                    @csrf
                    @method('PUT')
                    <div class="m-3 form-group">
                        <label for="title">Title</label>
                        <div>
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title', $project->title) }}" required>
                            @error('title')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <label for="description">Description</label>
                        <div>
                            <textarea class="form-control" name="description" rows="3"
                                      required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                            <div class="font-bold text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="m-3 form-group">
                        <input type="submit"
                               class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-green-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-green-500 border-solid rounded outline-none hover:bg-green-500 hover:text-white active:bg-green-600 focus:outline-none"
                               value="Update">
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
