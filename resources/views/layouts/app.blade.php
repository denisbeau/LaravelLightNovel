<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'LightNovels'))</title>

    <!-- Bootstrap is included via Vite (resources/sass/app.scss imports bootstrap) -->

    <!-- Google Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- ✅ jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- ✅ Vite (Laravel asset builder) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body { font-family: Arial, sans-serif; background:#f5f5f5; margin:0; }
        header { background:#2b2f3a; color:white; padding:1rem; }
        header a { color:white; text-decoration:none; }
        header a:hover { text-decoration:underline; }
        main { max-width:1100px; margin:20px auto; background:white; padding:20px; border-radius:6px; }
        .search-input { padding:0.45rem; width:260px; border-radius:4px; border:1px solid #ccc; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:8px; border-bottom:1px solid #e0e0e0; }
    </style>
</head>

<body>
<header>
    <div class="container d-flex justify-content-between align-items-center">

        <!-- 🔹 Left Side -->
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <strong><a href="{{ url('/') }}">Bibliothèque Light Novels</a></strong>

            <!-- 🔍 Autocomplete Search -->
            <div>
                <input id="lightnovel-search" class="search-input" type="text"
                       placeholder="Rechercher un light novel..." autocomplete="off">
                <input type="hidden" id="lightnovel-id">
            </div>
        </div>

        <!-- 🔹 Right Side Navbar -->
        <nav class="d-flex align-items-center gap-3">

            <a href="{{ route('light_novels.index') }}">Accueil</a>
            <a href="{{ route('light_novels.create') }}">Ajouter</a>
            <a href="{{ url('/about') }}">À propos</a>

            @guest
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
            @else
                <span>{{ Auth::user()->name }}</span>
                @if(Auth::check() && Auth::user()->role === \App\Models\User::ADMIN_ROLE)
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                @endif
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            @endguest

            <!-- ✅ Corrected Language Dropdown -->
            @php $locale = session('locale', app()->getLocale()); @endphp
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center"
                        type="button" id="languageDropdown" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/flag/' . $locale . '.png') }}" width="20" class="me-2">
                    {{ strtoupper($locale) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/lang/fr">
                        <img src="{{ asset('images/flag/fr.png') }}" width="20" class="me-2"> Français
                    </a></li>
                    <li><a class="dropdown-item" href="/lang/en">
                        <img src="{{ asset('images/flag/en.png') }}" width="20" class="me-2"> English
                    </a></li>
                    <li><a class="dropdown-item" href="/lang/es">
                        <img src="{{ asset('images/flag/es.png') }}" width="20" class="me-2"> Español
                    </a></li>
                </ul>
            </div>

        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<!-- ✅ jQuery + UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- Bootstrap JS is included via Vite (resources/js/bootstrap.js imports bootstrap) -->

<script>
    // CSRF Protection
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // Autocomplete
    $(function () {
        $("#lightnovel-search").autocomplete({
            source: "{{ route('light_novels.autocomplete') }}",
            minLength: 2,
            select: function (event, ui) {
                window.location.href = "/light_novels/" + ui.item.id;
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>
