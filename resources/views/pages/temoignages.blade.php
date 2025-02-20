@extends('layouts.app')

@section('title', 'Expériences Partagées')

@section('content')
<section id="experiences" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-12 text-center text-gradient">Expériences Partagées</h2>
        <div class="grid grid-cols-3 gap-8">
            @foreach($temoignages as $temoignage)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale hover-shadow">
                    <img src="{{ $temoignage->image_url }}" class="w-full h-48 object-cover" alt="Experience">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $temoignage->titre }}</h3>
                        <p class="text-black mb-4">{{ Str::limit($temoignage->contenu, 100) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://freesvg.org/img/publicdomainq-0006224bvmrqd.png" class="w-8 h-8 rounded-full" alt="Author">
                                <span class="ml-2 text-sm text-gray-600">{{ $temoignage->nom }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center text-black hover:text-primary transform transition-all duration-200 hover:scale-110">
                                    <i class="ri-heart-line mr-1"></i>
                                    <span>24</span>
                                </button>
                                <button class="flex items-center text-gray-500 hover:text-primary">
                                    <i class="ri-chat-1-line mr-1"></i>
                                    <span>12</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
