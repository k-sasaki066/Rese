<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('css/auth/register.css')}}">
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
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/admin/register">
                            Registration for Admin
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <script src="{{ asset('js/header-nav.js') }}"></script>
    </header>

    <main class="main">
        @if (session('result'))
        <div class="flash_message">
            {{ session('result') }}
        </div>
        @endif

        <div class="register-container common-shadow">
            <p class="register-form__title">
                Registration for Admin
            </p>

            <form class="register-form" action="/admin/register" method="post">
                @csrf
                <div class="form-group">
                    <img class="register-icon" src="{{ asset('/images/username.svg') }}" alt="name">
                    <div class="form-group__item">
                        <input class="form-group__input" type="text" name="name" placeholder="Username" value="{{ old('name') }}">
                        <div class="error-message">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <img class="register-icon" src="{{ asset('/images/email.svg') }}" alt="email">
                    <div class="form-group__item">
                        <input class="form-group__input" type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        <div class="error-message">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <img class="register-icon" src="{{ asset('/images/password.svg') }}" alt="password">
                    <div class="form-group__item">
                        <input class="form-group__input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                        <div class="error-message">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="register-form__submit common-btn" type="submit">
                    登録
                </button>
            </form>
        </div>
    </main>
</body>