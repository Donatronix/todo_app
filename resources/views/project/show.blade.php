<x-app-layout>
    <x-slot name="title">
        Project
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Project Details - {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                <div class="mt-5">
                    <h1 class="text-black-500">{{ $project->title}}</h1>
                    <p class="">{{ $project->description }}</p>
                    <ul class="list-none">
                        <li>
                            <a class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-blue-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-blue-500 border-solid rounded outline-none hover:bg-blue-500 hover:text-white active:bg-blue-600 focus:outline-none"
                               href="{{ route('projects.edit', $project) }}">
                                Edit
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('projects.delete',$project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-red-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-red-500 border-solid rounded outline-none hover:bg-red-500 hover:text-white active:bg-red-600 focus:outline-none"
                                        type="submit">
                                    Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
