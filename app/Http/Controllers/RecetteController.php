<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;
use App\Models\Categorie;

class RecetteController extends Controller
{
    public function index(Request $request) 
    {
        $categorie = $request->input('categorie');

        if ($categorie && $categorie !== 'tous') {
            $recettes = Recette::whereHas('categorie', function ($query) use ($categorie) {
                $query->where('nom', $categorie);
            })->get();
        } else {
            $recettes = Recette::all();
        }

        $categories = Categorie::all();

        return view('pages.recettes', compact('recettes', 'categories', 'categorie'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        'titre' => 'required|string|max:255',
        'categorie_id' => 'required|exists:categories,id',
        'duree' => 'required|integer|min:1',
        'description' => 'required|string',
        'ingredient' => 'nullable|string',
        'instructions' => 'nullable|string',
        'image_url' => 'required|url|max:255',
        ]);

        Recette::create($request->all());

        return redirect()->route('recettes.index')->with('success', 'Recette ajoutée avec succès !');
    }

    // public function show($id) {
    //     $recette = Recette::findOrFail($id);
    //     return view('pages.recette_detail', compact('recette'));
    // }
}
