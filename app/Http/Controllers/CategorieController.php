<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //pour recuperer tous les categories
    public function index() {
        return response()->json(Categorie::all());
    }
}
