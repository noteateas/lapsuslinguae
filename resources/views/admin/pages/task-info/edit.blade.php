@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Edit a sentence @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg lilac-background">
        <div class="container col-sm-12 col-md-10">
            <h2>Edit the task info</h2>
            <h4 style="border-bottom: antiquewhite solid 2px">Task: {{ $task->title }}</h4>
            <form class="m-5" action=" {{ route('task-info.update',['task_info' => $task_info]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="intro">Intro</label>
                    <input type="text" name="intro" id="intro" class="form-control" value="{{ $task_info->intro }}">
                </div><br/>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea name="text" id="text" class="form-control" rows="15">
                       {{ $task_info->text }}
                    </textarea>
                </div><br/>
                <h4>Translations</h4>
                <div class="form-group">
                    <label for="srb_intro">Serbian Intro</label>
                    <input type="text" name="srb_intro" id="srb_intro" class="form-control" value="{{ $srb_translation->intro }}">
                </div><br/>
                <div class="form-group">
                    <label for="srb_text">Serbian Text</label>
                    <textarea name="srb_text" id="srb_text" class="form-control" rows="15">
                       {{ $srb_translation->text }}
                    </textarea>
                </div><br/>
                <button type="submit" class="btn-get-started btn white-bg-button">Edit</button>
            </form>

            @if(isset($fail))
                <div class="alert alert-danger">
                    {{ $fail }}
                </div>
            @endif
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
