@extends('layout')

@section('content')

<h1 class="text-2x1 font-bold mb-4">Editar tarea</h1>
<form method="POST" action="{{ route('tasks.update, $task['id']')}}" class="space-y-4">
    @csrf 
    <input name="title" class="{{$task['title']}}" class="w-full p-2 border rounded">
    @error('title')
        <div class="text-red-500 text-sm">{{$message}}</div>
    @enderror

    <button class="bg-green-500 text-white px-4 py-rounded">Actualizar</button>
</form>
@endsection