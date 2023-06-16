@extends('client.layouts.layout')

@section('title') Lapsus Linguae - Learn a Language @endsection
@section('description')
@endsection
@section('keywords') language, learning, lapsus, linguae, lapsus linguae, italian, english, serbian, study, speak
@endsection

@section('content')
    <section id="hero" class="bg">
        <div>
            <div class="p-4 welcome-container d-flex align-items-lg-center flex-column align-items-md-end">
                @if(session()->has('user'))
                    @if(session()->get('user')->language_id == 1)
                        <p>ARE YOU</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;
                            READY</p>
                        <p>TO LEARN</p>
                    @elseif(session()->get('user')->language_id == 2)
                        <p>JESI LI</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;
                            SPREMAN</p>
                        <p>DA UČIŠ</p>
                    @endif
                @else
                    <p>ARE YOU</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        READY</p>
                    <p>TO LEARN</p>
                @endif
                <div class="position-absolute d-md-block d-none " id="blue-figure-container">
                    <img src="{{ asset('assets/img/home-ct.png') }}" alt="blue-figure">
                </div>
                <div class="position-absolute d-lg-block d-none" id="shape-container">
                    <img src="{{ asset('assets/img/hero-shape.png') }}" alt="figure">
                </div>
            </div>
            <div class="register-login-container container d-flex justify-content-around align-items-center">
                <div class="space position-relative">
                    <svg class="detail-circle-bottom " xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                        <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                    </svg>
                    <svg class="detail-diamond" xmlns="http://www.w3.org/2000/svg" width="73.485" height="73.485" viewBox="0 0 73.485 73.485">
                        <path id="Path_12275" data-name="Path 12275" d="M14.541,14.541,65.657,5.657,56.772,56.772,5.657,65.657Z" transform="matrix(0.259, -0.966, 0.966, 0.259, -6.928, 61.956)" fill="#ffce00"/>
                    </svg>
                </div>
                <svg class="detail-circle-bottom d-lg-block d-none" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                    <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                </svg>
                <div class="rg-container d-flex justify-content-center align-items-center flex-column position-relative">
                    <svg class="detail-circle-bottom" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                        <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                    </svg>

                @if(session()->has('user'))
                        @if(session()->get('user')->language_id == 1)
                            @if($userTasks)
                                <div><a href="{{ route('practice') }}" class="btn-get-started scrollto">Choose a topic and learn!</a></div>
                            @else
                                <div><a href="{{ route('task',1) }}" class="btn-get-started scrollto">Click here to start learning now!</a></div>
                            @endif
                        @elseif(session()->get('user')->language_id == 2)
                            @if($userTasks)
                                <div><a href="{{ route('practice') }}" class="btn-get-started scrollto">Izaberi zadatak i kreni!</a></div>
                            @else
                                <div><a href="{{ route('task',1) }}" class="btn-get-started scrollto">Kreni da učiš sada!</a></div>
                            @endif
                        @endif
                    @else
                        <div><a href="{{ route('register') }}" class="btn-get-started white-bg-button scrollto">Register</a></div>
                        <div><a href="{{ route('login') }}" class="btn-get-started scrollto">I already have an account</a></div>
                    @endif
                </div>
            </div>
            <div id="arrow-container">
                <img src="{{asset('assets/img/down-arrow.png')}}" alt="down arrow" class="animated">
            </div>
            <div class="services lilac-background">
                <img class="d-none d-lg-block" src="{{ asset('assets/img/orange-shape.jpg') }}" alt="photo">
                <div class="container">
                    <div class="why-header position-relative">
                        @if(session()->has('user'))
                            @if(session()->get('user')->language_id == 1)
                                <h2>WHY LAPSUS LINGUAE</h2>
                            @elseif(session()->get('user')->language_id == 2)
                                <h2>ZAŠTO LAPSUS LINGUAE</h2>
                            @endif
                        @else
                            <h2>WHY LAPSUS LINGUAE</h2>
                        @endif
                        <svg class="detail-diamond" xmlns="http://www.w3.org/2000/svg" width="73.485" height="73.485" viewBox="0 0 73.485 73.485">
                            <path id="Path_12275" data-name="Path 12275" d="M14.541,14.541,65.657,5.657,56.772,56.772,5.657,65.657Z" transform="matrix(0.259, -0.966, 0.966, 0.259, -6.928, 61.956)" fill="#ffce00"/>
                        </svg>
                        <svg class="detail-circle-bottom" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                            <circle id="Ellipse_279" data-name="Ellipse 279" cx="15" cy="15" r="15"/>
                        </svg>
                    </div>
                    @foreach($traits as $trait)
                        <div class="why-icon-container d-flex align-items-stretch justify-content-center" data-aos="zoom-in">
                            <div class="icon-box hover-shadow d-flex justify-content-end align-items-end">
                                <div class="why-title-container">
                                    @if(session()->has('user') )
                                        @if(session()->get('user')->language_id == 1)
                                            <h4>{{ ucfirst($trait['title']) }}&nbsp;&nbsp;{!! $trait['icon']  !!}</h4>
                                        @elseif(session()->get('user')->language_id == 2)
                                            <h4>{{ ucfirst($trait['srb_title']) }}&nbsp;&nbsp;{!! $trait['icon']  !!}</h4>
                                        @endif
                                    @else
                                        <h4>{{ ucfirst($trait['title']) }}&nbsp;&nbsp;{!! $trait['icon']  !!}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="lilac-background pb-5 pt-5">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="pt-3 d-flex flex-column justify-content-center text-center">
                        @if(session()->has('user'))
                            @if(session()->get('user')->language_id == 1)
                                <h1>START NOW</h1>
                                <h2>Fun, effective and completely free!</h2>
                                <div>
                                    <a href="{{ route('recap') }}" class="btn-get-started white-bg-button">
                                        Start by learning the vocabulary here
                                    </a>
                                </div>
                            @elseif(session()->get('user')->language_id == 2)
                                    <h1>POČNI SADA</h1>
                                <h2>Zabavno, efikasno, i skroz besplatno!</h2>
                                <div>
                                    <a href="{{ route('recap') }}" class="btn-get-started white-bg-button">
                                        Počni sa vokabularom ovde!
                                    </a>
                                </div>
                            @endif
                        @else
                            <h1>START NOW</h1>
                            <h2>Fun, effective and completely free!</h2>
                            <div>
                                <a href="{{ route('recap') }}" class="btn-get-started white-bg-button">
                                    Start by learning the vocabulary here
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
