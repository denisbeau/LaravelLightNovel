<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LightNovel;

class LightNovelController extends Controller
{
    // Liste simple (index)
public function index()
{
    $lightNovels = LightNovel::orderBy('titre')->get();
    return view('light_novels.index', compact('lightNovels'));
}


    // Affichage d'un élément (show)
public function show($id)
{
    $lightNovel = LightNovel::with('commentaires.user')->find($id);

    if (!$lightNovel) {
        return redirect()->route('light_novels.index')->with('error', 'Light novel introuvable.');
    }

    return view('light_novels.show', compact('lightNovel'));
}

    // Méthode autocomplete
    public function autocomplete(Request $request)
{
    $term = $request->get('term', '');
    $results = [];

    if ($term !== '') {
        $items = LightNovel::where('titre', 'LIKE', '%' . $term . '%') // <-- colonne 'titre'
            ->orderBy('titre')
            ->limit(10)
            ->get();

        foreach ($items as $item) {
            $results[] = [
                'id'    => $item->id,
                'label' => $item->titre,   // on renvoie 'titre'
                'value' => $item->titre,
            ];
        }
    }
        return response()->json($results);
    }
}
