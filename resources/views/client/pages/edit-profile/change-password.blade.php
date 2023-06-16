@extends('client.layouts.layout')

@section('content')

    <section class="bg lilac-background">
        <div class="container pt-5">
            <div class="d-flex justify-content-md-around  pt-2 pb-5">
                <div class="col-md-9 container pb-5">
                    <div class="col-lg-7 col-md-11">
                        <form action="{{ route('change-password') }}" method="POST" id="change-password-form">
                            @csrf
                            <div class="form-group position-relative">
                                @if(session()->get('user')->language_id == 1)
                                    <h1>Change password</h1>
                                @elseif(session()->get('user')->language_id == 2)
                                    <h1>Promeni lozinku</h1>
                                @endif
                                <svg class="detail-diamond position-absolute" xmlns="http://www.w3.org/2000/svg" width="73.485" height="73.485" viewBox="0 0 73.485 73.485">
                                    <path id="Path_12275" data-name="Path 12275" d="M14.541,14.541,65.657,5.657,56.772,56.772,5.657,65.657Z" transform="matrix(0.259, -0.966, 0.966, 0.259, -6.928, 61.956)" fill="#ffce00"/>
                                </svg>
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="old-password"><span>Old password</span></label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="old-password"><span>Stara lozinka</span></label>
                                @endif
                                <input type="password" name="old_password" class="form-control" id="old-password">
                            </div><br/>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="new-password"><span>New password</span></label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="new-password"><span>Nova lozinka</span></label>
                                @endif
                                <input type="password" name="new_password" class="form-control" id="new-password">
                            </div><br/>
                            @if(session()->get('user')->language_id == 1)
                                <button type="submit" class="btn-get-started btn white-bg-button">Change password</button>
                            @elseif(session()->get('user')->language_id == 2)
                                <button type="submit" class="btn-get-started btn white-bg-button">Promeni lozinku</button>
                            @endif
                        </form>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-5" >
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('changePasswordFail'))
                            <div class="alert alert-danger">
                                {{ session()->get('changePasswordFail') }}
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
