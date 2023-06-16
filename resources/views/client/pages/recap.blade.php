@extends('client.layouts.layout')

@section('title') Lapsus Linguae - Your Profile @endsection
@section('description')
@endsection
@section('keywords') lapsus linguae, lapsus, linguae, profile, words, recap @endsection


@section('content')
    <section class="bg white-background recap">
        <div class="d-flex flex-column justify-content-center align-items-center pt-4">
            <div class="d-flex flex-column justify-content-center col-lg-6 mb-4">
                <div>
                    @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            <h1>Learn and remember italian words</h1>
                        @elseif(session()->get('user')->language_id == 2)
                            <h1>Nauči i zapamti italijanske reči</h1>
                        @endif
                    @else
                        <h1>Learn and remember italian words</h1>
                    @endif
                </div>
                <div>
                    <form action="{{ route('recap') }}" method="GET">
                        @csrf
                        <div class="form-group pb-3">
                            @if(session()->has('user'))
                                @if(session()->get('user')->language_id == 1)
                                    <label for="search-word">Search words</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="search-word">Pretraži reči</label>
                                @endif
                            @else
                                <label for="search-word">Search words</label>
                            @endif
                            <input type="text" id="search-word" name="search_word" class="form-control">
                        </div>
                        <div class="form-group pb-3">
                           <select name="word_categories" id="word-categories" class="form-select">
                               @if(session()->has('user'))
                                   @if(session()->get('user')->language_id == 1)
                                       <option value="0">Select category</option>
                                   @elseif(session()->get('user')->language_id == 2)
                                       <option value="0">Odaberi kategoriju</option>
                                   @endif
                               @else
                                   <option value="0">Select category</option>
                               @endif
                               @foreach($word_categories as $word_category)
                                   <option value="{{ $word_category->id }}" >{{ $word_category->name }}</option>
                               @endforeach
                           </select>
                        </div>
                        <div class="form-group pb-3">
                            @if(session()->has('user'))
                                @if(session()->get('user')->language_id == 1)
                                    <input type="submit" id="search-words-button" value="Search" class="btn-get-started btn orange-bg-button">
                                @elseif(session()->get('user')->language_id == 2)
                                    <input type="submit" id="search-words-button" value="Pretraži" class="btn-get-started btn orange-bg-button">
                                @endif
                            @else
                                <input type="submit" id="search-words-button" value="Search" class="btn-get-started btn orange-bg-button">
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6" id="words-table-container">
                <table class="table" id="words-table">
                    <thead>
                        <tr>
                            @if(session()->has('user'))
                                @if(session()->get('user')->language_id == 1)
                                    <th>Italian</th>
                                    <th>English</th>
                                @else
                                    <th>Italijanski</th>
                                    <th>Srpski</th>
                                @endif
                            @else
                                <th>Italian</th>
                                <th>English</th>
                                <th>Srpski</th>
                            @endif
                            <th>Audio</th>
                        </tr>
                    </thead>
                    <tbody id="words-table-body">
                    @foreach($words as $word)
                        <tr>
                            <td>{{ $word->text }}</td>
                                @foreach($word->translations as $translation)
                                    @if(session()->has('user'))
                                        @if($translation->language_id == session()->get('user')->language_id)
                                            <td>{{ $translation->text }}</td>
                                        @endif
                                    @else
                                            <td>{{ $translation->text }}</td>
                                    @endif
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
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="pagination-container pt-5 pb-5">
                    {{ $words->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/recap.js') }}"></script>
@endsection

