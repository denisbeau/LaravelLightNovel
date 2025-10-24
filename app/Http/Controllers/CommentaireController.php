<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function index()
    {
        // (optional) For testing only:
        $commentaires = Commentaire::with('lightNovel', 'user')->get();
        return view('commentaires.index', compact('commentaires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'light_novel_id' => 'required|exists:light_novels,id',
            'user_id' => 'required|exists:users,id',
            'texte' => 'required|string|max:1000',
        ]);

        Commentaire::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Commentaire ajouté avec succès!');
    }

    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();

        return redirect()
            ->back()
            ->with('success', 'Commentaire supprimé.');
    }
}
