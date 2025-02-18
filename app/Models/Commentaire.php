<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'contenu', 'temoignage_id', 'recette_id'];

    public function temoignage() {
        return $this->belongsTo(Temoignage::class);
    }

    public function recette() {
        return $this->belongsTo(Recette::class);
    }
}
