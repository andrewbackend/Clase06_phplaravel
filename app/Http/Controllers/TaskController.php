<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = session('tasks', []);
        $search = $request->query('search');

        if($search) {
            $tasks = array_filter($tasks, fn($t) => stripos($t['title'], $search) !== false);
        }

        //Orden: pendientes primero
        usort($tasks, fn($a, $b) => $a['completed'] <=> $b['completed']);

        //Contadores
        $completed = collect($tasks)->where('completed', true)->count();
        $pending = collect($tasks)->where('completed', false)->count();


        return view('tasks.index', compact('tasks', 'search', 'completed', 'pending' ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);

        $tasks = session('tasks', []);
        $tasks[] = ['id' => uniqid(), 'title' => $request->title, 'completed' => false];
        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $tasks = session('tasks', []);
        $task = collect($tasks)->firstWhere('id', $id);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['title' => 'required']);

        $tasks = session('tasks', []);
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['title'] = $request->title;
                break;
            }
        }
        session(['tasks' => $tasks]);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $tasks = session('tasks', []);
        $tasks = array_filter($tasks, fn($task) => $task['id'] !== $id);
        session(['tasks' => array_values($tasks)]);

        return redirect()->route('tasks.index');
    }

    public function toggle($id)
    {
        $tasks = session('tasks', []);
        foreach ($tasks as &$task) {
            if ($task['id'] === $id) {
                $task['completed'] = !$task['completed']; //cambiar estado
                break;
            }
        }
        session(['tasks' => $tasks]);
        return redirect()->rout('tasks.index');
    }

    public function clearAll()
    {
        session()->forget('tasks');
        return redirect()->route('tasks.index');
    }
}
