<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'titre', 'description', 'image_url', 'duree', 'categorie_id'];

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
}
