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
        header .container { max-width:1100px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:1rem; }
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
        /* petit style pour l'input de recherche dans le header */
        .search-input { padding:0.35rem 0.5rem; border-radius:4px; border:1px solid #ddd; width:260px; }
    </style>

    <!-- jQuery UI CSS (CDN pour tester) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- CSRF pour les requêtes AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head')
</head>
<body>
    <header>
        <div class="container">
            <div style="display:flex; align-items:center; gap:1rem;">
                <strong><a href="{{ url('/') }}" style="color:inherit; text-decoration:none;">Bibliothèque Light Novels</a></strong>

                <!-- Champ de recherche global -->
                <div>
                    <input id="lightnovel-search" class="search-input" type="text" placeholder="Rechercher un light novel..." autocomplete="off" />
                    <input type="hidden" id="lightnovel-id" name="lightnovel_id" />
                </div>
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

    <!-- jQuery & jQuery UI (CDN pour tester) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
    // Setup AJAX CSRF token (utile si tu passes en POST plus tard)
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $(function() {
        $("#lightnovel-search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('light_novels.autocomplete') }}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function() {
                        response([]);
                    }
                });
            },
            minLength: 2,
            delay: 200,
            select: function(event, ui) {
                // ui.item: { id, label, value }
                $('#lightnovel-id').val(ui.item.id);
                // exemple : rediriger vers la fiche
                // window.location.href = '/light_novels/' + ui.item.id;
            },
            focus: function(event, ui) {
                // empêche de remplacer l'input pendant le focus
                event.preventDefault();
                $("#lightnovel-search").val(ui.item.label);
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            // personnalisation de l'affichage dans la liste (optionnel)
            return $("<li>")
                .append("<div><strong>"+item.label+"</strong><br><span class='small'>ID: "+item.id+"</span></div>")
                .appendTo(ul);
        };
    });
    </script>

    @stack('scripts')
</body>
</html>
