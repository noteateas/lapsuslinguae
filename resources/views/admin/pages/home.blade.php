@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Home @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')
    <section class="bg white-background admin-home">
        <div class="container">
            <h1 class="text-black">Welcome, {{ session()->get('user')->first_name }}</h1>
        </div>

        <div class="container services section-bg mt-5 flex-column">

            <div class="statistics container">
                <div>
                    <h3>Statistics</h3>
                </div>
                <div class="d-flex">
                    <div class="statistic-component">
                        <i class="fa-solid fa-book"></i>
                        <div>
                            <h4>{{ $words }}</h4>
                            <p>Words</p>
                        </div>
                    </div>
                    <div class="statistic-component">
                        <i class="fa-solid fa-feather"></i>
                        <div class="d-flex flex-column">
                            <h4>{{ $sentences }}</h4>
                            <p>Sentences</p>
                        </div>
                    </div>
                    <div class="statistic-component">
                        <i class="fa-solid fa-list-check"></i>
                        <div class="d-flex flex-column">
                            <h4>{{ $tasks }}</h4>
                            <p>Tasks</p>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="overview container">
                <div>
                    <h3>Overview</h3>
                </div>
                <div class="d-flex">
                    <div class="statistic-component">
                        <i class="fa-solid fa-user"></i>
                        <div>
                            <h4>{{ $usersLoggedIn }}</h4>
                            <p>Users logged in today</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="statistic-component">
                        <i class="fa-solid fa-flag-checkered"></i>
                        <div>
                            <h4>{{ $userProgress }}</h4>
                            <p>Finished challenges today</p>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="overview container">
                <div>
                    <h3>Why are users learning a language</h3>
                </div>
                <div class="d-flex flex-wrap">
                    @foreach($whyLearnLanguage as $el)
                        <div class="statistic-component">
                            <i class="fa-solid fa-language"></i>
                            <div>
                                <h4>{{ $el->title }}</h4>
                                <p>{{ $el->totalUsers }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>

        </div>
    </section>
@endsection
