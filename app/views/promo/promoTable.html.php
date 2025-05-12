<div class="gap-6 bg-white/80 backdrop-blur-sm border-b border-gray-100 rounded-xl p-6">
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <!-- Search Bar -->
        <div class="relative w-full sm:max-w-md">
            <input 
                type="text" 
                placeholder="Rechercher..." 
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition-all duration-200 placeholder-gray-400"
            >
            <i class="ri-search-2-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
        </div>

        <!-- View Toggles -->
        <div class="flex gap-2 bg-gray-100 p-1 rounded-xl">
            <a href="<?= WEBROOT?>?controller=promo">
                <button 
                    id="cardViewBtn" 
                    class="p-2 rounded-lg hover:bg-white hover:text-red-600 transition-colors duration-200"
                    aria-label="Vue grille"
                >
                    <i class="ri-grid-fill text-xl"></i>
                </button>
            </a>
            <a href="<?= WEBROOT ?>?controller=promo&affiche=liste">
                <button 
                    id="tableViewBtn" 
                    class="p-2 rounded-lg bg-white text-red-600 transition-colors duration-200"
                    aria-label="Vue liste"
                >
                    <i class="ri-list-check text-xl"></i>
                </button>
            </a>
        </div>
    </div>

    <div id="tableContainer" class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Début</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Fin</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Référentiels</th>
                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                <?php foreach ($promos as $p) : ?>
                    <tr class="group hover:bg-gray-50 transition">
                        <!-- Photo -->
                        <td class="px-2 py-2 bg-white">
                            <div class="w-12 h-12 rounded-md overflow-hidden">
                                <?php if ($p['cover_photo']) : ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($p['cover_photo']) ?>" 
                                        alt="<?= htmlspecialchars($p['nom']) ?>" 
                                        class="w-full h-full object-cover transition-transform group-hover:scale-110">
                                <?php else : ?>
                                    <div class="w-full h-full bg-red-50 flex items-center justify-center">
                                        <i class="ri-team-line text-xl text-red-200"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- Nom -->
                        <td class="px-2 py-4 bg-white">
                            <div class="font-semibold text-sm text-gray-900 truncate max-w-[130px] hover:max-w-none transition-all duration-200">
                                <?= htmlspecialchars($p['nom']) ?>
                            </div>
                        </td>

                        <!-- Date début -->
                        <td class="px-2 py-4">
                            <span class="text-sm text-gray-700"><?= htmlspecialchars($p['date_debut']) ?></span>
                        </td>

                        <!-- Date fin -->
                        <td class="px-2 py-4">
                            <span class="text-sm text-gray-700"><?= htmlspecialchars($p['date_fin']) ?></span>
                        </td>

                        <!-- Référentiels -->
                        <td class="px-2 py-4">
                            <div class="flex items-center gap-2 overflow-x-auto max-w-[260px] no-scrollbar">
                                <?php if (!empty($p['referentiels']) && is_array($p['referentiels'])) : ?>
                                    <?php foreach ($p['referentiels'] as $ref) : ?>
                                        <span class="whitespace-nowrap px-2.5 py-1 bg-blue-50 text-blue-700 text-xs rounded-full">
                                            <?= htmlspecialchars($ref) ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </td>

                        <!-- Statut -->
                        <td class="px-2 py-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm
                                <?= $p['statut'] === 'Terminée' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' ?>">
                                <i class="ri-<?= $p['statut'] === 'Terminée' ? 'check' : 'close' ?>-circle-line mr-2"></i>
                                <?= htmlspecialchars($p['statut']) ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-2 py-4 bg-white">
                            <div class="flex items-center gap-3">
                                <button 
                                    class="delete-btn p-1.5 rounded-lg hover:bg-gray-100 transition-colors" 
                                    title="Supprimer" 
                                    data-id="<?= $p['id'] ?>">
                                    <i class="ri-delete-bin-line text-lg text-gray-600 hover:text-red-600"></i>
                                </button>
                                <!-- Ajoute ici d'autres actions si besoin -->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
