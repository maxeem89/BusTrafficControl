

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> <img src="http://www.iconhot.com/icon/png/brush-intense-messenger/256/msn-web-2.png" alt="Girl in a jacket" style="width:40px;height:40px;"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-around" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}" >HOME <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('employees.index')}}" >Employees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('employee.check-qr')}}" >Scan QR Code</a>
            </li>

            @guest
                    <li class="nav-item">
                @if (Route::has('login'))
                        <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
            @else
                <li class="nav-item">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="position-relative">
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="background: #17a3b0; border-radius: 10px">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    </div>
                </li>
            @endguest
        {{--    <li class="nav-item">
                <a class="nav-link" href="https://codepen.io/jijogeo/pen/XVZEZQ" >FIX-MISTAKE</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://codepen.io/jijogeo/pen/LeevBQ" >CONCLUSION</a>
            </li>--}}
        </ul>

        <form class="form-inline my-2 my-lg-0" action="{{route('employees.index')}}">
            <div class="d-flex">
            <input class="form-control mx-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </div>
        </form>
    </div>
</nav>
