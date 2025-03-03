<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    //
    // public function index() {
    //     return response()->json(Temoignage::all());
    // }

    public function index() {
        $temoignages = Temoignage::all();
        return view('pages.temoignages', compact('temoignages'));
    }
    

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'image_url' => 'nullable|url|max:255',
        ]);

        Temoignage::create($request->all());

        return redirect()->back()->with('success', 'Votre expérience a été ajoutée avec succès !');
    }
}
