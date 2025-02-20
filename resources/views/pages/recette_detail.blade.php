@extends('layouts.app')

@section('title', $recette->titre)

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center text-primary">{{ $recette->titre }}</h1>
        <div class="mt-8 flex items-center justify-center space-x-4 text-gray-600">
            <span class="flex items-center">
                <i class="ri-time-line mr-1"></i> {{ $recette->temps_preparation }} min
            </span>
            <span class="flex items-center">
                <i class="ri-user-line mr-1"></i> {{ $recette->nombre_personnes }} personnes
            </span>
            <span class="flex items-center">
                <i class="ri-fire-line mr-1"></i> {{ ucfirst($recette->difficulte) }}
            </span>
        </div>
        <img src="{{ $recette->image_url }}" class="mt-8 w-full h-96 object-cover rounded-lg shadow-md" alt="{{ $recette->titre }}">

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Ingrédients</h2>
            <ul class="list-disc list-inside text-gray-600 space-y-2">
                @foreach(json_decode($recette->ingredients) as $ingredient)
                    <li>{{ $ingredient }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Préparation</h2>
            <ol class="list-decimal list-inside text-gray-600 space-y-2">
                @foreach(json_decode($recette->etapes) as $etape)
                    <li>{{ $etape }}</li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
@endsection
