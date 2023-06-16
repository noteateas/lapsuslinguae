@extends('client.layouts.layout')

@section('title')  @endsection
@section('description')
@endsection
@section('keywords') lapsus linguae, lapsus, linguae, register, profile @endsection

@section('content')
        <section id="main" class="bg register-container lilac-background">
            <div class="container survey survey-one active">
                <h1>Why are you learning a language?</h1>
                <section class="reg-services d-flex p-0">
                    @foreach($why_learn_a_language as $key => $reason)

                        @include('client.components.register.why-learn-a-language',[
                                'reason' => $reason,
                                'svg_container' => $svg_container_animation[$key]
                                ])
                    @endforeach


                </section>
            </div>

            <div class="container col-11 col-md-9 survey survey-two">
                <h1>Register</h1>
                <form class="m-5" id="register-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Your date of birth</label>
                        <input type="date" name="birth_date" class="form-control" id="birth_date" value="{{ old('birth_date') }}">
                    </div>
                </form>
                <div class="alert alert-danger" id="register-form-errors">

                </div>
                @if ($errors->any())
                    <div class="alert alert-danger" >
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('regFail'))
                    <div class="alert alert-danger">
                        {{ session()->get('regFail') }}
                    </div>
                @endif
                <div class="p-5">
                    <button type="button" class="btn-get-started btn white-bg-button btn-previous">Previous</button>
                    <button type="button" id="validate-register-form" class="btn-get-started btn white-bg-button active">Next</button>
                </div>
            </div>

            <div class="container col-md-8 col-lg-7 survey survey-three">
                <div class="form-group">
                    <h1>Last step!<br> Add a profile picture if you want.</h1>
                    <label for="InputProfilePicture">Profile Picture</label>
                    <input type="file" form="register-form" name="profile_picture" class="form-control custom-file-input" id="InputProfilePicture">
                    <div>

                    </div>
                </div>

                <div class="p-5">
                    <button type="button" class="btn-get-started btn white-bg-button btn-previous">Previous</button>
                    <button type="submit" form="register-form" class="btn-get-started btn white-bg-button">Register</button>
                </div>

            </div>
        </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/register-page.js')}}"></script>
@endsection
