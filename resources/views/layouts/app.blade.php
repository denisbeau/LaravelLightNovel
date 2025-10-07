<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'LightNovels')</title>

    <!-- simple CSS inline so the layout works without external assets -->
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; background:#fafafa; color:#222; }
        header { background:#2b2f3a; color:#fff; padding:1rem; }
        header .container { max-width:1100px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; }
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
    </style>
    @stack('head')
</head>
<body>
    <header>
        <div class="container">
            <div>
                <strong><a href="{{ url('/') }}" style="color:inherit; text-decoration:none;">Bibliothèque Light Novels</a></strong>
            </div>
            <nav>
                <a href="{{ route('light_novels.index') }}">Accueil</a>
                <a href="{{ route('light_novels.create') }}" class="btn">Ajouter</a>
                <a href="{{ url('/about') }}">À propos</a>
            </nav>
        </div>
    </header>

    <main>
        @if(session('message'))
            <div class="flash">{{ session('message') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
