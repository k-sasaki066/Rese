<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header-container">
            <div id="drawer-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <h1 class="header__title">Rese</h1>

            <nav class="header-nav__menu" id="header-nav">
                <ul class="header-nav__list">
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/">
                            Home
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="header-nav__item">
                            <form action="" method="">
                                <button class="header-nav__link" type="submit">
                                    Logout
                                </button>
                            </form>
                            <!-- <a class="header-nav__link" href="">
                                Logout
                            </a> -->
                        </li><li class="header-nav__item">
                            <a class="header-nav__link" href="/mypage">
                                Mypage
                            </a>
                        </li>
                    @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/register">
                                Registration
                            </a>
                        </li><li class="header-nav__item">
                            <a class="header-nav__link" href="/login">
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @yield('search')
        <script src="{{ asset('js/header-nav.js') }}"></script>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>