<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temoignage;
use App\Models\Recette;
use App\Models\Commentaire;

class StatistiqueController extends Controller
{
    public function index()
    {
        $totalRecettes = Recette::count();
        $totalTemoignages = Temoignage::count();
        $totalCommentairesRecettes = Commentaire::whereNotNull('recette_id')->count();
        $totalCommentairesTemoignages = Commentaire::whereNotNull('temoignage_id')->count();

        $topRecettes = Recette::withCount('commentaires')
            ->orderByDesc('commentaires_count')
            ->take(3)
            ->get();

        return view('pages.statistiques', compact(
            'totalRecettes',
            'totalTemoignages',
            'totalCommentairesRecettes',
            'totalCommentairesTemoignages',
            'topRecettes'
        ));
    }
}
