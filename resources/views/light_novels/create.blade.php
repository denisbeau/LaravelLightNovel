@extends('layouts.app')

@section('title', __('property.create_title'))

@section('content')
<h1>{{ __('property.create_title') }}</h1>

@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="error">
        <strong>{{ __('property.error') }}</strong>
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
        <label for="titre">{{ __('property.title') }}</label><br>
        <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
    </div>

    <div style="margin-top:0.6rem;">
        <label for="auteur">{{ __('property.author') }}</label><br>
        <input type="text" id="auteur" name="auteur" value="{{ old('auteur') }}" required>
    </div>

    <div style="margin-top:0.6rem;">
        <label for="statut">{{ __('property.status') }}</label><br>
        <input type="text" id="statut" name="statut" value="{{ old('statut') }}">
    </div>

    <div style="margin-top:0.6rem;">
        <label for="chapitres">{{ __('property.chapters') }}</label><br>
        <input type="number" id="chapitres" name="chapitres" value="{{ old('chapitres', 0) }}" min="0">
    </div>

    <div style="margin-top:0.6rem;">
        <label for="Contenu">{{ __('property.content') }}</label><br>
        <textarea id="Contenu" name="Contenu" rows="8">{{ old('Contenu') }}</textarea>
    </div>

    <div>
        <label for="photo">{{ __('property.photo') }}</label><br>
        <input type="file" id="photo" name="photo" accept="image/*">
    </div>

    <div style="margin-top:0.8rem;">
        <button type="submit">{{ __('property.create_button') }}</button>
        <a href="{{ route('light_novels.index') }}" style="margin-left:0.6rem;">{{ __('property.cancel') }}</a>
    </div>
</form>
@endsection
