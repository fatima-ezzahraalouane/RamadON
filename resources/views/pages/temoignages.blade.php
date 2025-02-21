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
                                data-id="{{ $temoignage->id }}">
                                <i class="ri-chat-1-line mr-1"></i>
                                    <span id="comment-count-{{ $temoignage->id }}">{{ $temoignage->commentaires->count() }}</span>
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
                    <!-- Example Comment -->
        <!-- <div class="space-y-4 mb-6">
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
        </div> -->

        <!-- Scrollable Comments Section -->
        <div id="commentList" class="space-y-4 mb-6 max-h-64 overflow-y-auto [&::-webkit-scrollbar]:hidden">
            <!-- Comments will be inserted here dynamically -->
        </div>

        <form action="{{ route('commentaires.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="temoignage_id" name="temoignage_id">

            <div>
                <input type="text" name="nom" placeholder="Votre nom" required class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <div>
                <textarea name="contenu" placeholder="Votre commentaire" required class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary h-20 resize-none"></textarea>
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
<!-- <div id="successPopup" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
        <h3 class="text-2xl font-bold">Commentaire Ajouté! 🎉🌙</h3>
        <p class="mt-2 text-lg">Votre commentaire a été publié avec succès.</p>
    </div>
</div> -->



<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Check for success popup on page load (for redirects)
    if (document.getElementById("successPopup")) {
        setTimeout(() => {
            document.getElementById("successPopup").classList.add("hidden");
        }, 3000);
    }

    // Attach event listener to all comment buttons
    document.querySelectorAll(".comment-btn").forEach(button => {
        button.addEventListener("click", function () {
            let temoignageId = this.getAttribute("data-id");
            showCommentForm(temoignageId);
        });
    });

    // Handle comment form submission with AJAX
    document.querySelector("form").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let temoignageId = formData.get("temoignage_id");

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear the form fields
                document.querySelector('input[name="nom"]').value = '';
                document.querySelector('textarea[name="contenu"]').value = '';
                
                // Close the modal
                hideCommentForm();
                
                // Update the comment count
                let commentCount = document.getElementById(`comment-count-${temoignageId}`);
                commentCount.textContent = parseInt(commentCount.textContent) + 1;

                // Create and show success popup
                createSuccessPopup(data.message);
            }else {
            // ❌ If there's an error
            createErrorPopup("Une erreur s'est produite lors de l'envoi du commentaire.");
        }
        })
        .catch(error => {
            console.error("Erreur lors de l'envoi du commentaire:", error);
            createErrorPopup("Une erreur s'est produite lors de l'envoi du commentaire.");
        });
    });
});

function createSuccessPopup(message) {
    // Remove existing popup if any
    const existingPopup = document.getElementById("successPopup");
    if (existingPopup) {
        existingPopup.remove();
    }
    
    // Create new popup
    const successPopup = document.createElement('div');
    successPopup.id = 'successPopup';
    successPopup.className = 'fixed inset-0 flex items-center justify-center z-50';
    successPopup.innerHTML = `
        <div class="bg-gradient-to-r from-black to-purple-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
            <h3 class="text-2xl font-bold">Commentaire Ajouté! 🎉🌙</h3>
            <p class="mt-2 text-lg">${message}</p>
        </div>
    `;
    
    // Add to document
    document.body.appendChild(successPopup);
    
    // Remove after 3 seconds
    setTimeout(() => {
        successPopup.classList.add('opacity-0');
        successPopup.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            successPopup.remove();
        }, 500);
    }, 3000);
}

function createErrorPopup(message) {
    const errorPopup = document.createElement('div');
    errorPopup.id = 'errorPopup';
    errorPopup.className = 'fixed inset-0 flex items-center justify-center z-50';
    errorPopup.innerHTML = `
        <div class="bg-gradient-to-r from-red-600 to-red-800 text-white px-8 py-6 rounded-lg shadow-2xl animate-fadeIn transform scale-95">
            <h3 class="text-2xl font-bold">Erreur</h3>
            <p class="mt-2 text-lg">${message}</p>
        </div>
    `;
    
    document.body.appendChild(errorPopup);
    
    setTimeout(() => {
        errorPopup.classList.add('opacity-0');
        errorPopup.style.transition = 'opacity 0.5s ease';
        setTimeout(() => {
            errorPopup.remove();
        }, 500);
    }, 3000);
}

function showCommentForm(temoignageId) {
    document.getElementById("commentModal").classList.remove("hidden");
    document.body.style.overflow = "hidden";
    document.getElementById("temoignage_id").value = temoignageId;

    // Fetch comments from Laravel route
    fetch(`/commentaires/${temoignageId}`)
        .then(response => response.json())
        .then(data => {
            let commentList = document.getElementById("commentList");
            commentList.innerHTML = "";

            if (data.length === 0) {
                commentList.innerHTML = `<p class="text-gray-500 text-center py-4">Aucun commentaire pour le moment. Soyez le premier à commenter!</p>`;
                return;
            }

            data.forEach(comment => {
                let formattedDate = new Date(comment.created_at).toLocaleDateString("fr-FR", {
                    year: "numeric",
                    month: "long",
                    day: "numeric"
                });

                commentList.innerHTML += `
                    <div class="flex items-start space-x-4">
                        <img src="https://public.readdy.ai/ai/img_res/7981d1aa5d3fb0443327a7dbfa075c17.jpg" class="w-10 h-10 rounded-full" alt="User">
                        <div>
                            <div class="flex items-center">
                                <span class="font-medium">${comment.nom}</span>
                                <span class="text-gray-500 text-sm ml-2">${formattedDate}</span>
                            </div>
                            <p class="text-gray-600 mt-1">${comment.contenu}</p>
                        </div>
                    </div>
                `;
            });

            // Update comment count
            document.getElementById(`comment-count-${temoignageId}`).textContent = data.length;
        })
        .catch(error => console.error("Error fetching comments:", error));
}

function hideCommentForm() {
    document.getElementById("commentModal").classList.add("hidden");
    document.body.style.overflow = "auto";
}

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
