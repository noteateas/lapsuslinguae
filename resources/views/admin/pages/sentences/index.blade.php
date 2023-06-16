@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Sentences @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg white-background admin-index">
        <div class="container col-sm-12 col-md-7 pt-5">
            <h2>Sentences</h2>
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

            <div class="row">
                <form method="GET" action="{{ route('sentences.index') }}">
                    @csrf
                    <div class="form-group">
                        <label class="mb-2" for="search-word">Search sentences</label>
                        <input type="search" name="search-word" class="form-control" placeholder="Type something...">
                    </div><br>
                    <div class="form-group">
                        <select name="tasks" class="form-control">
                            <option value="0">Choose a task</option>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <button class="btn-get-started btn orange-bg-button">Search</button>
                    </div>
                </form>
            </div>

            <!-- from words table -->
            <div class="row mt-4 pt-5">
                <table class="table admin-table">
                    <thead>
                    <tr>
                        <th>Italian</th>
                        <th>English</th>
                        <th>Srpski</th>
                        <th>Task</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="words-table-body">
                    @foreach($sentences as $sentence)
                        <tr>
                            <td>{{ $sentence->text }}</td>
                            @foreach($sentence->translations as $translation)
                                <td>{{ $translation->text }}</td>
                            @endforeach
                            <td>
                                {{ $sentence->task->title }}
                            </td>
                            <td>
                                <a class="btn-get-started btn orange-bg-button" href="{{ route('sentences.edit', ['sentence' => $sentence->id]) }}">Edit</a>                            </td>
                            <td>
                                <form method="POST" action="{{ route('sentences.destroy', ['sentence' => $sentence->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn-get-started btn orange-bg-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination-container pt-5 pb-5 d-flex">
                    {{ $sentences->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <!-- -->

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
