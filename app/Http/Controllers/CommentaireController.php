<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Temoignage;

class CommentaireController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'contenu' => 'required|string',
            'temoignage_id' => 'required|exists:temoignages,id',
        ]);
    
        Commentaire::create([
            'nom' => $request->nom,
            'contenu' => $request->contenu,
            'temoignage_id' => $request->temoignage_id,
        ]);
    
        return redirect()->back()->with('success', 'Votre commentaire a été publié avec succès.');
    }

}
