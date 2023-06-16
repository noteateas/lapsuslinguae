<div class="d-flex mt-3 flex-md-column flex-lg-row">
    @php
        if(session()->get('user')->profile_picture == null){
        echo
        '<i class="fa-solid fa-circle-user" style="font-size: 50px; padding:8px" ></i>';
        }
        else{
            echo
        '<img style="width:50px; height:50px; border-radius:50%;" src=' . asset("/storage/img/profile_pictures/")."/" .session()->get('user')->profile_picture .' alt="profile-picture">
                    &nbsp;&nbsp;';
        }
    @endphp
    <h2 class="d-flex justify-content-center align-items-center "><a href="{{ route('profile') }}">{{ session()->get('user')->username }}</a></h2>
</div>
<div id="edit-profile-navbar">
        @if(session()->get('user')->language_id == 1)
            <a class="nav-link scrollto" id="show-edit-profile-container" href="{{ route('edit-profile') }}">Edit profile</a>
            <a class="nav-link scrollto" id="show-change-password-container" href="{{ route('change-password') }}">Change password</a>
            <a class="nav-link scrollto" href="{{ route('edit-goal') }}">Edit daily goal</a>
        @elseif(session()->get('user')->language_id == 2)
            <a class="nav-link scrollto" id="show-edit-profile-container" href="{{ route('edit-profile') }}">Podesi profil</a>
            <a class="nav-link scrollto" id="show-change-password-container" href="{{ route('change-password') }}">Izmeni šifru</a>
            <a class="nav-link scrollto" href="{{ route('edit-goal') }}">Izmeni dnevni cilj</a>
        @endif
</div>
