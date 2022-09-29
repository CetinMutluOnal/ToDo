<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ToDoResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\TodoRequest;


class ToDoController extends Controller
{
    protected $model = Todo::class;
    protected $routePrefix = 'api.todo.';

    public function index()
    {
        return response()->json(ToDoResource::collection(Todo::all()));
    }

    public function create()
    {
        //
    }

    public function store(TodoRequest $request)
    {
        $user = Auth::user();

        $toDo = new Todo($request->validated());
        $toDo->user()->associate($user);


        $toDo->save();

        return response()->json(new ToDoResource($toDo));
    }

    public function show($id)
    {
        $toDo= Todo::query()->find($id);

        return response()->json(new ToDoResource($toDo));
    }

    public function edit()
    {
        //
    }

    public function update(Request $request, $id)
    {
        $toDo = Todo::query()->find($id);

        $toDo->update($request->only(['title', 'content']));
        $toDo->save();

        return response()->json(new ToDoResource($toDo));
    }

    public function destroy($id)
    {
        $toDo = Todo::query()->find($id);

        $toDo->delete();

        return response()->json([
            'title' => trans('models.common.success'),
            'message' => trans('models.common.deleted'),
        ]);
    }
}
