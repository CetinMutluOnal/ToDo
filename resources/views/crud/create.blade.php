@extends('layouts.app')

@section('title')
Create Todo
@endsection

@section('content')
<form action="" method="post" class="mt-4 p-4">
    <div class="form-group m-3">
        <label for="name">Todo Name</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group m-3">
        <label for="description">Todo Description</label>
        <textarea class="form-control" name="content" rows="3"></textarea>
    </div>
    <div class="form-group m-3">
        <div class="form-group m-3">
            <form action="{{ route('store')}}" type="submit" method="post" enctype="form-data">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-primary float-end">Create</Button>
            </form>
    </div>
</form>
@endsection