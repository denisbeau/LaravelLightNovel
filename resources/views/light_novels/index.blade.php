@extends('layouts.app')

@section('title', __('property.list_title'))

@section('content')
<h1>{{ __('property.list_title') }}</h1>

@php
  $list = $items ?? $novels ?? $lightNovels ?? collect();
@endphp

@if($list->isEmpty())
  <p>{{ __('property.no_result') }}</p>
  <p><a href="{{ route('light_novels.create') }}">{{ __('property.add_new') }}</a></p>
@else
  <table style="width:100%;border-collapse:collapse;font-family:'Segoe UI',sans-serif;border:1px solid #ddd;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
      <thead style="background:#f8f9fa;">
          <tr style="text-align:left;">
              <th style="padding:10px;">ID</th>
              <th style="padding:10px;">{{ __('property.title') }}</th>
              <th style="padding:10px;">{{ __('property.author') }}</th>
              <th style="padding:10px;">{{ __('property.status') }}</th>
              <th style="padding:10px;">{{ __('property.chapters') }}</th>
              <th style="padding:10px;">{{ __('property.content') }}</th>
              <th style="padding:10px;">{{ __('property.photo') }}</th>
              <th style="padding:10px;">{{ __('property.actions') }}</th>
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
                          <img src="{{ asset('images/'.$n->photo) }}" alt="Image du light novel" width="80" style="border-radius:6px;">
                      @else
                          <em style="color:#999;">{{ __('property.no') }}</em>
                      @endif
                  </td>

                  <td style="padding:10px;">
                      <a href="{{ route('light_novels.show', $n->id) }}">{{ __('property.view') }}</a> |
                      <a href="{{ route('light_novels.edit', $n->id) }}">{{ __('property.edit') }}</a> |
                      <form action="{{ route('light_novels.destroy', $n->id) }}" method="POST" style="display:inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" style="background:none;border:none;color:#dc3545;cursor:pointer;padding:0;">
                              {{ __('property.delete') }}
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
