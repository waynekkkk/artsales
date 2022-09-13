@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row justify-content-center text-center" style="text-colo">
            <div class="col col-md-6">
                @if (!empty($task->img_path))
                    <img src="{{ asset('images/' . $task->img_path) }}" class="rounded img-fluid pt-5">
                @endif

                <h3 class="pt-4">Task ID</h3>
                <h1>{{ $task->id }}</h1>

                <p>
                    {{ $task->description }}
                </p>
                <p>
                    Done by: {{ $task->user_id }}
                </p>
                <p>
                    <a href="/tasks/{{ $task->id }}/edit" class="btn btn-dark btn-block">Edit &rarr;</a>
                </p>
            </div>


        </div>
                

    </div>
@endsection