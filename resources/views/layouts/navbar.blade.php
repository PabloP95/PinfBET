<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav mr-auto">
@if (isset(Auth::user()->id))
    <li class="nav-item">
      <a class="nav-link" href="/">Inicio</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/panel/{{Auth::user()->id}}">Mi panel</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/apuesta/{{Auth::user()->id}}">Apostar</a>
    </li>
    @endif
  </ul>
  <ul class="navbar-nav ml-auto">
         @guest

        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" style="color:gold">{{ __('Iniciar Sesión') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}" style="color:gold">{{ __('Regístrate') }}</a>
            </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="color:gold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" style="color:gold" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/perfil">
                    {{ __('Mi perfil') }}
                </a>
                <a class="dropdown-item" href="/apuesta/{{Auth::user()->id}}">
                    {{ __('Mi panel') }}
                </a>

                <a class="dropdown-item" href="/mensajes/{{Auth::user()->id}}">
                    {{ __('Mensajes') }}
                </a>

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
      </ul>
</nav>
