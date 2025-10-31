@extends('layouts.app')

@section('title', $lightNovel->titre)

@section('content')
<article style="margin-bottom:2rem;">
    <h1>{{ $lightNovel->titre }}</h1>
    <p><strong>{{ __('property.author') }} :</strong> {{ $lightNovel->auteur }}</p>
    <p><strong>{{ __('property.status') }} :</strong> {{ $lightNovel->statut }}</p>
    <p><strong>{{ __('property.chapters') }} :</strong> {{ $lightNovel->chapitres }}</p>
    <hr>
    <div>{!! nl2br(e($lightNovel->Contenu)) !!}</div>

    @if(!empty($lightNovel->photo))
        <div style="margin-top:1rem;">
            <img src="{{ asset('images/'.$lightNovel->photo) }}" alt="Image du light novel" width="200" style="border-radius:8px;">
        </div>
    @endif
</article>

<hr>
<h2>{{ __('property.comments') }}</h2>

@if($commentaires->isEmpty())
    <p>{{ __('property.no_comments') }}</p>
@else
    <ul>
        @foreach($commentaires as $comment)
            <li style="margin-bottom:1rem;">
                <strong>{{ $comment->auteur_commentaire ?? 'Utilisateur inconnu' }}</strong>
                <p>{{ $comment->texte }}</p>

                @auth
                    <form action="{{ route('commentaires.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('{{ __('property.delete_comment') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none;color:red;border:none;cursor:pointer;">
                            {{ __('property.delete') }}
                        </button>
                    </form>
                @endauth
            </li>
        @endforeach
    </ul>
@endif

<hr>

<h3>{{ __('property.add_comment') }}</h3>
@auth
    <form action="{{ route('commentaires.store') }}" method="POST">
        @csrf
        <input type="hidden" name="light_novel_id" value="{{ $lightNovel->id }}">

        <textarea name="texte" rows="3" style="width:100%;"></textarea><br>
        <button type="submit">{{ __('property.publish') }}</button>
    </form>
@else
    <p><a href="{{ route('login') }}">{{ __('property.add_comment') }}</a> — {{ __('property.unknown_user') }}</p>
@endauth

<p style="margin-top:1rem;">
    @auth
        <a href="{{ route('light_novels.edit', $lightNovel->id) }}">{{ __('property.edit') }}</a>
    @endauth
    <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">{{ __('property.back_to_list') }}</a>
</p>
@endsection
