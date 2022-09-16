<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index() {
        return view('welcome')
        ->with('todos', Todo::all());
    }
    public function show($id) {

        $model = Todo::query()->find($id);

        return view ('crud.update')
        ->with('todos', Todo::all())
        ->with('model', $model);
    }

    public function create(Request $request) {
        return view ('crud.create')
        ->with('todos', Todo::all());
    }

    public function store(Request $request) {

        $todo = new Todo($request->only(['title','content']));

        $todo->save();

        return redirect()->route('index')
            ->with('success', trans('models.common.save'));
    }

    public function update(Request $request,$id) {

        $model = Todo::query()->find($id);

        $model->update($request->only(['title', 'content']));
        $model->save();

        return view ('crud.update')
        ->with('todos', Todo::all())
        ->with('model', $model);
    }

    public function destroy($id)
    {
        $toDo = Todo::query()->find($id);

        $toDo->delete();

        return redirect('/todos')->with('success', 'Data Deleted');
    }
}
