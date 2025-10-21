@extends('layouts.app')

@section('title', 'Liste des Light Novels')

@section('content')
    <h1>Liste des Light Novels</h1>

    @php
        $list = $items ?? $novels ?? $lightNovels ?? collect();
    @endphp

    @if($list->isEmpty())
        <p>Aucun light novel trouvé.</p>
        <p><a href="{{ route('light_novels.create') }}">Ajouter un nouveau light novel</a></p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Chapitres</th>
                    <th>Contenu (aperçu)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $n)
                    <tr>
                        <td>{{ $n->id }}</td>
                        <td>{{ $n->titre }}</td>
                        <td>{{ $n->auteur }}</td>
                        <td>{{ $n->statut }}</td>
                        <td>{{ $n->chapitres }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($n->Contenu, 120) }}</td>
                        <td class="actions">
                            <a href="{{ route('light_novels.show', $n->id) }}">Voir</a>
                            <a href="{{ route('light_novels.edit', $n->id) }}">Modifier</a>
                            <form action="{{ route('light_novels.destroy', $n->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:none;border:none;color:#c00;cursor:pointer;padding:0;">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
