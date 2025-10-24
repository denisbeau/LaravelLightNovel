@extends('layouts.app')

@section('title', 'Liste des Light Novels')

@section('content')
<h1>Liste des Light Novels</h1>

<div style="margin-bottom: 1rem;">
  <input type="text" id="searchNovel" placeholder="Rechercher un titre ou un auteur..." 
         style="padding:0.5rem;width:320px;border:1px solid #ccc;border-radius:5px;">
</div>

@php
  $list = $items ?? $novels ?? $lightNovels ?? collect();
@endphp

@if($list->isEmpty())
  <p>Aucun light novel trouvé.</p>
  <p><a href="{{ route('light_novels.create') }}">Ajouter un nouveau light novel</a></p>
@else
  <table style="
      width:100%;
      border-collapse:collapse;
      font-family:'Segoe UI',sans-serif;
      border:1px solid #ddd;
      border-radius:8px;
      overflow:hidden;
      box-shadow:0 2px 8px rgba(0,0,0,0.05);
  ">
      <thead style="background:#f8f9fa;">
          <tr style="text-align:left;">
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">ID</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Titre</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Auteur</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Statut</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Chapitres</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Contenu</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Photo</th>
              <th style="padding:10px;border-bottom:2px solid #e3e3e3;">Actions</th>
          </tr>
      </thead>
      <tbody>
          @foreach($list as $n)
              <tr style="border-bottom:1px solid #eee; background-color:{{ $loop->even ? '#fcfcfc' : 'white' }};"
                  onmouseover="this.style.backgroundColor='#f1f7ff';"
                  onmouseout="this.style.backgroundColor='{{ $loop->even ? '#fcfcfc' : 'white' }}';">
                  <td style="padding:10px;">{{ $n->id }}</td>
                  <td style="padding:10px;">{{ $n->titre }}</td>
                  <td style="padding:10px;">{{ $n->auteur }}</td>
                  <td style="padding:10px;">{{ $n->statut }}</td>
                  <td style="padding:10px;">{{ $n->chapitres }}</td>
                  <td style="padding:10px;">{{ \Illuminate\Support\Str::limit($n->Contenu, 80) }}</td>

                  <td style="padding:10px;">
                      @if($n->photo)
                          <img src="{{ asset('images/'.$n->photo) }}" 
                               alt="Image du light novel" 
                               width="80" style="border-radius:6px;">
                      @else
                          <em style="color:#999;">Aucune</em>
                      @endif
                  </td>

                  {{-- ⚙️ Actions --}}
                  <td style="padding:10px;">
                      <a href="{{ route('light_novels.show', $n->id) }}" style="color:#007bff;text-decoration:none;">Voir</a> |
                      <a href="{{ route('light_novels.edit', $n->id) }}" style="color:#28a745;text-decoration:none;">Modifier</a> |
                      <form action="{{ route('light_novels.destroy', $n->id) }}" 
                            method="POST" style="display:inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" 
                                  style="background:none;border:none;color:#dc3545;cursor:pointer;padding:0;">
                              Supprimer
                          </button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
$(function() {
  $("#searchNovel").autocomplete({
    source: "{{ route('light_novels.autocomplete') }}", 
    minLength: 1,
    select: function(event, ui) {
      window.location.href = "/light_novels/" + ui.item.id;
    }
  });
});
</script>
@endsection
