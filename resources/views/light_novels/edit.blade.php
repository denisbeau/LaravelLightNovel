@extends('layouts.app')

@section('title', 'Modifier le Light Novel')

@section('content')
<h1>Modifier le Light Novel</h1>

@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if (!$lightNovel)
    <p>Light novel introuvable.</p>
@else
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('light_novels.update', $lightNovel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="titre">Titre</label><br>
            <input type="text" id="titre" name="titre" value="{{ old('titre', $lightNovel->titre) }}" required>
        </div>

        <div style="margin-top:0.6rem;">
            <label for="auteur">Auteur</label><br>
            <input type="text" id="auteur" name="auteur" value="{{ old('auteur', $lightNovel->auteur) }}" required>
        </div>

        <div style="margin-top:0.6rem;">
            <label for="statut">Statut</label><br>
            <input type="text" id="statut" name="statut" value="{{ old('statut', $lightNovel->statut) }}">
        </div>

        <div style="margin-top:0.6rem;">
            <label for="chapitres">Chapitres</label><br>
            <input type="number" id="chapitres" name="chapitres" value="{{ old('chapitres', $lightNovel->chapitres) }}" min="0">
        </div>

        <div style="margin-top:0.6rem;">
            <label for="Contenu">Contenu</label><br>
            <textarea id="Contenu" name="Contenu" rows="10">{{ old('Contenu', $lightNovel->Contenu) }}</textarea>
        </div>

        <div style="margin-top:0.6rem;">
            <label for="photo">Photo</label><br>
            <input type="file" id="photo" name="photo" accept="image/*">
            @if($lightNovel->photo)
                <div style="margin-top:0.3rem;">
                    <img src="{{ asset('storage/'.$lightNovel->photo) }}" alt="Photo" width="150">
                </div>
            @endif
        </div>

        <div style="margin-top:0.8rem;">
            <button type="submit">Enregistrer</button>
            <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">Annuler</a>
        </div>
    </form>
@endif
@endsection
