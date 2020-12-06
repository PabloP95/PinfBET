<nav class="navbar navbar-expand-md navbar-light" style="background:black">
    <a class="navbar-brand" href="/" style = "color:gold; font-family">
      <img src="{{ asset('images/LogoPINFbet1.png') }}" height="150px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
         @guest

        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" style="color:gold">{{ __('Login') }}</a>
            </li>
        @endif
        
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}" style="color:gold">{{ __('Register') }}</a>
            </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="color:gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" style="color:gold" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
