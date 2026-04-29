<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ContactForm</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <nav class="header-nav">
                @guest
                    @if (!request()->is('login'))
                        <a class="header-nav__button" href="/login">login</a>
                    @endif
                    @if (!request()->is('register'))
                        <a class="header-nav__button" href="/register">register</a>
                    @endif
                @endguest

                @auth
                    <form action="/logout" method="POST">
                    @csrf
                        <button class="header-nav__button" type="submit">logout</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>