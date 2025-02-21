@extends('layouts.app')

@section('content')
<main class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-purple-100 to-purple-900">
    <section id="hero" class="relative text-white w-full">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="w-1/2 pr-12">
                <h1 class="text-5xl font-bold mb-6 text-black">RamadON 2025</h1>
                <p class="text-xl mb-8 text-black font-medium">Partagez vos expériences, recettes et moments spirituels avec notre communauté pendant ce mois sacré.</p>
                <button onclick="showExperienceForm()" class="rounded-lg bg-black text-primary px-6 py-3 font-medium hover:bg-purple-900 whitespace-nowrap transform transition-all duration-200 hover:-translate-y-1 hover:shadow-lg">
                    Partager votre expérience
                </button>
            </div>
            <div class="w-1/2 flex justify-center items-center mt-10">
                <img src="https://public.readdy.ai/ai/img_res/3a6f4c6d90629a3cdf83a52a30378814.jpg" class="rounded-lg shadow-xl max-w-full h-auto" alt="Ramadan illustration">
            </div>
        </div>
    </section>

    <!-- Dua Section -->
    <section id="dua" class="py-16 bg-gradient-to-b from-gray-100 to-white w-full mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">📖 Supplications (Dua) du Ramadan</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Morning Dua -->
                <div class="p-6 bg-white rounded-lg shadow-md border">
                    <h3 class="text-xl font-semibold text-purple-900 mb-4">🌅 Matin</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        اللهم إني أسألك خير هذا اليوم فتحه، ونصره، ونوره، وبركته، وهداه.
                    </p>
                    <p class="text-sm text-gray-600 mt-2 italic">
                        "O Allah, I ask You for the good of this day: its victory, its light, its blessings, and its guidance."
                    </p>
                </div>

                <!-- Ramadan Special Dua -->
                <div class="p-6 bg-white rounded-lg shadow-md border">
                    <h3 class="text-xl font-semibold text-purple-900 mb-4">🌙 Ramadan Spécial</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        اللهم تقبل منا صيامنا وقيامنا وتجاوز عن سيئاتنا وبلغنا ليلة القدر.
                    </p>
                    <p class="text-sm text-gray-600 mt-2 italic">
                        "O Allah, accept our fasting and prayers, forgive our sins, and grant us the blessings of Laylatul Qadr."
                    </p>
                </div>

                <!-- Night Dua -->
                <div class="p-6 bg-white rounded-lg shadow-md border">
                    <h3 class="text-xl font-semibold text-purple-900 mb-4">🌌 Nuit</h3>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        اللهم إني أسألك العفو والعافية في الدنيا والآخرة.
                    </p>
                    <p class="text-sm text-gray-600 mt-2 italic">
                        "O Allah, I ask You for forgiveness and well-being in this life and the Hereafter."
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Modal Form -->
<div id="experienceFormModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4 shadow-xl max-h-[80vh] overflow-y-auto [&::-webkit-scrollbar]:hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Partagez votre expérience</h3>
            <button onclick="hideExperienceForm()" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>
        <form action="{{ route('temoignages.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Votre nom</label>
                <input type="text" name="nom" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez votre nom">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                <input type="text" name="titre" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Donnez un titre à votre expérience">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="contenu" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary h-20 resize-none" placeholder="Partagez votre expérience..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL de la photo</label>
                <input type="url" name="image_url" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez l'URL de votre image">
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

@if(session('success'))
<div id="successPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
        <h3 class="text-2xl font-bold">Expérience Publiée! 🎉🕌🌙</h3>
        <p class="mt-2 text-lg">{{ session('success') }}</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successPopup = document.getElementById('successPopup');

        if (successPopup) {
            successPopup.classList.remove('hidden');
            setTimeout(() => {
                successPopup.classList.add('hidden');
            }, 3000);
        }
    });
</script>
@endif

<script>
    function showExperienceForm() {
        document.getElementById("experienceFormModal").classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }

    function hideExperienceForm() {
        document.getElementById("experienceFormModal").classList.add("hidden");
        document.body.style.overflow = "auto";
    }
</script>

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