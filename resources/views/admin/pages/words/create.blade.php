@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Insert a sentence @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg lilac-background">
        <div class="container col-sm-12 col-md-7">
            <h2>Insert a word</h2>
            <form class="m-5" action="{{ route('words.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="text">Word</label>
                    <input type="text" name="text" id="text" class="form-control">
                </div><br/>
                <div class="form-group">
                    <label for="word_category">Word category</label>
                    <select name="word_category_id" class="form-control" id="word_category">
                        <option value="0">Choose...</option>
                        @foreach($word_categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="word_type">Word type</label>
                    <select name="word_type_id" class="form-control" id="word_type">
                        <option value="0">Choose...</option>
                        @foreach($word_types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="inputAudio">Audio file (mp3)</label>
                    <input type="file" name="audio_file" class="form-control" id="inputAudio">
                </div>
                <div class="form-group mt-3">
                    <h4>Translations</h4>
                </div>
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
