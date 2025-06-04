@extends('layout')

@section('content')

<h1 class="text-2x1 font-bold mb-4">Nueva Tarea</h1>
<form method="POST" action="{{ route('tasks.store')}}" class="space-y-4">
    @csrf 
    <input name="title" class="w-full p-2 border rounded" placeholder="Nombre de la tarea">
    @error('title')
        <div class="text-red-500 text-sm">{{$message}}</div>
    @enderror

    <button class="bg-green-500 text-white px-4 py-rounded">Guardar</button>
</form>
@endsection