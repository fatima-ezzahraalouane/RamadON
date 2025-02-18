<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE TYPE categorie_type AS ENUM ('Iftar', 'Suhoor', 'Desserts')");

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->enum('nom', ['Iftar', 'Suhoor', 'Desserts'])->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');

        DB::statement("DROP TYPE IF EXISTS categorie_type");
    }
};
