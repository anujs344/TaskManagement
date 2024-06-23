<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        $todos = Auth::user()->todos;
        return view('todos.create',compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'completion_status' => 'required|in:0,1',
            'comments' => 'nullable|string',
        ]);

        Auth::user()->todos()->create($request->all());

        return redirect()->route('todos.create');
    }

    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo);
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $this->authorize('update', $todo);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'completion_status' => 'required|in:0,1',
            'comments' => 'nullable|string',
        ]);

        $todo->update($request->all());

        $todos = Auth::user()->todos;
        return true;
        // return redirect()->route('todos.create')->with('todos', $todos);
    }
    public function show(Todo $todo)
    {
        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
     
        $this->authorize('delete', $todo);
        $todo->delete();
        $todos = Auth::user()->todos;
        return true;
    }
  
}
