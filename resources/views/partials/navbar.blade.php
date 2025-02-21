<!-- navbar -->
<nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <span class="text-2xl font-['Pacifico'] text-primary">RamadON</span>
                <div class="hidden md:flex ml-10 space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-900 hover:text-primary px-3 py-2 text-sm font-medium">Accueil</a>
                    <a href="{{ url('/temoignages') }}" class="text-gray-900 hover:text-primary px-3 py-2 text-sm font-medium">Expériences</a>
                    <a href="{{ url('/recettes') }}" class="text-gray-900 hover:text-primary px-3 py-2 text-sm font-medium">Recettes</a>
                    <a href="{{ url('/statistiques') }}" class="text-gray-900 hover:text-primary px-3 py-2 text-sm font-medium">Statistiques</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="w-64 pl-10 pr-4 py-2 text-sm border rounded-full focus:outline-none focus:border-primary">
                    <div class="absolute left-3 top-2 w-5 h-5 flex items-center justify-center">
                        <i class="ri-search-line text-gray-400"></i>
                    </div>
                </div>
                <button class="rounded-lg bg-black text-white px-4 py-2 text-sm font-medium hover:bg-purple-900 whitespace-nowrap">
                    Se connecter
                </button>
            </div>
        </div>
    </div>
</nav>
