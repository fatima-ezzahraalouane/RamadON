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

    // public function show($id) {
    //     $recette = Recette::findOrFail($id);
    //     return view('pages.recette_detail', compact('recette'));
    // }
}
