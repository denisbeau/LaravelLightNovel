<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LightNovel;

class LightNovelController extends Controller
{
    /**
     * Affiche la liste de tous les light novels.
     */
    public function index()
    {
        $lightNovels = LightNovel::orderBy('titre')->get();
        return view('light_novels.index', compact('lightNovels'));
    }

    /**
     * Affiche le formulaire de création d’un nouveau light novel.
     */
    public function create()
    {
        return view('light_novels.create');
    }

    /**
     * Enregistre un nouveau light novel dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des champs du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'statut' => 'nullable|string|max:255',
            'chapitres' => 'nullable|integer',
            'Contenu' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Vérifie qu’il s’agit bien d’une image
        ]);

        // 📸 Téléversement de l’image si elle existe
        if ($request->hasFile('photo')) {
            // Création d’un nom unique pour l’image
            $imageName = time() . '.' . $request->photo->extension();

            // Déplacement de l’image vers le dossier public/images
            $request->photo->move(public_path('images'), $imageName);

            // Enregistrement du nom du fichier dans le tableau validé
            $validated['photo'] = $imageName;
        }

        // Insertion du nouvel enregistrement dans la BD
        LightNovel::create($validated);

        // Redirection vers la liste avec un message de succès
        return redirect()
            ->route('light_novels.index')
            ->with('success', 'Light novel ajouté avec succès!');
    }

    /**
     * Affiche un light novel spécifique.
     */
    public function show($id)
    {
        $lightNovel = LightNovel::find($id);

        if (!$lightNovel) {
            return redirect()
                ->route('light_novels.index')
                ->with('error', 'Light novel introuvable.');
        }

        return view('light_novels.show', compact('lightNovel'));
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit($id)
    {
        $lightNovel = LightNovel::find($id);

        if (!$lightNovel) {
            return redirect()
                ->route('light_novels.index')
                ->with('error', 'Light novel introuvable.');
        }

        return view('light_novels.edit', compact('lightNovel'));
    }

    /**
     * Met à jour les informations d’un light novel existant.
     */
    public function update(Request $request, $id)
    {
        // Recherche du light novel à modifier
        $lightNovel = LightNovel::findOrFail($id);

        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'statut' => 'nullable|string|max:255',
            'chapitres' => 'nullable|integer',
            'Contenu' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // 📸 Si une nouvelle image est téléversée
        if ($request->hasFile('photo')) {

            // Suppression de l’ancienne image si elle existe
            if ($lightNovel->photo && file_exists(public_path('images/' . $lightNovel->photo))) {
                unlink(public_path('images/' . $lightNovel->photo));
            }

            // Enregistrement de la nouvelle image
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);

            // On met à jour le champ photo dans le tableau validé
            $validated['photo'] = $imageName;
        }

        // Mise à jour de l’enregistrement
        $lightNovel->update($validated);

        // Redirection avec un message de confirmation
        return redirect()
            ->route('light_novels.show', $lightNovel->id)
            ->with('success', 'Light novel modifié avec succès!');
    }

    /**
     * Supprime un light novel de la base de données.
     */
    public function destroy($id)
    {
        $lightNovel = LightNovel::findOrFail($id);

        // Suppression de l’image associée si elle existe
        if ($lightNovel->photo && file_exists(public_path('images/' . $lightNovel->photo))) {
            unlink(public_path('images/' . $lightNovel->photo));
        }

        // Suppression du light novel
        $lightNovel->delete();

        return redirect()
            ->route('light_novels.index')
            ->with('success', 'Light novel supprimé avec succès!');
    }

    /**
     * Fonction d’autocomplétion (recherche Ajax).
     */
    public function autocomplete(Request $request)
    {
        $term = $request->get('term', '');
        $results = [];

        if ($term !== '') {
            $items = LightNovel::where('titre', 'LIKE', '%' . $term . '%')
                ->orderBy('titre')
                ->limit(10)
                ->get();

            foreach ($items as $item) {
                $results[] = [
                    'id' => $item->id,
                    'label' => $item->titre,
                    'value' => $item->titre,
                ];
            }
        }

        // Retourne les résultats sous forme JSON
        return response()->json($results);
    }
}
