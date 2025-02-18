<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'titre', 'contenu', 'image_url'];

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }
}
