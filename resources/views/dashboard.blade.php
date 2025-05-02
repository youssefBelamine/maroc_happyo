<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Barre latérale -->
        <aside class="bg-white shadow-md p-6 w-64">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-blue-600 font-medium">
                        <i class="bi bi-speedometer2 mr-2"></i> Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('annonce') }}" class="flex items-center text-gray-700 hover:text-blue-600 font-medium">
                        <i class="bi bi-megaphone mr-2"></i> Annonces
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-700 hover:text-blue-600 font-medium">
                        <i class="bi bi-people-fill mr-2"></i> Utilisateurs
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-700 hover:text-blue-600 font-medium">
                        <i class="bi bi-tags-fill mr-2"></i> Catégories
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Contenu principal -->
        <main class="flex-1 p-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h1 class="text-xl font-bold text-blue-600 flex items-center mb-4">
                    <i class="bi bi-speedometer2 mr-2"></i>
                    Tableau de bord administratif
                </h1>
                <p class="text-gray-600">Bienvenue dans l'espace d'administration de Maroc Happyo.</p>

                <!-- Contenu dynamique -->
                <div class="mt-6">
                    <!-- Exemple : statistiques ou autres composants -->
                    <div class="bg-blue-100 text-blue-800 p-4 rounded">
                        Vous pouvez gérer les annonces, utilisateurs et catégories depuis cette interface.
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>