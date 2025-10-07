@extends('layouts.app')

@section('title', $novel['titre'] ?? ($item['titre'] ?? ($lightNovel->titre ?? 'Détails')) )

@section('content')
    @php
        $n = $item ?? $novel ?? (isset($lightNovel) ? $lightNovel : null);
    @endphp

    @if(!$n)
        <p>Light novel introuvable.</p>
    @else
        <article>
            <h1>{{ $n['titre'] ?? $n->titre }}</h1>
            <p><strong>Auteur:</strong> {{ $n['auteur'] ?? $n->auteur }}</p>
            <p><strong>Statut:</strong> {{ $n['statut'] ?? $n->statut }}</p>
            <p><strong>Chapitres:</strong> {{ $n['chapitres'] ?? $n->chapitres }}</p>
            <hr>
            <div>{!! nl2br(e($n['Contenu'] ?? $n->Contenu)) !!}</div>
        </article>

        <hr>
        <h2>Commentaires</h2>
        <p class="small">Les commentaires sont gérés via la table <code>commentaires</code>. (Affichage et formulaire gérés par votre contrôleur.)</p>
        <!-- optional placeholder: your controller should pass 'reviews' or 'comments' -->
        @php $reviews = $reviews ?? $comments ?? []; @endphp
        @if(empty($reviews))
            <p>Aucun commentaire pour l'instant.</p>
        @else
            <ul>
                @foreach($reviews as $r)
                    <li>
                        <strong>{{ $r['username'] ?? $r->username ?? 'Anonyme' }}</strong>
                        <div>{{ nl2br(e($r['texte'] ?? $r->texte ?? '')) }}</div>
                    </li>
                @endforeach
            </ul>
        @endif

        <p style="margin-top:1rem;">
            <a href="{{ route('light_novels.edit', $n['id'] ?? $n->id) }}">Modifier</a>
            <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">Retour à la liste</a>
        </p>
    @endif
@endsection
