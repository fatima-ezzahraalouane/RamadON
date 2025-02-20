@extends('layouts.app')

@section('content')
<main class="min-h-screen flex justify-center items-center bg-gradient-to-r from-purple-100 to-purple-900">
    <section id="hero" class="relative text-white w-full">
        <div class="max-w-7xl mx-auto px-4 flex items-center">
            <div class="w-1/2 pr-12">
                <h1 class="text-5xl font-bold mb-6 text-black">Ramadan 2025</h1>
                <p class="text-xl mb-8 text-black font-medium">Partagez vos expériences, recettes et moments spirituels avec notre communauté pendant ce mois sacré.</p>
                <button onclick="showExperienceForm()" class="rounded-lg bg-black text-primary px-6 py-3 font-medium hover:bg-purple-900 whitespace-nowrap transform transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                    Partager votre expérience
                </button>
            </div>
            <div class="w-1/2">
                <img src="https://public.readdy.ai/ai/img_res/3a6f4c6d90629a3cdf83a52a30378814.jpg" class="rounded-lg shadow-xl" alt="Ramadan illustration">
            </div>
        </div>
    </section>
</main>

<!-- Modal Form -->
<div id="experienceFormModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4 shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Partagez votre expérience</h3>
            <button onclick="hideExperienceForm()" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <form id="experienceForm" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Votre nom</label>
                <input type="text" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez votre nom">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                <input type="text" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Donnez un titre à votre expérience">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary h-32 resize-none" placeholder="Partagez votre expérience..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL de la photo</label>
                <input type="url" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez l'URL de votre image">
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="hideExperienceForm()" class="rounded-lg px-6 py-2 border border-gray-300 text-black hover:bg-gray-50 whitespace-nowrap">
                    Annuler
                </button>
                <button type="submit" class="rounded-lg bg-black text-white px-6 py-2 hover:bg-purple-900 whitespace-nowrap">
                    Publier
                </button>
            </div>
        </form>
    </div>
</div>

<div id="successPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
        <h3 class="text-2xl font-bold">Expérience Publiée! 🎉🌙</h3>
        <p class="mt-2 text-lg">Votre expérience a été ajoutée avec succès.</p>
    </div>
</div>

<script>
    function showExperienceForm() {
        document.getElementById("experienceFormModal").classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }

    function hideExperienceForm() {
        document.getElementById("experienceFormModal").classList.add("hidden");
        document.body.style.overflow = "auto";
    }

    document.getElementById("experienceForm").addEventListener("submit", function(e) {
        e.preventDefault();
        hideExperienceForm();

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
