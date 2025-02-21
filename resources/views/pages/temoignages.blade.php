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
                            <img src="https://intranet.youcode.ma/storage/users/profile/1384-1728486655.JPG" class="w-8 h-8 rounded-full" alt="Author">
                            <span class="ml-2 text-sm text-gray-600">{{ $temoignage->nom }}</span>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="flex items-center text-black hover:text-primary transform transition-all duration-200 hover:scale-110">
                                <i class="ri-heart-line mr-1"></i>
                                <span>24</span>
                            </button>
                            <!-- Comment Button -->
                            <button class="comment-btn flex items-center text-black hover:text-primary"
                                onclick="document.getElementById('commentModal-{{ $temoignage->id }}').classList.remove('hidden')">
                                <i class="ri-chat-1-line mr-1"></i>
                                <span>{{ $temoignage->commentaires->count() }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment Modal -->
            <div id="commentModal-{{ $temoignage->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4 shadow-xl max-h-[80vh] overflow-y-auto [&::-webkit-scrollbar]:hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Commentaires</h3>
                        <button onclick="document.getElementById('commentModal-{{ $temoignage->id }}').classList.add('hidden')"
                            class="text-gray-500 hover:text-gray-700">
                            <i class="ri-close-line text-2xl"></i>
                        </button>
                    </div>

                    <!-- List of Comments -->
                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto [&::-webkit-scrollbar]:hidden">
                        @foreach($temoignage->commentaires as $comment)
                        <div class="flex items-start space-x-4">
                            <img src="https://public.readdy.ai/ai/img_res/7981d1aa5d3fb0443327a7dbfa075c17.jpg" class="w-10 h-10 rounded-full" alt="User">
                            <div>
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $comment->nom }}</span>
                                    <span class="text-gray-500 text-sm ml-2">{{ \Carbon\Carbon::parse($comment->created_at)->format('d F Y') }}</span>
                                </div>
                                <p class="text-gray-600 mt-1">{{ $comment->contenu }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Comment Form -->
                    <form action="{{ route('commentaires.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="temoignage_id" value="{{ $temoignage->id }}">

                        <div>
                            <input type="text" name="nom" placeholder="Votre nom" required
                                class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <textarea name="contenu" placeholder="Votre commentaire" required
                                class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary h-20 resize-none"></textarea>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button"
                                onclick="document.getElementById('commentModal-{{ $temoignage->id }}').classList.add('hidden')"
                                class="rounded-lg px-6 py-2 border border-gray-300 text-black hover:bg-gray-50">
                                Annuler
                            </button>
                            <button type="submit" class="rounded-lg bg-black text-white px-4 py-2 hover:bg-purple-800">
                                Publier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@if(session('success'))
<div id="successPopup" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl">
        <h3 class="text-2xl font-bold">Commentaire Ajouté! 🎉🌙</h3>
        <p class="mt-2 text-lg">{{ session('success') }}</p>
    </div>
</div>

<script>
    setTimeout(() => {
        document.getElementById('successPopup').classList.add('hidden');
    }, 3000);
</script>
@endif

<!-- Tailwind Animations -->
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-scaleIn {
        animation: scaleIn 0.3s ease-in-out;
    }
</style>

@endsection