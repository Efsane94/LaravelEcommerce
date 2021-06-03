
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="/img/logo.png">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="navbar-form navbar-left" action="{{ route('search') }}" method="POST">
            {{ csrf_field() }}
            <div class="input-group">

{{--                old('word')- Onun ucundur ki, search placeholderinde olan yazi ana sehifeye qayidanda da placeholderde qalsin.--}}
                <input type="text" id="navbar-search" name="word" class="form-control" placeholder="Search" value="{{ old('word') }}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
            </div>
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>
                    Cart <span class="badge badge-theme">{{ Cart:: count() }}</span></a>
            </li>
            @guest()
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.register') }}">Sign Up</a>
            </li>
            @endguest
            @auth()
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Profil </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Siparişlerim</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#" onclick="event.preventDefault();
                        document.getElementById('logout_form').submit();">Logout</a>
                        <form id="logout_form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endauth
        </ul>
    </div>
    </div>
</nav>
