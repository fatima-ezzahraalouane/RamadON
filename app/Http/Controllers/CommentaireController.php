<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Temoignage;
use App\Models\Recette;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contenu' => 'required|string',
            'temoignage_id' => 'nullable|exists:temoignages,id',
            'recette_id' => 'nullable|exists:recettes,id',
        ]);
    
        Commentaire::create([
            'nom' => $request->nom,
            'contenu' => $request->contenu,
            'temoignage_id' => $request->temoignage_id ?? null,
            'recette_id' => $request->recette_id ?? null,
        ]);
    
        return redirect()->back()->with('success', 'Votre commentaire a été publié avec succès.');
    }

}
