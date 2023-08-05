<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index')->with('todos', $todos);
    }
    public function show(Todo $todo)
    {
        return view('todos.show')->with('todo', $todo);
    }
    public function create()
    {
        return view('todos.create');
    }
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);
        $data = request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        session()->flash('success', 'Todo created successfully.');

        return redirect('/todos');
    }
    public function edit($todoId)
    {
        return view('todos.edit')->with('todo', Todo::find($todoId));
    }
    public function update($todoId)
    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required'
        ]);
        $data = request()->all();

        $todo = Todo::find($todoId);

        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        session()->flash('success', 'Todo updated successfully.');

        return redirect('/todos');

    }
    public function destroy($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->delete();
        session()->flash('success', 'Todo destroyed successfully.');
        return redirect('/todos');
    }
    public function complete(Todo $todo){
        $todo->completed = true;
        $todo->save();

        session()->flash('success', 'Todo completed successfully.');

        return redirect('/todos');
    }
}
