<header id="header" class="fixed-top ">
<div class="container d-flex align-items-center justify-content-between">
    <h1 class="logo"><a href="{{ route('home') }}">LAPSUS LINGUAE</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
        <ul>
            @if(session()->has('user') )

                @if(session()->get('user')->language_id == 1)

                    <li><a class="nav-link scrollto hover-underline" href="{{ route('practice') }}">Practice</a></li>
                    <li><a class="nav-link scrollto hover-underline" href="{{ route('recap') }}">Words</a></li>
                    <li><a class="nav-link scrollto hover-underline" href="{{ route('about') }}">About</a></li>
                @elseif(session()->get('user')->language_id == 2)
                    <li><a class="nav-link scrollto hover-underline" href="{{ route('practice') }}">Vežbe</a></li>
                    <li><a class="nav-link scrollto hover-underline" href="{{ route('recap') }}">Reči</a></li>
                    <li><a class="nav-link scrollto hover-underline" href="{{ route('about') }}">O nama</a></li>
                @endif
            @else
                <li><a class="nav-link scrollto hover-underline" href="{{ route('recap') }}">Words</a></li>
                <li><a class="nav-link scrollto hover-underline" href="{{ route('about') }}">About</a></li>
            @endif

            @php
                if(session()->has('user')){
                    if(session()->get('user')->language_id == 1){
                        echo '<li class="dropdown "><a href="#"><span>Language</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="'. route('change-language', 1) . '" class="hover-underline">English</a></li>
                                <li><a href="'. route('change-language', 2) .'" class="hover-underline">Srpski</a></li>
                            </ul>
                        </li>';
                    }
                    else if(session()->get('user')->language_id == 2){
                        echo '<li class="dropdown "><a href="#"><span>Jezik</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="'. route('change-language', 1) . '" class="hover-underline">English</a></li>
                                <li><a href="'. route('change-language', 2) .'" class="hover-underline">Srpski</a></li>
                            </ul>
                        </li>';
                    }

                    echo '
                    <li class="dropdown ">
                        <a href="#">
                            <span>';

                    if(session()->get('user')->profile_picture == null){
                        echo
                    '<i class="fa-solid fa-circle-user"></i>
                                &nbsp;&nbsp;' . session()->get('user')->username;
                    }
                    else{
                        echo
                    '<img style="width:25px; height:25px; border-radius:50%;" src=' . asset("/storage/img/profile_pictures/")."/" .session()->get('user')->profile_picture .' alt="profile-picture">
                                &nbsp;&nbsp;' . session()->get('user')->username;
                    }

                     if(session()->get('user')->language_id == 1){
                        echo '</span>
                        </a>
                        <ul>
                            <li><a href='. route("profile") .' class="hover-underline">Profile</a></li>
                            <li><a href='. route("edit-profile") .' class="hover-underline">Edit profile</a></li>
                            <li><a href='. route("logout") .' class="hover-underline">Logout</a></li>
                        </ul>
                    </li>';
                    }
                    else if(session()->get('user')->language_id == 2){
                        echo '</span>
                        </a>
                        <ul>
                            <li><a href='. route("profile") .' class="hover-underline">Profil</a></li>
                            <li><a href='. route("edit-profile") .' class="hover-underline">Podesi profil</a></li>
                            <li><a href='. route("logout") .' class="hover-underline">Izloguj se</a></li>
                        </ul>
                    </li>';
                    }
                }
                else{
                    echo '<li><a class="nav-link scrollto hover-underline" href='. route("login") .'>Login</a></li>';
                    echo '<li><a class="nav-link scrollto hover-underline" href='. route("register") .'>Register</a></li>';
                }
            @endphp

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
</div>
</header>
