<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    //
    public function index() {
        return response()->json(Temoignage::all());
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        $temoignage = Temoignage::create($request->all());

        return response()->json($temoignage, 201);
    }
}
