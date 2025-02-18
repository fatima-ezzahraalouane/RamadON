<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('contenu');
            $table->timestamps();
            $table->unsignedBigInteger('temoignage_id')->nullable(false); //not null
            $table->unsignedBigInteger('recette_id')->nullable(false);

            $table->foreign('temoignage_id')->references('id')->on('temoignages')->onDelete('cascade');
            $table->foreign('recette_id')->references('id')->on('recettes')->onDelete('cascade');

            // cette contrainte CHECK pour assurer qu'un commentaire est associé soit à un témoignage, soit à une recette
            $table->check('(temoignage_id IS NOT NULL AND recette_id IS NULL) OR (temoignage_id IS NULL AND recette_id IS NOT NULL)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
