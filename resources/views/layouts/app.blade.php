<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'LightNovels'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles (your custom inline CSS) -->
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; background:#fafafa; color:#222; }
        header { background:#2b2f3a; color:#fff; padding:1rem; }
        header .container { max-width:1100px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
        nav { display:flex; align-items:center; flex-wrap:wrap; gap:0.5rem; }
        nav a { color:#dfe6f0; margin-right:0.8rem; text-decoration:none; }
        nav a.btn { background:#fff; color:#2b2f3a; padding:0.3rem 0.6rem; border-radius:4px; text-decoration:none; }
        main { max-width:1100px; margin:1.2rem auto; padding:1rem; background:#fff; box-shadow:0 0 6px rgba(0,0,0,0.04); border-radius:6px; }
        table { width:100%; border-collapse:collapse; margin-top:0.6rem; }
        th, td { text-align:left; padding:0.6rem; border-bottom:1px solid #eee; vertical-align:top; }
        form input[type="text"], form input[type="number"], form textarea { width:100%; padding:0.45rem; border:1px solid #ddd; border-radius:4px; }
        .actions a { margin-right:0.4rem; color:#0066cc; text-decoration:none; }
        .flash { padding:0.6rem; background:#e6ffed; border:1px solid #b7f0c9; margin-bottom:1rem; border-radius:4px; color:#064b11; }
        .error { color:#a00; margin-top:0.3rem; font-size:0.95rem; }
        .small { font-size:0.9rem; color:#666; }
        .search-input { padding:0.35rem 0.5rem; border-radius:4px; border:1px solid #ddd; width:260px; }
    </style>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('head')
</head>
<body>
    <header>
        <div class="container">
            <div style="display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
                <strong>
                    <a href="{{ url('/') }}" style="color:inherit; text-decoration:none;">Bibliothèque Light Novels</a>
                </strong>

                <div>
                    <input id="lightnovel-search" class="search-input" type="text"
                           placeholder="Rechercher un light novel..." autocomplete="off" />
                    <input type="hidden" id="lightnovel-id" name="lightnovel_id" />
                </div>
            </div>

            <nav>
                <a href="{{ route('light_novels.index') }}">Accueil</a>
                <a href="{{ route('light_novels.create') }}" class="btn">Ajouter</a>
                <a href="{{ url('/about') }}">À propos</a>

                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">Connexion</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Inscription</a>
                    @endif
                @else
                    <span style="color:#dfe6f0;">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @endguest

                <!-- Language dropdown -->
                <ul class="navbar-nav list-unstyled" style="display:inline-block; margin-left:1rem;">
                    @php $locale = session('locale', app()->getLocale()); @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/flag/' . $locale . '.png') }}" width="25" class="me-1">
                            {{ strtoupper($locale) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/lang/fr">
                                    <img src="{{ asset('images/flag/fr.png') }}" width="25" class="me-2"> Français
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/lang/en">
                                    <img src="{{ asset('images/flag/en.png') }}" width="25" class="me-2"> English
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/lang/es">
                                    <img src="{{ asset('images/flag/es.png') }}" width="25" class="me-2"> Español
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </header>

    <main>
        @if(session('message'))
            <div class="flash">{{ session('message') }}</div>
        @endif
        @yield('content')
    </main>

    <!-- jQuery & jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
    // CSRF setup for AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Autocomplete for LightNovels
    $(function() {
        $("#lightnovel-search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('light_novels.autocomplete') }}",
                    dataType: "json",
                    data: { term: request.term },
                    success: function(data) { response(data); },
                    error: function() { response([]); }
                });
            },
            minLength: 2,
            delay: 200,
            select: function(event, ui) {
                $('#lightnovel-id').val(ui.item.id);
            },
            focus: function(event, ui) {
                event.preventDefault();
                $("#lightnovel-search").val(ui.item.label);
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div><strong>"+item.label+"</strong><br><span class='small'>ID: "+item.id+"</span></div>")
                .appendTo(ul);
        };
    });
    </script>

    @stack('scripts')
</body>
</html>