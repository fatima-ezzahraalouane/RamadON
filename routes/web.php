<?php
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\CommentaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/categories', [CategorieController::class, 'index']);

Route::get('/temoignages', [TemoignageController::class, 'index']);
Route::post('/temoignages', [TemoignageController::class, 'store'])->name('temoignages.store');

Route::get('/recettes', [RecetteController::class, 'index']);
// Route::post('/recettes', [RecetteController::class, 'store']);


Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
Route::get('/recettes/{id}', [RecetteController::class, 'show'])->name('recettes.show');

Route::post('/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
Route::get('/commentaires/{temoignage}', [CommentaireController::class, 'getComments']);
