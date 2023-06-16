<nav class="practice-nav container navbar">
    <ul class="d-flex navbar">
        @if(session('user')->language_id == 1)
            <li><a href="{{ route("recap") }}" class="hover-underline nav-link scrollto" >RECAP</a></li>
            <li><a href="{{ route('edit-goal') }}" class="hover-underline nav-link scrollto" >EDIT GOAL</a></li>
        @elseif(session('user')->language_id == 2)
            <li><a href="{{ route("recap") }}" class="hover-underline nav-link scrollto" >REČI</a></li>
            <li><a href="{{ route('edit-goal') }}" class="hover-underline nav-link scrollto" >IZMENI DNEVNI CILJ</a></li>
        @endif

    </ul>
    <ul class="d-flex navbar" id="practice-nav-info">
        <li>
            @if(session('user')->language_id == 1)
                <b>Daily goal</b>&nbsp;&nbsp;
            @elseif(session('user')->language_id == 2)
                <b>Dnevni cilj</b>&nbsp;&nbsp;
            @endif
            <span id="daily-goal-text">{{ $currentUserProgress }} of
                @if(session()->get('user')->daily_goal == null)
                    0
                @else
                    {{ session()->get('user')->daily_goal }}
                @endif
            </span>
        </li>
        <li><i class="fa-solid fa-crown"></i>{{ $levelsFinished }}</li>
        <li><i class="fa-solid fa-fire"></i>{{ session('user')->streak }}</li>
    </ul>
</nav>
