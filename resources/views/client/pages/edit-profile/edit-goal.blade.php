@extends('client.layouts.layout')

@section('content')

    <section class="bg lilac-background">
        <div class="container pt-5 pb-5">
            <div class="d-flex justify-content-md-around pt-2 pb-5">
                <div class="col-md-9">
                    <div class="col-lg-7 col-md-11">
                        <form action=" {{ route('edit-goal') }}" method="POST" id="edit-goal-form">
                            @csrf
                            <div class="form-group title">
                                @if(session()->get('user')->language_id == 1)
                                    <h1>Edit daily goal </h1>
                                @elseif(session()->get('user')->language_id == 2)
                                    <h1>Izmeni dnevni cilj </h1>
                                @endif
                            </div>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="basic-goal"><strong>Casual</strong><span>1 lesson per day</span></label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="basic-goal"><strong>Opušteno</strong><span>1 vežba dnevno</span></label>
                                @endif
                                <input type="radio" name="daily-goal" class="form-control" value="1" id="basic-goal">
                            </div><br/>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="regular-goal"><strong>Regular</strong><span>2 lessons per day</span></label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="regular-goal"><strong>Regularno</strong><span>2 vežbe dnevno</span></label>
                                @endif
                                <input type="radio" name="daily-goal" class="form-control" value="2" id="regular-goal">
                            </div><br/>
                            <div class="form-group">
                                @if(session()->get('user')->language_id == 1)
                                    <label for="serious-goal"><strong>Serious</strong><span>3 lessons per day</span></label>
                                @elseif(session()->get('user')->language_id == 2)
                                    <label for="serious-goal"><strong>Ozbiljno</strong><span>3 vežbe dnevno</span></label>
                                @endif
                                <input type="radio" name="daily-goal" class="form-control" value="3" id="serious-goal">
                            </div><br/>
                            @if(session()->get('user')->language_id == 1)
                                <button type="submit" class="btn-get-started btn white-bg-button">Save changes</button>
                            @elseif(session()->get('user')->language_id == 2)
                                <button type="submit" class="btn-get-started btn white-bg-button">Sačuvaj izmene</button>
                            @endif
                        </form>
                        @if(session()->has('editGoalFail'))
                            <div class="alert alert-danger">
                                {{ session()->get('editGoalFail') }}
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
