@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Words @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg white-background admin-index ">
        <div class="container col-sm-12 col-md-9 pt-5">
            <h2>Words</h2>
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
                <form method="GET" action="{{ route('words.index') }}">
                    @csrf
                    <div class="form-group">
                        <label class="mb-2" for="search-word">Search words</label>
                        <input type="search" name="search-word" class="form-control" placeholder="Type something...">
                    </div><br>
                    <div class="form-group">
                        <select name="word_categories" class="form-control">
                            <option value="0">Choose a category</option>
                            @foreach($word_categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <select name="word_types" class="form-control">
                            <option value="0">Choose a type</option>
                            @foreach($word_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div><br>
                    <div class="form-group">
                        <button class="btn-get-started btn orange-bg-button">Search</button>
                    </div>
                </form>
            </div>

            <div class="row mt-4 pt-5">
                <table class="table admin-table">
                    <thead>
                    <tr>
                        <th>Italian</th>
                        <th>English</th>
                        <th>Srpski</th>
                        <th>Audio</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody id="words-table-body">
                    @foreach($words as $word)
                        <tr>
                            <td>{{ $word->text }}</td>
                            @foreach($word->translations as $translation)
                                <td>{{ $translation->text }}</td>
                            @endforeach
                            <td>
                                @if($word->audio_file == null)
                                    <i class="fa-solid fa-volume-high audio-word"></i>
                                @else
                                    <audio id="word-player-{{ $word->id  }}">
                                        <source src="{{ asset('assets/audio/words/'.$word->audio_file) }}" type="audio/mp3">
                                    </audio>
                                    <i onclick="document.getElementById('word-player-'+{{ $word->id }}).play()" class="fa-solid fa-volume-high audio-word"></i>
                                @endif
                            </td>
                            <td><a class="btn-get-started btn orange-bg-button" href="{{ route('words.edit', ['word' => $word->id]) }}">Edit</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('words.destroy', ['word' => $word->id]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn-get-started btn orange-bg-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination-container pt-5 pb-5">
                    {{ $words->links('pagination::bootstrap-4') }}
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
