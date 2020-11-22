<nav class="navbar navbar-expand-md navbar-light" style="background:#5AB8E6">
    <a class="navbar-brand" href="/" style = "color:black; font-family"><h2>PINFBet</h2></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
         @guest
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:black">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color:black; padding-right:10px">{{ __('Registrarse') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color:black;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" style="color:black"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" >
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="#" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest


        <li class = "nav-item">
        <i class="fas fa-coins"></i>
        <a href='#'>

        </a>
            @if(Session::has('cart'))
                <span class='badge badge-warning' id='lblCartCount'> </span>
        @endif
        </li>
    </ul>
    </div>
</nav>
