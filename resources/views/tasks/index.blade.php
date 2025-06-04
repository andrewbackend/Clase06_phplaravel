@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Lista de Tareas</h1>
<a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Nueva Tarea</a>

<ul class="mt-4 space-y-2">
    @forelse($tasks as $task)
        <li class="flex justify-between items-center bg-gray-100 p-3 rounded">
            <span>{{ $task['title'] }}</span>
            <div class="space-x-2">
                <a href="{{ route('tasks.edit', $task['id']) }}" class="bg-yellow-400 px-3 py-1 rounded">Editar</a>
                <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Eliminar</button>
                </form>
            </div>
        </li>
    @empty
        <li>No hay tareas aún.</li>
    @endforelse
</ul>
@endsection
