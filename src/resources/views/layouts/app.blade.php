<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
    @livewireStyles
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
                    @if (Auth::check())
                        @if(Auth::user()->hasAnyRole(['admin', 'editor']))
                            @role('editor')
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/editor/shop/edit">
                                    店舗情報編集
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/editor/shop/menu">
                                    メニュー登録
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/editor/shop/list">
                                    予約リスト
                                </a>
                            </li>
                            @endrole

                            @role('admin')
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/admin/register/representative">
                                    店舗代表者登録
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/admin/user/index">
                                    ユーザーリスト
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/admin/email">
                                    メール送信
                                </a>
                            </li>
                            @endrole
                        @else
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/">
                                    Home
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/mypage">
                                    Mypage
                                </a>
                            </li>
                            <li class="header-nav__item">
                                <a class="header-nav__link" href="/history">
                                    visit-history
                                </a>
                            </li>
                        @endif
                        <li class="header-nav__item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="header-nav__link" type="submit">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/">
                                Home
                            </a>
                        </li>
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
@livewireScripts
</body>
</html>