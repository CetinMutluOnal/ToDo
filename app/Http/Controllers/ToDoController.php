<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\TodoRequest;

class ToDoController extends Controller
{

    public function index() {
        return view('auth.login')
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

    public function store(TodoRequest $request) {

        $user = $request->user();

        $todo = new Todo($request->validated());
        $todo->user()->associate($user);


        $todo->save();

        return redirect()->route('home')
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

        return redirect('home')->with('success', 'Data Deleted');
    }
}
