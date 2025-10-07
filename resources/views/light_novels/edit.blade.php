@extends('layouts.app')

@section('title', 'Modifier le Light Novel')

@section('content')
    <h1>Modifier le Light Novel</h1>

    @php
        $item = $item ?? $novel ?? $article ?? (isset($lightNovel) ? $lightNovel : null);
        if (is_null($item)) {
            // try object/array name fallback
            $item = $item ?? (isset($novel) ? $novel : null);
        }
    @endphp

    @if (!$item)
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

        <form action="{{ route('light_novels.update', $item['id'] ?? $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $item['id'] ?? $item->id }}">

            <div>
                <label for="titre">Titre</label><br>
                <input type="text" id="titre" name="titre" value="{{ old('titre', $item['titre'] ?? $item->titre) }}" required>
                @error('titre') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top:0.6rem;">
                <label for="auteur">Auteur</label><br>
                <input type="text" id="auteur" name="auteur" value="{{ old('auteur', $item['auteur'] ?? $item->auteur) }}" required>
                @error('auteur') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top:0.6rem;">
                <label for="statut">Statut</label><br>
                <input type="text" id="statut" name="statut" value="{{ old('statut', $item['statut'] ?? $item->statut) }}">
                @error('statut') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top:0.6rem;">
                <label for="chapitres">Chapitres</label><br>
                <input type="number" id="chapitres" name="chapitres" value="{{ old('chapitres', $item['chapitres'] ?? $item->chapitres) }}" min="0">
                @error('chapitres') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top:0.6rem;">
                <label for="Contenu">Contenu</label><br>
                <textarea id="Contenu" name="Contenu" rows="10">{{ old('Contenu', $item['Contenu'] ?? $item->Contenu) }}</textarea>
                @error('Contenu') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div style="margin-top:0.8rem;">
                <button type="submit">Enregistrer</button>
                <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">Annuler</a>
            </div>
        </form>
    @endif
@endsection
