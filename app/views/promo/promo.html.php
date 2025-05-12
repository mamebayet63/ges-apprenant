            <?php if ($promos) : ?>
                 <!-- Graphique et Activités -->
            <div class=" gap-6 bg-white/80 backdrop-blur-sm border-b border-gray-100 rounded-xl p-6">
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
                      <a href="">
                            <button 
                            id="cardViewBtn" 
                            class="p-2 rounded-lg bg-white text-red-600 transition-colors duration-200  "
                            aria-label="Vue grille"
                        >
                            <i class="ri-grid-fill text-xl "></i>
                        </button>
                      </a>
                      <a href="<?= WEBROOT?>?controller=promo&affiche=liste">
                            <button 
                            id="tableViewBtn" 
                            class="p-2 rounded-lg hover:bg-white hover:text-red-600  transition-colors duration-200  "
                            aria-label="Vue liste"
                        >
                            <i class="ri-list-check text-xl "></i>
                        </button>
                      </a>
                    </div>
                </div>
                <div id="cardContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                        <?php foreach ($promos as $p) : ?>
                            <div class="group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 ease-out hover:-translate-y-1 border border-gray-100 hover:border-orange-100">
                                <!-- Photo de couverture -->
                                <div class="h-32 w-full rounded-t-xl overflow-hidden">
                                    <?php if ($p['cover_photo']) : ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($p['cover_photo']) ?>" 
                                            alt="<?= htmlspecialchars($p['nom']) ?>" 
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <?php else : ?>
                                        <div class="w-full h-full bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center">
                                            <i class="ri-team-line text-3xl text-red-200"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Contenu -->
                                <div class="p-5 flex flex-col h-full">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-md font-bold text-gray-800"><?= htmlspecialchars($p['nom']) ?></h3>

                                        <!-- Badge statut -->
                                        <span class="flex items-center gap-1 text-xs
                                            <?= $p['statut'] === 'Actif' ? 'text-emerald-600 bg-emerald-50' : 
                                                ($p['statut'] === 'Inactif' ? 'text-yellow-600 bg-yellow-50' : 'text-red-600 bg-red-50') ?>
                                            px-2 py-1 rounded-full">
                                            
                                            <i class="ri-<?= $p['statut'] === 'Inactif' ? 'checkbox-circle-line' : 
                                                        ($p['statut'] === 'Actif' ? 'time-line' : 'close-circle-line') ?> text-xs"></i>
                                            
                                            <?= htmlspecialchars($p['statut']) ?>
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-3 mb-5 text-gray-600">
                                        <i class="ri-calendar-2-line text-red-500"></i>
                                        <div>
                                            <p class="text-xs font-medium"><?= htmlspecialchars($p['date_debut']) ?> → <?= htmlspecialchars($p['date_fin']) ?></p>
                                            <p class="text-xs text-gray-400">Durée (<?= calculateDuration($p['date_debut'], $p['date_fin']) ?>)</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 pt-4 border-t border-dashed border-gray-100">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-2">
                                                <i class="ri-user-line text-red-500"></i>
                                                <span class="text-xs font-medium"><?= htmlspecialchars($p['nb_apprenants']) ?> apprentis</span>
                                            </div>
                                            <a href="#" class="flex items-center gap-1 text-red-600 hover:text-red-700 transition-colors text-xs font-medium">
                                                Voir détails
                                                <i class="ri-arrow-right-s-line transition-transform group-hover:translate-x-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                </div>
            </div>
        <?php endif; ?>
   
  