@extends('client.layouts.layout')

@section('title') Lapsus Linguae - Your Profile @endsection
@section('description')
@endsection
@section('keywords') lapsus linguae, lapsus, linguae, profile, my profile, edit, @endsection


@section('content')
    <section class="bg lilac-background">
        <div class="container pt-5 ">
            <div class="d-flex justify-content-md-around  pt-2 pb-5">
                <div class="col-md-9" id="edit-profile-container">
                    <div class="col-lg-7 col-md-11">
                        <form name="edit-profile"  method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group position-relative">
                                @if(session()->get('user')->language_id == 1)
                                    <h1>Edit profile</h1>
                                @elseif(session()->get('user')->language_id == 2)
                                    <h1>Izmeni profil</h1>
                                @endif
                                <svg class="detail-diamond position-absolute" xmlns="http://www.w3.org/2000/svg" width="73.485" height="73.485" viewBox="0 0 73.485 73.485">
                                    <path id="Path_12275" data-name="Path 12275" d="M14.541,14.541,65.657,5.657,56.772,56.772,5.657,65.657Z" transform="matrix(0.259, -0.966, 0.966, 0.259, -6.928, 61.956)" fill="#ffce00"/>
                                </svg>
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="profile_picture">Profile Picture</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="profile_picture">Profilna slika</label>
                                @endif
                                <input type="file" name="profile_picture" class="form-control custom-file-input" id="profile-picture">
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="first_name">First name</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="first_name">Ime</label>
                                @endif
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ session()->get('user')->first_name }}">
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="last_name">Last name</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="last_name">Prezime</label>
                                @endif
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ session()->get('user')->last_name }}">
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="email">Email</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="email">Imejl</label>
                                @endif
                                <input type="text" name="email" id="email" class="form-control" value="{{ session()->get('user')->email }}">
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="email">Username</label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="email">Korisničko ime</label>
                                @endif
                                <input type="text" name="username" id="username" class="form-control" value="{{ session()->get('user')->username }}">
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <input type="submit" class="btn-get-started btn white-bg-button" value="Save changes">
                                @elseif(session()->get('user')->language_id == 2)
                                    <input type="submit" class="btn-get-started btn white-bg-button" value="Sačuvaj izmene">
                                @endif
                            </div>
                        </form >
                        <form method="POST" action="{{route('delete-profile')}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <button class="btn-get-started btn white-bg-button">Delete my profile</button>
                                @elseif(session()->get('user')->language_id == 2)
                                    <button class="btn-get-started btn white-bg-button">Izbriši profil</button>
                                @endif
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger" >
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('editProfileFail'))
                            <div class="alert alert-danger">
                                {{ session()->get('editProfileFail') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-3" id="edit-profile-navbar-container">
                    @include('client.components.edit-profile.edit-profile-navbar')
                </div>
            </div>
        </div>
    </section>

@endsection
