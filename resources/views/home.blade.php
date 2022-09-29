@extends('layouts.app')

@section('content')
<div class="row todoContainer">
    <div class="col-8">
        <ul class="list-group">
            <div class="mb-4" >
                <form action="{{ route ('todos.create') }}" type="submit" method="GET">
                    @csrf
                <button type="submit" class="btn btn-primary float-end"> Create New Todo</button>
                </form>
            </div>
                @foreach ($todos as $todo )
                    @if ($todo->user_id == $user->id)
                    <li class="list-group-item"><a href="{{ route('todos.show', $todo->id) }}" method="GET">{{ $todo->title }}</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" type="submit" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete </button>
                        </form>
                    </li>
                    @endif
                @endforeach
        </ul>
    </div>
</div>
@endsection
