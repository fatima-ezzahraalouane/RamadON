@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<section id="hero" class="relative bg-gradient-to-r from-primary to-purple-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 flex items-center">
        <div class="w-1/2 pr-12">
            <h1 class="text-5xl font-bold mb-6 text-black">Ramadan 2025</h1>
            <p class="text-xl mb-8 text-black font-medium">
                Partagez vos expériences, recettes et moments spirituels avec notre communauté pendant ce mois sacré.
            </p>
            <a href="{{ url('/temoignages') }}" class="bg-black text-primary px-6 py-3 font-medium hover:bg-gray-100">
                Partager votre expérience
            </a>
        </div>
        <div class="w-1/2">
            <img src="https://public.readdy.ai/ai/img_res/3a6f4c6d90629a3cdf83a52a30378814.jpg" class="rounded-lg shadow-xl" alt="Ramadan illustration">
        </div>
    </div>
</section>
@endsection
