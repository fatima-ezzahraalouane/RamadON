<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentaire;
use App\Models\Temoignage;

class CommentaireController extends Controller
{
    public function store(Request $request) 
    {
        try {
        // Validate the request
        $request->validate([
            'nom' => 'required|string|max:255',
            'contenu' => 'required|string',
            'temoignage_id' => 'required|exists:temoignages,id',
        ]);

        // Create the comment
        $comment = new Commentaire();
        $comment->nom = $request->nom;
        $comment->contenu = $request->contenu;
        $comment->temoignage_id = $request->temoignage_id;
        $comment->save();

        // Return a JSON response to the frontend
        return response()->json([
            'success' => true,
            'message' => 'Votre commentaire a été publié avec succès!',
            'comment' => $comment
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Une erreur s\'est produite lors de l\'ajout du commentaire.',
            'error' => $e->getMessage()
        ], 500);
    }
    }

    public function getComments($temoignageId)
    {
        $commentaires = Commentaire::where('temoignage_id', $temoignageId)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($commentaires);
    }
}
