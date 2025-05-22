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
                    <?php afficherPhoto($p['cover_photo'], $p['nom']); ?>
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
                                <?= $p['statut'] === 'Actif' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' ?>">
                                <i class="ri-<?= $p['statut'] === 'Actif' ? 'check' : 'close' ?>-circle-line mr-2"></i>
                                <?= htmlspecialchars($p['statut']) ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-2 py-4 bg-white">
                            <div class="flex items-center gap-3">
                                <a 
                                    href="javascript:void(0);" 
                                    class="inline-flex items-center px-2 py-0.5 rounded-full shadow-sm transition-all <?= $p['statut'] === 'Inactif' ? 'text-emerald-600 bg-white ring-1 ring-emerald-200 hover:bg-emerald-50 hover:ring-emerald-300' : 'text-red-600 bg-white ring-1 ring-red-200 hover:bg-red-50 hover:ring-red-300' ?>"
                                    onclick="openConfirmationModal(<?= $p['id'] ?>, '<?= $p['statut'] ?>')"
                                    >
                                    <i class="ri-shut-down-line text-sm"></i>
                                </a>
                                <!-- Ajoute ici d'autres actions si besoin -->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav class="pagination mt-4">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?controller=promo&page=promo&affiche=liste&pagination=<?= $i ?>" class="px-3 py-1 border <?= $i == $pagination ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
    </nav>
</div>

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
    window.location.href = `?controller=promo&affiche=liste&action=${statut}&id_promo=${promoId}`;

  });
  }
  
 
</script>