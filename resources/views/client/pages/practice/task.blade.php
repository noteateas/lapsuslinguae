@extends('client.layouts.practice-layout')

@section('content')

    <section class="bg task-background lilac-background" id="background">
        @if($type === 'write_this_in_english')
            @include('client.components.practice.write-this-in-english',['sentence',$sentence])

        @elseif($type === 'select_the_missing_word')
            @include('client.components.practice.select-the-missing-word',['sentence',$sentence])

        @elseif($type === 'select_the_matching_pairs')
            @include('client.components.practice.select-the-matching-pairs')
        @endif


    </section>

@endsection

@section('scripts')

    @if($type === 'write_this_in_english')
        <script src="{{ asset('assets/js/write-this-in-english.js') }}"></script>

    @elseif($type === 'select_the_missing_word')
        <script src="{{ asset('assets/js/select-the-missing-word.js') }}"></script>

    @elseif($type === 'select_the_matching_pairs')
        <script src="{{ asset('assets/js/select-the-matching-pairs.js') }}"></script>
    @endif

@endsection
