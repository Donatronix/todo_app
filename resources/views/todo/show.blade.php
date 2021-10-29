<x-app-layout>
    <x-slot name="title">
        ToDo
    </x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Todo - {{ $toDo->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm sm:rounded-lg">

                <div class="mt-5">

                    <div class="">
                        <h1 class="">Title: {{ $toDo->title}}</h1>
                        <p class="">Description: {{ $toDo->description }}</p>
                        <p class="">Due Date: {{ $toDo->dueDate }}</p>
                        <p class="">Project: {{ $toDo->project->title }}</p>

                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-blue-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-blue-500 border-solid rounded outline-none hover:bg-blue-500 hover:text-white active:bg-blue-600 focus:outline-none"
                                       href="{{ route('toDos.edit', $toDo->toDo) }}">
                                        Edit
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('toDos.delete', $toDo->toDo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-red-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-red-500 border-solid rounded outline-none hover:bg-red-500 hover:text-white active:bg-red-600 focus:outline-none"
                                                type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                @if(($toDo->assignedTo->id==auth()->user()->id)||($toDo->assignedBy->id==auth()->user()->id))
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-green-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-green-500 border-solid rounded outline-none hover:bg-green-500 hover:text-white active:bg-green-600 focus:outline-none"
                                           href="{{ route('toDos.completed', $toDo->toDo) }}">
                                            Mark Completed
                                        </a>
                                    </td>
                                @endif
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
