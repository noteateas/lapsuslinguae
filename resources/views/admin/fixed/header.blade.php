<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo"><a href="{{ route('admin-home') }}">LAPSUS LINGUAE</a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                @if(session()->has('user'))
                    <li class="dropdown "><a href="#"><span>Words</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('words.create') }}" class="hover-underline">Insert</a></li>
                            <li><a href="{{ route('words.index') }}" class="hover-underline">Edit or delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown "><a href="#"><span>Sentences</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('sentences.create') }}" class="hover-underline">Insert</a></li>
                            <li><a href="{{ route('sentences.index') }}" class="hover-underline">Edit or delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown "><a href="#"><span>Task Info</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('task-info.index') }}" class="hover-underline">Edit</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('logout') }}" class="hover-underline">Logout</a></li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
    </div>
</header>
