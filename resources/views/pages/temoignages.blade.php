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
                                <button onclick="showCommentForm()" class="flex items-center text-gray-500 hover:text-primary">
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

<!-- Comment Modal -->
<div id="commentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4 shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Commentaires</h3>
            <button onclick="hideCommentForm()" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <div class="space-y-4 mb-6">
            <!-- Example Comment -->
            <div class="flex items-start space-x-4">
                <img src="https://public.readdy.ai/ai/img_res/7981d1aa5d3fb0443327a7dbfa075c17.jpg" class="w-10 h-10 rounded-full" alt="User">
                <div>
                    <div class="flex items-center">
                        <span class="font-medium">Marie Dubois</span>
                        <span class="text-gray-500 text-sm ml-2">Il y a 2 jours</span>
                    </div>
                    <p class="text-gray-600 mt-1">Merci pour ce partage ! C'est vraiment inspirant.</p>
                </div>
            </div>
        </div>
        <form id="commentForm" class="space-y-4">
            <div>
                <input type="text" placeholder="Votre nom" required class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <textarea placeholder="Votre commentaire" required class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary h-20 resize-none"></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="hideCommentForm()" class="rounded-lg px-6 py-2 border border-gray-300 text-black hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit" class="rounded-lg bg-black text-white px-4 py-2 hover:bg-purple-800">
                    Publier
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Success Popup -->
<div id="successPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
        <h3 class="text-2xl font-bold">Commentaire Ajouté! 🎉🌙</h3>
        <p class="mt-2 text-lg">Votre commentaire a été publié avec succès.</p>
    </div>
</div>

<script>
    function showCommentForm() {
        document.getElementById("commentModal").classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }

    function hideCommentForm() {
        document.getElementById("commentModal").classList.add("hidden");
        document.body.style.overflow = "auto";
    }

    document.getElementById("commentForm").addEventListener("submit", function(e) {
        e.preventDefault();
        hideCommentForm();

        // Show the pop-up message
        const successPopup = document.getElementById("successPopup");
        successPopup.classList.remove("hidden");
        successPopup.classList.add("animate-scaleIn");

        // Hide after 3 seconds
        setTimeout(() => {
            successPopup.classList.add("hidden");
            successPopup.classList.remove("animate-scaleIn");
        }, 3000);
    });
</script>

<!-- Tailwind Animations -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    @keyframes scaleIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-scaleIn {
        animation: scaleIn 0.3s ease-in-out;
    }
</style>

@endsection
