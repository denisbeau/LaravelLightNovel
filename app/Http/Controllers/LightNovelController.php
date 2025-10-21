<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LightNovel;

class LightNovelController extends Controller
{
    public function index()
    {
        $lightNovels = LightNovel::all();
        return view('light_novels.index', compact('lightNovels'));
    }

    public function create()
    {
        return view('light_novels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'statut' => 'nullable|string|max:50',
            'chapitres' => 'nullable|integer|min:0',
            'Contenu' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        LightNovel::create($validated);

        return redirect()->route('light_novels.index')
            ->with('success', 'Light novel créé avec succès !');
    }

public function show($id)
{
    $lightNovel = LightNovel::find($id);

    if (!$lightNovel) {
        return redirect()->route('light_novels.index')->with('error', 'Light novel introuvable.');
    }

    return view('light_novels.show', compact('lightNovel'));
}


    public function edit(string $id)
    {
        $lightNovel = LightNovel::findOrFail($id);
        return view('light_novels.edit', compact('lightNovel'));
    }

    public function update(Request $request, string $id)
    {
        $lightNovel = LightNovel::findOrFail($id);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'statut' => 'nullable|string|max:50',
            'chapitres' => 'nullable|integer|min:0',
            'Contenu' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $lightNovel->update($validated);

        return redirect()->route('light_novels.show', $lightNovel->id)
            ->with('success', 'Light novel mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        $lightNovel = LightNovel::findOrFail($id);
        $lightNovel->delete();

        return redirect()->route('light_novels.index')
            ->with('success', 'Light novel supprimé avec succès !');
    }
}
