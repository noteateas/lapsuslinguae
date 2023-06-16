@extends('client.layouts.layout')

@section('content')

    <section class="bg white-background">
        <div  class="pb-5">
            @include('client.components.practice.practice-nav')
            <div class="practice-section d-flex justify-content-center container pb-5">
                <div class="levels-container">
                    <div class="beginner tasks-container">
                        <div class="castle">
                            <h2>BEGINNER</h2>
                            <div class="image">
                                <img src="{{ asset('assets/img/lvl2.png') }}">
                            </div>
                        </div>
                        @php
                            $tmp = array();
                            $i = 0;
                        @endphp

                        @foreach($tasks as $key => $task)

                            @if($task->main_level_id == 1)
                                @if($key % 3 == 0 || $key == 0)

                                    <div class="task-container">
                                        @include('client.components.practice.task-bubble',[
                                        'task' => $task, 'disabled' => false
                                        ])
                                    </div>
                                @else
                                    @php
                                        $i++;
                                            array_push($tmp, $task);

                                            if($i == 2){

                                                echo '<div class="task-container">';
                                                foreach($tmp as $task1){
                                    @endphp
                                    @include('client.components.practice.task-bubble',[
                                        'task' => $task1, 'disabled' => false
                                     ])
                                    @php
                                        }
                                        echo '</div>';

                                        $tmp = array();
                                        $i = 0;
                                    }
                                    @endphp

                                @endif
                            @endif

                        @endforeach
                    </div>
                    <div class="intermediate tasks-container">
                        <div class="castle mt-5">
                            <h2>INTERMEDIATE</h2>
                            <div class="image">
                                <img src="{{ asset('assets/img/lvl2.png') }}">
                            </div>
                        </div>
                        @php
                            $tmp = array();
                            $i = 0;
                        @endphp

                        @foreach($tasks as $key => $task)

                            @if($task->main_level_id == 2)
                                @if($key % 3 == 0 || $key == 0)

                                    <div class="task-container">
                                        @include('client.components.practice.task-bubble',[
                                        'task' => $task, 'disabled' => !$beginner_level_finished
                                        ])
                                    </div>
                                @else
                                    @php
                                        $i++;
                                            array_push($tmp, $task);

                                            if($i == 2){

                                                echo '<div class="task-container">';
                                                foreach($tmp as $task1){
                                    @endphp
                                    @include('client.components.practice.task-bubble',[
                                        'task' => $task1, 'disabled' => !$beginner_level_finished
                                     ])
                                    @php
                                        }
                                        echo '</div>';

                                        $tmp = array();
                                        $i = 0;
                                    }
                                    @endphp

                                @endif
                            @endif

                        @endforeach
                    </div>
                    <div class="advanced tasks-container">
                        <div class="castle mt-4">
                            <h2>ADVANCED</h2>
                            <div class="image">
                                <img src="{{ asset('assets/img/lvl3.png') }}">
                            </div>
                        </div>
                        @php
                            $tmp = array();
                            $i = 0;
                        @endphp

                        @foreach($tasks as $key => $task)

                            @if($task->main_level_id == 3)
                                @if($key % 3 == 0 || $key == 0)

                                    <div class="task-container">
                                        @include('client.components.practice.task-bubble',[
                                        'task' => $task, 'disabled' => !$intermediate_level_finished
                                        ])
                                    </div>
                                @else
                                    @php
                                        $i++;
                                            array_push($tmp, $task);

                                            if($i == 2){

                                                echo '<div class="task-container">';
                                                foreach($tmp as $task1){
                                    @endphp
                                    @include('client.components.practice.task-bubble',[
                                        'task' => $task1, 'disabled' => !$intermediate_level_finished
                                     ])
                                    @php
                                        }
                                        echo '</div>';

                                        $tmp = array();
                                        $i = 0;
                                    }
                                    @endphp

                                @endif
                            @endif

                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section("scripts")
    <script src="{{ asset("assets/js/practice.js") }}"></script>
@endsection

