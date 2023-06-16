@extends('client.layouts.layout')

@section('title') Lapsus Linguae - Your Profile @endsection
@section('description')
@endsection
@section('keywords') lapsus linguae, lapsus, linguae, profile, my profile @endsection


@section('content')
    <section class="bg profile">
        <div class="profile-info container">
            <div class="main-profile-info">
                @php
                    if(session()->get('user')->profile_picture == null){
                    echo
                    '<i id="profile-picture" class="fa-solid fa-circle-user" style="font-size: 140px"></i>';
                    }
                    else{
                        echo
                    '<img id="profile-picture" src=' . asset("/storage/img/profile_pictures/")."/" .session()->get('user')->profile_picture .' alt="profile-picture">
                                &nbsp;&nbsp;';
                    }
                @endphp
                <div class="profile-details">
                    <h1>{{ session()->get('user')->first_name }}</h1>
                    <p>{{ session()->get('user')->username }}</p>
                    @if(session('user')->language_id == 1)
                        <p>joined {{ date_format(session()->get('user')->created_at,'F Y')  }}</p>
                    @elseif(session('user')->language_id == 2)
                        <p>pridružili ste se {{ date_format(session()->get('user')->created_at,'M Y')  }}</p>
                    @endif
                    <img src="{{ asset('assets/img/italy-flag-small.png') }}" alt="it-flag" class="practice-nav-img">
                </div>
            </div>
            <div>
                @if(session('user')->language_id == 1)
                    <a href="{{ route('edit-profile') }}">
                        <button class="btn-get-started btn orange-bg-button">Edit profile</button>
                    </a>
                @elseif(session('user')->language_id == 2)
                    <a href="{{ route('edit-profile') }}">
                        <button class="btn-get-started btn orange-bg-button">Izmeni profil</button>
                    </a>
                @endif

            </div>
        </div>

        @if(session()->has('changePasswordSuccess'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session()->get('changePasswordSuccess') }}
                </div>
            </div>
        @endif
        @if(session()->has('editProfileSuccess'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session()->get('editProfileSuccess') }}
                </div>
            </div>
        @endif
        @if(session()->has('editGoalSuccess'))
            <div class="container">
                <div class="alert alert-success">
                    {{ session()->get('editGoalSuccess') }}
                </div>
            </div>
        @endif

        <div class="statistics container">
            <div>
                <h3>Statistics</h3>
            </div>
            <div class="d-flex">
                <div class="statistic-component">
                    <i class="fa-solid fa-crown"></i>
                    <div>
                        <h4>{{ $levelsFinished }}</h4>
                        @if(session('user')->language_id == 1)
                            <p>Levels finished</p>
                        @elseif(session('user')->language_id == 2)
                            <p>Završeno nivoa</p>
                        @endif
                    </div>
                </div>
                <div class="statistic-component">
                    <i class="fa-solid fa-fire"></i>
                    <div class="d-flex flex-column">
                        <h4>
                            @if(session('user')->streak == null)
                                0
                            @else
                                {{ session('user')->streak }}
                            @endif
                        </h4>
                        @if(session('user')->language_id == 1)
                            <p>Streak</p>
                        @elseif(session('user')->language_id == 2)
                            <p>Dana za redom</p>
                        @endif
                    </div>
                </div>
            </div>

        </div><br>
        <div class="information container">
            <div>
                <h3>Information</h3>
            </div>
            <div class="d-flex">
                <div class="statistic-component">
                    <i class="fa-solid fa-fire"></i>
                    <div class="d-flex flex-column">
                        <h4>
                            @if(session()->get('user')->daily_goal == null)
                                0
                            @else
                                {{ session()->get('user')->daily_goal }}
                            @endif
                        </h4>
                        @if(session('user')->language_id == 1)
                            <p>Daily goal</p>
                        @elseif(session('user')->language_id == 2)
                            <p>Dnevni cilj</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="statistic-component">
                    <i class="fa-solid fa-earth-americas"></i>
                    <div class="d-flex flex-column">
                        @if(session('user')->language_id == 1)
                            <h4>English</h4>
                            <p>Your language</p>
                        @elseif(session('user')->language_id == 2)
                            <h4>Srpski</h4>
                            <p>Vaš jezik</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
