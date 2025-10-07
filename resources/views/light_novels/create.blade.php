@extends('layouts.app')

@section('title', 'Créer un Light Novel')

@section('content')
    <h1>Créer un Light Novel</h1>

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

    <form action="{{ route('light_novels.store') }}" method="POST">
        @csrf

        <div>
            <label for="titre">Titre</label><br>
            <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
            @error('titre') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top:0.6rem;">
            <label for="auteur">Auteur</label><br>
            <input type="text" id="auteur" name="auteur" value="{{ old('auteur') }}" required>
            @error('auteur') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top:0.6rem;">
            <label for="statut">Statut</label><br>
            <input type="text" id="statut" name="statut" value="{{ old('statut') }}">
            @error('statut') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top:0.6rem;">
            <label for="chapitres">Chapitres</label><br>
            <input type="number" id="chapitres" name="chapitres" value="{{ old('chapitres', 0) }}" min="0">
            @error('chapitres') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div style="margin-top:0.6rem;">
            <label for="Contenu">Contenu</label><br>
            <textarea id="Contenu" name="Contenu" rows="8">{{ old('Contenu') }}</textarea>
            @error('Contenu') <div class="err
