
@extends('layouts.app')

@section('title')
Create Todo
@endsection

@section('content')
<div class="todoContainer">
    <div class="col-8">
<form action="" method="post" class="mt-4 p-4">
    <div class="form-group m-3">
        <label for="name">Todo Name</label>
        <input type="text" class="form-control" name="title" value="{{ $model->title }}">
    </div>
    <div class="form-group m-3">
        <label for="description">Todo Description</label>
        <textarea class="form-control" name="content" rows="3">{{ $model->content}}</textarea>
    </div>
    <div class="form-group m-3">
        <form action="{{ route('todos.update', $model->id) }}" method="PUT" id="form" enctype="form-data">
            @csrf
            @method('PUT')
            <input type="submit" class="btn btn-primary float-end" value="Update" >
            </form>
        <form action="{{ route('todos.destroy', $model->id) }}" type="submit" method="POST">

            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete </button>

        </form>
            </div>
        </form>
    </div>
</div>

@endsection