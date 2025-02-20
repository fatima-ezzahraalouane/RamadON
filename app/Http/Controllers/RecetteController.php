<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;

class RecetteController extends Controller
{
    public function index() {
        $recettes = Recette::all();
        return view('pages.recettes', compact('recettes'));
    }

    public function show($id) {
        $recette = Recette::findOrFail($id);
        return view('pages.recette_detail', compact('recette'));
    }
}
