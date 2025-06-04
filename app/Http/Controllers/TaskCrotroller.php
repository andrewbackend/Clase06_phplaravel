<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskCrotroller extends Controller
{
    public function index()
    {
        $tasks = session('tasks', []); 
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title'=> 'required']);

        $tasks = session('task', []);
        $tasks[] = ['id' => uniqid(), 'title' => $request->title];
        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index');
    }

    public function edit ($id)
    {
         $tasks = session('task', []);
         $task = collect($tasks)->firstWhere('id', $id);

         return view('task.edit', compact('task'));
    }
    
    public function update (Request $request, $id){
        $request->validate(['title' => 'required']);

        $tasks = session('tasks', []);
        $tasks = array_filter($tasks, fn($task) => $task['id' !== $id]);
        session(['tasks' => array_values($tasks)]);

        return redirect()->route(('tasks.index'));
    }

    public function destroy($id)
    {
        $tasks = session('tasks', []);
        $tasks = array_filter($tasks, fn($task) => $task['id'] !== $id);
        session(['tasks' => array_values($tasks)]);

        return redirect()->route(('tasks.index'));
    }
}
