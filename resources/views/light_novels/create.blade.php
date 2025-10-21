@extends('layouts.app')

@section('title', 'Créer un Light Novel')

@section('content')
<h1>Créer un Light Novel</h1>

@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="error">
        <strong>Erreur :</strong>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('light_novels.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="titre">Titre</label><br>
        <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
    </div>

    <div style="margin-top:0.6rem;">
        <label for="auteur">Auteur</label><br>
        <input type="text" id="auteur" name="auteur" value="{{ old('auteur') }}" required>
    </div>

    <div style="margin-top:0.6rem;">
        <label for="statut">Statut</label><br>
        <input type="text" id="statut" name="statut" value="{{ old('statut') }}">
    </div>

    <div style="margin-top:0.6rem;">
        <label for="chapitres">Chapitres</label><br>
        <input type="number" id="chapitres" name="chapitres" value="{{ old('chapitres', 0) }}" min="0">
    </div>

    <div style="margin-top:0.6rem;">
        <label for="Contenu">Contenu</label><br>
        <textarea id="Contenu" name="Contenu" rows="8">{{ old('Contenu') }}</textarea>
    </div>

    <div style="margin-top:0.6rem;">
        <label for="photo">Photo</label><br>
        <input type="file" id="photo" name="photo" accept="image/*">
    </div>

    <div style="margin-top:0.8rem;">
        <button type="submit">Créer</button>
        <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">Annuler</a>
    </div>
</form>
@endsection
