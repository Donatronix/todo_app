<x-app-layout>
    <x-slot name="title">
        ToDo
    </x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('ToDo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('toDos.create') }}" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-green-500 uppercase transition-all duration-150 ease-linear bg-transparent border border-green-500 border-solid rounded outline-none hover:bg-green-500 hover:text-white active:bg-green-600 focus:outline-none" type="button">
                        Create ToDo
                    </a>
                </div>
            </div>
        </div>
        @include('errors.list')
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="mt-3 row">
                    <div class="col-12 align-self-center">
                        <ul class="list-group">
                            @foreach($toDos as $toDo)
                            <li class="list-group-item"><a href="{{ route('toDos.show',$toDo) }}" style="color: cornflowerblue">{{$toDo->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
