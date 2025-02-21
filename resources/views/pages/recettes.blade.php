@extends('layouts.app')

@section('title', 'Recettes Populaires')

@section('content')
<section id="recipes" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold">Recettes Populaires</h2>
            <button onclick="document.getElementById('addRecipeModal').classList.remove('hidden')"
            class="rounded-lg bg-black text-white px-6 py-3 font-medium hover:bg-purple-900 flex items-center gap-2">
                <i class="ri-add-line"></i> Ajouter une recette
            </button>
        </div>

        <div class="flex justify-center mb-8 space-x-4">
    <a href="{{ route('recettes.index', ['categorie' => 'tous']) }}"
       class="rounded-lg px-4 py-2 {{ request('categorie') == 'tous' || !request('categorie') ? 'bg-black text-white' : 'bg-white text-gray-700' }} font-medium hover:bg-purple-900">
       Tous
    </a>

    @foreach($categories as $cat)
        <a href="{{ route('recettes.index', ['categorie' => $cat->nom]) }}"
           class="rounded-lg px-4 py-2 {{ request('categorie') == $cat->nom ? 'bg-black text-white' : 'bg-white text-gray-700' }} font-medium hover:bg-purple-900">
           {{ ucfirst($cat->nom) }}
        </a>
    @endforeach
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
                    <span class="bg-purple-900 text-white text-sm px-3 py-1 rounded-full">{{ ucfirst($recette->categorie->nom) }}</span>
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
                        <button onclick="showRecipeDetails(
                            '{{ $recette->titre }}',
                            '{{ $recette->duree }}',
                            '{{ $recette->portions }}',
                            '{{ $recette->difficulte }}',
                            '{{ $recette->ingredient }}',
                            '{{ $recette->instructions }}'
                        )" class="rounded-lg bg-black text-white px-4 py-2 text-sm font-medium hover:bg-purple-900 flex items-center">
                            <i class="ri-eye-line mr-2"></i> Voir la recette
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recipe Details Modal -->
<div id="recipeDetailsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-xl w-full mx-4 shadow-xl">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 id="recipeTitle" class="text-2xl font-bold mb-2"></h3>
                <div class="flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <i class="ri-time-line mr-1"></i> <span id="recipeTime"></span> min
                    </span>
                    <span class="flex items-center">
                        <i class="ri-user-line mr-1"></i> <span id="recipePortions"></span> 6 personnes
                    </span>
                    <span class="flex items-center">
                        <i class="ri-fire-line mr-1"></i> <span id="recipeDifficulty"></span> Moyen
                    </span>
                </div>
            </div>
            <button onclick="hideRecipeDetails()" class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <div class="grid grid-cols-2 gap-8">
            <!-- Ingrédients -->
    <div>
        <h4 class="font-semibold mb-4 text-lg">Ingrédients</h4>
        <ul class="list-none space-y-2 text-gray-600">
            @foreach(explode(',', $recette->ingredient) as $ingredient)
                <li>{{ trim($ingredient) }}</li>
            @endforeach
        </ul>
    </div>
            <!-- Instructions -->
    <div>
        <h4 class="font-semibold mb-4 text-lg">Instructions</h4>
        <ol class="list-decimal list-inside space-y-2 text-gray-600">
            @foreach(explode(',', $recette->instructions) as $index => $instruction)
                <li>{{ trim($instruction) }}</li>
            @endforeach
        </ol>
    </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-8">
            <h4 class="font-semibold mb-4">Commentaires</h4>
            <div id="recipeComments" class="space-y-4 mb-6"></div>

            <!-- Example Comment -->
            <div class="flex items-start space-x-4">
                <img src="https://public.readdy.ai/ai/img_res/6c73c89fc2ffcc767a430badfa2b9b1b.jpg" class="w-10 h-10 rounded-full" alt="User">
                <div>
                    <div class="flex items-center">
                        <span class="font-medium">Sophie Martin</span>
                        <span class="text-gray-500 text-sm ml-2">Il y a 3 jours</span>
                    </div>
                    <p class="text-gray-600 mt-1">Excellente recette ! Je l'ai essayée hier, c'était délicieux.</p>
                </div>
            </div>
        </div>

        <!-- Comment Form -->
        <form class="space-y-4" onsubmit="addRecipeComment(event)">
            <div>
                <input type="text" id="commentName" placeholder="Votre nom" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" required>
            </div>
            <div>
                <textarea id="commentText" placeholder="Votre commentaire" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary h-20" required></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="hideRecipeDetails()" class="rounded-lg px-6 py-2 border border-gray-300 text-gray-700 hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit" class="rounded-lg bg-black text-white px-4 py-2 hover:bg-purple-900">
                    Publier le commentaire
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal d'ajout de recette -->
<div id="addRecipeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full mx-4 shadow-xl max-h-[80vh] overflow-y-auto [&::-webkit-scrollbar]:hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Ajouter une recette</h3>
            <button onclick="document.getElementById('addRecipeModal').classList.add('hidden')"
                    class="text-gray-500 hover:text-gray-700">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('recettes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Votre Nom</label>
                <input type="text" name="nom" required
                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Titre de la recette</label>
                <input type="text" name="titre" required
                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select name="categorie_id" required
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Temps de préparation (minutes)</label>
                <input type="number" name="duree" required min="1"
                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" required
                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ingrédients (séparés par une virgule)</label>
                <textarea name="ingredient" required
                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Instructions (séparées par une virgule)</label>
                <textarea name="instructions" required
                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">URL de la photo</label>
                <input type="url" name="image_url" required
                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-purple-900 focus:border-purple-900">
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" onclick="document.getElementById('addRecipeModal').classList.add('hidden')"
                        class="rounded-lg px-6 py-2 border border-gray-300 text-black hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit" class="rounded-lg bg-black text-white px-4 py-2 hover:bg-purple-900">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Success Popup -->
@if(session('success'))
<div id="successPopupRecette" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl">
        <h3 class="text-2xl font-bold">Recette Ajoutée! 🎉</h3>
        <p class="mt-2 text-lg">{{ session('success') }}</p>
    </div>
</div>

<script>
    setTimeout(() => {
        document.getElementById('successPopupRecette').classList.add('hidden');
    }, 3000);
</script>
@endif


<!-- Success Popup -->
<div id="successPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
        <h3 class="text-2xl font-bold">Commentaire Publié! 🎉</h3>
        <p class="mt-2 text-lg">Votre commentaire a été ajouté avec succès.</p>
    </div>
</div>

<script>
    function showRecipeDetails(title, time, portions, difficulty, ingredient, instructions) {
        document.getElementById("recipeTitle").textContent = title;
        document.getElementById("recipeTime").textContent = time;
        document.getElementById("recipePortions").textContent = portions;
        document.getElementById("recipeDifficulty").textContent = difficulty;

        let ingredientList = document.getElementById("recipeIngredients");
        ingredientList.innerHTML = "";
        ingredient.split(",").forEach(item => {
            let li = document.createElement("li");
            li.textContent = item.trim();
            ingredientList.appendChild(li);
        });

        let instructionList = document.getElementById("recipeInstructions");
        instructionList.innerHTML = "";
        instructions.split(",").forEach(step => {
            let li = document.createElement("li");
            li.textContent = step.trim();
            instructionList.appendChild(li);
        });

        document.getElementById("recipeDetailsModal").classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }

    function hideRecipeDetails() {
        document.getElementById("recipeDetailsModal").classList.add("hidden");
        document.body.style.overflow = "auto";
    }

    function addRecipeComment(event) {
        event.preventDefault();

        let name = document.getElementById("commentName").value;
        let comment = document.getElementById("commentText").value;

        let newCommentHTML = `
            <div class="flex items-start space-x-4 opacity-0 transform translate-y-4">
                <img src="https://public.readdy.ai/ai/img_res/placeholder.jpg" class="w-10 h-10 rounded-full" alt="User">
                <div>
                    <div class="flex items-center">
                        <span class="font-medium">${name}</span>
                        <span class="text-gray-500 text-sm ml-2">À l'instant</span>
                    </div>
                    <p class="text-gray-600 mt-1">${comment}</p>
                </div>
            </div>
        `;

        document.getElementById("recipeComments").innerHTML += newCommentHTML;

        // Show pop-up success message
        const successPopup = document.getElementById("successPopup");
        successPopup.classList.remove("hidden");
        successPopup.classList.add("animate-scaleIn");

        // Hide after 3 seconds
        setTimeout(() => {
            successPopup.classList.add("hidden");
            successPopup.classList.remove("animate-scaleIn");
        }, 3000);

        // Close the form & reset fields
        hideRecipeDetails();
        document.getElementById("commentName").value = "";
        document.getElementById("commentText").value = "";
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