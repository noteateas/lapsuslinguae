@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Task Info @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg white-background admin-index ">
        <div class="container col-sm-12 col-md-9 pt-5">
            <h2>Tasks - Choose to edit info</h2>
            <div class="row">
                @if(session()->has('fail'))
                    <div class="alert alert-success">
                        {{ session()->get('fail') }}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>

            <div class="row mt-4 pt-5">
                <table class="table admin-table">
                    <thead>
                    <tr>
                        <th>Task</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody id="words-table-body">
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td><a class="btn-get-started btn orange-bg-button" href="{{ route('task-info.edit', ['task_info' => $task->id]) }}">Edit info</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination-container pt-5 pb-5">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            </div>

            @php
                foreach ($errors->all() as $message) {
                    echo '<div class="alert alert-danger">'.
                        $message .
                    '</div>';
                 }
            @endphp

        </div>
    </section>

@endsection
