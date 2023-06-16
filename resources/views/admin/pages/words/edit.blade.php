@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Edit a word @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg lilac-background">
        <div class="container col-sm-12 col-md-10">
            <h2>Edit a word</h2>
            <form class="m-5" action=" {{ route('words.update',['word' => $word]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="text">Word text</label>
                    <input type="text" name="text" class="form-control" id="text" value="{{ $word->text }}">
                </div><br/>
                <div class="form-group">
                    <label for="word_cat">Word Category</label>
                    <select name="word_category_id" class="form-control" id="word_cat">
                        @foreach($word_categories as $cat)
                            <option {{ $cat->id == $word->word_category_id ? "selected" : "" }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="word_type">Word type</label>
                    <select name="word_type_id" class="form-control" id="word_type">
                        @foreach($word_types as $type)
                            <option {{ $type->id == $word->word_type_id ? "selected" : "" }} value="{{ $type->id }}">{{ $type->name }}</option>
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
                    <input type="text" name="eng_translation" id="eng_translation" class="form-control" value="{{ $eng_translation->text }}">
                </div><br/>
                <div class="form-group">
                    <label for="srb_translation">Serbian translation</label>
                    <input type="text" name="srb_translation" id="srb_translation" class="form-control" value="{{ $srb_translation->text }}">
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
