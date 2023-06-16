@extends('client.layouts.layout')

@section('title')  @endsection
@section('description')
@endsection
@section('keywords') tips, task info, info, task information, help @endsection

@section('content')

    <section id="main" class="bg practice-info white-background pb-3">
        <div class="container d-flex flex-wrap pt-5 pb-3">
            <div class="col-md-6">

                @if(session()->get('user')->language_id == 1)
                    <h1>{{ ucfirst($task->title) }}</h1>
                    <p>{{ $task_info->intro }}</p>
                    <p>{!! nl2br($task_info->text) !!}</p>
                @elseif(session()->get('user')->language_id == 2)
                        <h1>{{ ucfirst($task->srb_translation) }}</h1>
                    <p>{{ $task_info->srb_translation->intro }}</p>
                    <p>{!! nl2br($task_info->srb_translation->text) !!}</p>
                @endif

            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img style="height: 500px" src="{{ asset('assets/img/home-ct.png') }}" alt="aesthetic photo">
            </div>
        </div>
        <div class="container pb-5">
            @if(session()->get('user')->language_id == 1)
                <a href="{{ route('task', $task->id) }}" class="btn-get-started btn orange-bg-button">Try practicing this level</a>
            @elseif(session()->get('user')->language_id == 2)
                <a href="{{ route('task', $task->id) }}" class="btn-get-started btn orange-bg-button">Vežbaj nivo ovde</a>
            @endif
        </div>
    </section>

@endsection
