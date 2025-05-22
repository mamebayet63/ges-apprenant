<?php require_once ROOT_PATH . "/app/views/components/stats.php"; ?>

     <?php if (!empty($_SESSION['success_message'])): ?>
    <div id="success-alert" class="fixed top-4 right-4 bg-emerald-500 text-white px-6 py-3 rounded shadow-lg z-50">
        <?= htmlspecialchars($_SESSION['success_message']) ?>
    </div>
    <script>
      // Cacher le message après 5 secondes
      setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
          alert.style.display = 'none';
        }
      }, 5000);
    </script>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

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
                      <a href="<?= WEBROOT?>?controller=promo">
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
                                    <?php if (!empty($p['cover_photo'])): 

                                        // Si c'est une ressource (stream), on lit son contenu en chaîne
                                        if (is_resource($p['cover_photo'])) {
                                            $data = stream_get_contents($p['cover_photo']);
                                        } else {
                                            $data = $p['cover_photo'];
                                        }

                                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                        $type = finfo_buffer($finfo, $data);
                                        finfo_close($finfo);
                                    ?>
                                          <img src="data:<?= $type ?>;base64,<?= base64_encode($data) ?>" 
                                              alt="<?= htmlspecialchars($p['nom']) ?>" 
                                              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                      <?php else: ?>
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
                                        <div class="flex items-center gap-2">
                                                <!-- Badge Statut -->
                                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-xs font-medium rounded-full transition-colors
                                                    <?= $p['statut'] === 'Actif' 
                                                        ? 'text-emerald-700 bg-emerald-100/80 ring-1 ring-emerald-200 hover:bg-emerald-200/60' 
                                                        : 'text-red-700 bg-red-100/80 ring-1 ring-red-200 hover:bg-red-200/60' ?>">
                                                    <i class="ri-<?= $p['statut'] === 'Actif' ? 'checkbox-circle-fill' : 'indeterminate-circle-fill' ?> text-base"></i>
                                                    <?= htmlspecialchars($p['statut']) ?>
                                                </span>

                                            <!-- Bouton Action -->
                                           <a 
                                                    href="javascript:void(0);" 
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full shadow-sm transition-all <?= $p['statut'] === 'Inactif' ? 'text-emerald-600 bg-white ring-1 ring-emerald-200 hover:bg-emerald-50 hover:ring-emerald-300' : 'text-red-600 bg-white ring-1 ring-red-200 hover:bg-red-50 hover:ring-red-300' ?>"
                                                    onclick="openConfirmationModal(<?= $p['id'] ?>, '<?= $p['statut'] ?>')"
                                                >
                                                    <i class="ri-shut-down-line text-sm"></i>
                                                </a>


                                        </div>
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
                <div class="flex justify-end">
                    <nav class="pagination mt-4 flex gap-x-2">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a 
                                href="?controller=promo&page=promo&pagination=<?= $i ?>" 
                                class="px-3 py-2 border border-red-300 rounded-lg font-medium text-sm 
                                    <?= $i == $pagination 
                                        ? 'bg-red-600 text-white ring-2 ring-red-300 border-transparent' 
                                        : 'bg-white text-red-700 hover:bg-red-100 hover:text-red-800' ?>
                                    transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-300"
                            >
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </nav>
                </div>
        <?php endif; ?>
   
<!-- Modal de confirmation -->
<input type="checkbox" id="confirm-modal" class="modal-toggle" />
<div class="modal backdrop-blur-sm">
  <div class="modal-box p-8 max-w-md relative rounded-xl shadow-2xl border border-red-100">
    <!-- Icone d'avertissement -->
    <div class="flex justify-center mb-4">
      <div class="p-3 bg-red-50 rounded-full">
        <i class="ri-alert-line text-3xl text-red-600"></i>
      </div>
    </div>

    <h3 class="text-2xl font-semibold text-center text-gray-800 mb-2">Confirmation requise</h3>
    
    <p class="text-gray-600 text-center mb-6 leading-relaxed">
      Êtes-vous sûr de vouloir modifier le statut de cette promotion ?<br>
      <span class="text-red-500 text-sm">Cette action est irréversible.</span>
    </p>

    <input type="hidden" id="promo-id" />
    <input type="hidden" id="statut" />

    <div class="modal-action flex justify-center gap-4 mt-6">
      <label for="confirm-modal" 
             class="btn px-8 py-2.5 border border-gray-300 bg-white text-gray-700 
                    hover:bg-gray-50 hover:border-gray-400 hover:text-gray-800
                    transition-all duration-200 focus:ring-2 focus:ring-red-300">
        <i class="ri-close-line mr-2"></i>
        Annuler
      </label>
      <button id="confirm-button" 
              class="btn px-8 py-2.5 bg-red-600 text-white 
                     hover:bg-red-700 hover:shadow-lg 
                     transition-all duration-200 
                     focus:ring-2 focus:ring-red-300 focus:ring-offset-2">
        <i class="ri-check-line mr-2"></i>
        Confirmer
      </button>
    </div>
  </div>
</div>
</div>

<script>
  function openConfirmationModal(promoId , statut) {
    // Injecter l’ID dans le champ caché
    document.getElementById('promo-id').value = promoId;
    document.getElementById('statut').value = statut;

    // Ouvrir la modal
            document.getElementById('confirm-modal').checked = true;
            const confirmButton = document.getElementById('confirm-button');
        console.log(statut);
        
         if (statut === "Actif") {
    // Cas désactivation
    confirmButton.classList.remove('bg-emerald-600', 'btn-success');
    confirmButton.classList.add('bg-red-600', 'btn-error');
    confirmButton.innerHTML = `<i class="ri-close-line mr-2"></i> Désactiver`;
    confirmButton.disabled = false;
  } else {
    // Cas activation
    confirmButton.classList.remove('bg-red-600', 'btn-error');
    confirmButton.classList.add('bg-emerald-600', 'btn-success');
    confirmButton.innerHTML = `<i class="ri-check-line mr-2"></i> Activer`;
    confirmButton.disabled = false;
  }
   document.getElementById('confirm-button').addEventListener('click', function () {
    const promoId = document.getElementById('promo-id').value;

    // Exemple : rediriger vers une URL pour changer le statut
    window.location.href = `?controller=promo&action=${statut}&id_promo=${promoId}`;

  });
  }
  
 
</script>
