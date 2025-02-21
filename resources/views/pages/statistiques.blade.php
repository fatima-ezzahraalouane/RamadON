@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<section id="stats" class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 gap-8">
            <!-- Statistics Section -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Statistiques</h2>
                <div class="grid grid-cols-3 gap-6">
                    <!-- Total Recipes -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Recettes partagées</span>
                            <div class="w-10 h-10 flex items-center justify-center bg-secondary bg-opacity-10 rounded-full">
                                <i class="ri-book-2-line text-secondary text-xl"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ $totalRecettes }}</div>
                    </div>

                    <!-- Total Comments on Recipes -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Commentaires sur Recettes</span>
                            <div class="w-10 h-10 flex items-center justify-center bg-green-500 bg-opacity-10 rounded-full">
                                <i class="ri-chat-1-line text-green-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ $totalCommentairesRecettes }}</div>
                    </div>

                    <!-- Total Experiences Shared -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Expériences partagées</span>
                            <div class="w-10 h-10 flex items-center justify-center bg-primary bg-opacity-10 rounded-full">
                                <i class="ri-user-heart-line text-primary text-xl"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ $totalTemoignages }}</div>
                    </div>

                    <!-- Total Comments on Experiences -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Commentaires sur Expériences</span>
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-500 bg-opacity-10 rounded-full">
                                <i class="ri-message-2-line text-blue-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">{{ $totalCommentairesTemoignages }}</div>
                    </div>
                </div>
            </div>

            <!-- Top Recipes -->
            <div>
                <h2 class="text-3xl font-bold mb-8">Top Recettes</h2>
                <div class="space-y-4">
                    @foreach($topRecettes as $recette)
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <img src="{{ $recette->image_url }}" class="w-20 h-20 rounded-lg object-cover" alt="{{ $recette->titre }}">
                        <div class="ml-4">
                            <h3 class="font-semibold">{{ $recette->titre }}</h3>
                            <div class="flex items-center mt-2">
                                <i class="ri-chat-1-fill text-primary mr-1"></i>
                                <span class="text-sm text-black">{{ $recette->commentaires_count }} commentaires</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
