<div class="px-3 py-2 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li class="text-center">
                    <a href="#" class="nav-link text-white">
                        <i class="bi-palette" style="font-size: 2rem;"></i><br/>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="text-center">
                    <a href="{{ route('todos.index') }}" class="nav-link text-white">
                        <i class="bi-list-check" style="font-size: 2rem;"></i><br/>
                        {{ __('Task list') }}
                    </a>
                </li>
                <li class="text-center">
                    <a href="{{ route('categories.index') }}" class="nav-link text-white">
                        <i class="bi-folder" style="font-size: 2rem;"></i><br/>
                        {{ __('Categories') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="px-3 py-2 border-bottom mb-3">
    <div class="container d-flex flex-wrap justify-content-center">
        <!-- Authentication Links -->
        <div class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto align-bottom">
            @auth
                <h5 class="navbar-text">
                    {{ Auth::user()->name }}
                </h5>
            @endauth            
        </div>
        @guest
            @if (Route::has('login'))
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endif
            @if (Route::has('register'))
                &nbsp;
                <a class="btn btn-light text-dark me-2" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @else
            <div class="text-end">
                <a class="btn btn-light" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endguest
    </div>
</div>