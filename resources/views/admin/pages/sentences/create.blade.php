@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Insert a sentence @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg lilac-background">
        <div class="container col-sm-12 col-md-7">
            <h2>Insert a sentence</h2>
            <form class="m-5" action=" {{ route('sentences.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="text">Sentence text</label>
                    <input type="text" name="text" class="form-control" id="text" placeholder="Text">
                </div><br/>
                <div class="form-group">
                    <label for="task">Task</label>
                    <select name="task_id" class="form-control" id="task">
                        <option value="0">Choose...</option>
                        @foreach($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->title }}</option>
                        @endforeach
                    </select>
                </div><br>
                <h4>Translations</h4>
                <div class="form-group">
                    <label for="eng_translation">English translation</label>
                    <input type="text" name="eng_translation" id="eng_translation" class="form-control">
                </div><br/>
                <div class="form-group">
                    <label for="srb_translation">Serbian translation</label>
                    <input type="text" name="srb_translation" id="srb_translation" class="form-control">
                </div><br/>
                <button type="submit" class="btn-get-started btn white-bg-button">Insert</button>
            </form>

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
