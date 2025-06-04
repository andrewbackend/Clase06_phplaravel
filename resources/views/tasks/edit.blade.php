@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Tarea</h1>

<form method="POST" action="{{ route('tasks.update', $task['id']) }}" class="space-y-4">
    @csrf
    <input name="title" value="{{ $task['title'] }}" class="w-full p-2 border rounded">
    @error('title')
        <div class="text-red-500 text-sm">{{ $message }}</div>
    @enderror

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
</form>
@endsection
