@extends('layouts.app')

@section('title', 'Recettes Populaires')

@section('content')
<section id="recipes" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Recettes Populaires</h2>
            <button class="!rounded-button bg-primary text-white px-6 py-3 font-medium hover:bg-opacity-90 flex items-center gap-2">
                <i class="ri-add-line"></i> Ajouter une recette
            </button>
        </div>

        <div class="flex justify-center mb-8 space-x-4">
            <button class="!rounded-button px-4 py-2 bg-primary text-white font-medium whitespace-nowrap hover:bg-opacity-90" data-category="tous">Tous</button>
            <button class="!rounded-button px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-200" data-category="iftar">Iftar</button>
            <button class="!rounded-button px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-200" data-category="suhoor">Suhoor</button>
            <button class="!rounded-button px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-200" data-category="desserts">Desserts</button>
        </div>

        <div class="grid grid-cols-3 gap-8" id="recipes-grid">
            @foreach($recettes as $recette)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover-scale hover-shadow group" data-category="{{ strtolower($recette->categorie) }}">
                <div class="relative">
                    <img src="{{ $recette->image_url }}" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105" alt="Recette">
                    <div class="absolute top-4 right-4 bg-white rounded-full p-2 shadow-md">
                        <i class="ri-heart-line text-primary text-xl"></i>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="bg-primary bg-opacity-10 text-primary text-sm px-3 py-1 rounded-full">{{ ucfirst($recette->categorie) }}</span>
                        <span class="bg-gray-100 text-gray-600 text-sm px-3 py-1 rounded-full flex items-center">
                            <i class="ri-time-line mr-1"></i> {{ $recette->duree }} min
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">{{ $recette->titre }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($recette->description, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://intranet.youcode.ma/storage/users/profile/1384-1728486655.JPG" class="w-8 h-8 rounded-full" alt="Auteur">
                            <span class="text-sm text-gray-600">Par {{ $recette->nom }}</span>
                        </div>
                        <a href="{{ route('recettes.show', $recette->id) }}" class="!rounded-button bg-primary text-white px-4 py-2 text-sm font-medium hover:bg-opacity-90 flex items-center">
                            <i class="ri-eye-line mr-2"></i> Voir la recette
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
