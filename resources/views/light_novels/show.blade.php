@extends('layouts.app')

@section('title', $lightNovel->titre)

@section('content')
<article style="margin-bottom:2rem;">
    <h1>{{ $lightNovel->titre }}</h1>
    <p><strong>Auteur :</strong> {{ $lightNovel->auteur }}</p>
    <p><strong>Statut :</strong> {{ $lightNovel->statut }}</p>
    <p><strong>Chapitres :</strong> {{ $lightNovel->chapitres }}</p>
    <hr>
    <div>{!! nl2br(e($lightNovel->Contenu)) !!}</div>
</article>

<hr>
<h2>Commentaires</h2>

{{-- Afficher les commentaires --}}
@if($lightNovel->commentaires->isEmpty())
    <p>Aucun commentaire pour l'instant.</p>
@else
    <ul>
        @foreach($lightNovel->commentaires as $comment)
            <li style="margin-bottom:1rem;">
                <strong>
                    {{ $comment->user->name ?? 'Utilisateur inconnu' }}
                </strong>
                <p>{{ $comment->texte }}</p>

                {{-- Bouton de suppression avec confirmation --}}
                <form action="{{ route('commentaires.destroy', $comment->id) }}" method="POST"
                      onsubmit="return confirm('Supprimer ce commentaire ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;color:red;border:none;cursor:pointer;">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
@endif

<hr>

{{-- Formulaire d’ajout de commentaire --}}
<h3>Ajouter un commentaire</h3>
<form action="{{ route('commentaires.store') }}" method="POST">
    @csrf
    <input type="hidden" name="light_novel_id" value="{{ $lightNovel->id }}">
    <input type="hidden" name="user_id" value="1"> {{-- fixe pour dev --}}

    <textarea name="texte" rows="3" style="width:100%;"></textarea><br>
    <button type="submit">Publier</button>
</form>

<p style="margin-top:1rem;">
    <a href="{{ route('light_novels.edit', $lightNovel->id) }}">Modifier</a>
    <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">Retour à la liste</a>
</p>
@endsection
