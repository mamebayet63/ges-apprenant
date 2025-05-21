<div class="min-h-screen bg-gray-50 p-8">
    <!-- Header -->
    <div class="max-w-6xl mx-auto mb-8">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="ri-add-circle-line text-red-600"></i>
                Nouvelle Promotion
            </h1>
            <a href="liste-promotions.html" class="text-red-600 hover:text-red-700 flex items-center gap-2">
                <i class="ri-arrow-left-line"></i>
                Retour aux promotions
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8">
        <form class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Colonne gauche -->
            <div class="space-y-6">
                <!-- Nom promotion -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la promotion <span class="text-red-600">*</span>
                    </label>
                    <input type="text"  name="nom"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"
                        placeholder="Promotion 2024">
                </div>

                <!-- Dates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date de début <span class="text-red-600">*</span>
                        </label>
                        <input type="date"  name="date_debut"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date de fin <span class="text-red-600">*</span>
                        </label>
                        <input type="date"  name="date_fin"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">
                    </div>
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Statut <span class="text-red-600">*</span>
                    </label>
                    <select name="statut" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="space-y-6">
                <!-- Photo de couverture -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Photo de couverture
                    </label>
                    <div class="relative border-2 border-dashed border-gray-300 rounded-xl h-48 flex items-center justify-center hover:border-red-300 transition-colors">
                        <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        <div class="text-center">
                            <i class="ri-image-add-line text-3xl text-red-500 mb-2"></i>
                            <p class="text-sm text-gray-600">Glissez-déposez ou cliquez pour uploader</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG (max. 2MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-red-50 p-6 rounded-xl">
                    <h3 class="text-sm font-semibold text-red-700 mb-4">
                        <i class="ri-information-line"></i>
                        Statistiques à prévoir
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between text-sm text-gray-700">
                            <span>Nombre d'apprenants</span>
                            <input type="number" name="nb_apprenants" class="w-20 px-3 py-1 rounded border border-gray-300">
                        </li>
                        
                    </ul>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="md:col-span-2 border-t border-gray-200 pt-8">
                <div class="flex justify-end gap-4">
                    <button type="reset" class="px-6 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all flex items-center gap-2">
                        <i class="ri-save-line"></i>
                        Enregistrer la promotion
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>