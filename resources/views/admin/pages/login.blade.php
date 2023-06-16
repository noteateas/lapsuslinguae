@extends('admin.layouts.layout')

@section('title') Lapsus Linguae - Admin Login @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae
@endsection

@section('content')

    <section id="main" class="bg login-container lilac-background">
        <div class="container col-sm-12 col-md-7">
            <h1>Admin Login</h1>
            <form class="m-5" action=" {{ route('admin-login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control" aria-describedby="emailHelp" placeholder="Email or username">
                </div><br/>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div><br/>
                <button type="submit" class="btn-get-started btn white-bg-button">Login</button>
            </form>

            @if(session()->has('loginFail'))
                <div class="alert alert-danger">
                    {{ session()->get('loginFail')}}
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
