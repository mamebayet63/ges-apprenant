<?php if (!empty($_SESSION['success_message'])): ?>
    <div id="success-alert" class="fixed top-4 right-4 bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <?= htmlspecialchars($_SESSION['success_message']) ?>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<section class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-red-600 text-center animate-fade-in-down">
                Nos Matières
                <div class="w-16 h-1 bg-red-300 mx-auto mt-2 rounded-full"></div>
            </h1>
        </div>
        <div class="flex items-center gap-3">
            <button class="btn px-4 text-red-600 rounded-xl border border-red-500 hover:text-white hover:bg-red-700 transition-all flex items-center gap-2" onclick="my_modal_4.showModal()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter Matière
            </button>

            <dialog id="my_modal_4" class="modal <?= !empty($errors) || !empty($isEditing) ? 'modal-open' : '' ?>">
                <div class="modal-box w-11/12 md:w-4/12 max-w-3xl p-8 rounded-xl shadow-xl">
                    <!-- Header -->
                    <div class="flex items-center mb-8">
                        <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <h3 class="text-2xl font-bold text-red-600">
                            <?= !empty($isEditing) ? 'Modifier la matière' : 'Ajouter une nouvelle matière' ?>
                        </h3>
                    </div>

                    <!-- Formulaire -->
                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="form-control">
                            <label class="label pl-0">
                                <span class="label-text font-semibold text-gray-700">Libellé de la matière</span>
                            </label>
                            <input type="text" name="libelle" placeholder="Ex: Mathématiques"
                                value="<?= htmlspecialchars(
                                            $_POST['libelle'] ??
                                                $matiereToEdit['libelle'] ??
                                                ''
                                        ) ?>"
                                class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" />
                            <?php if (!empty($errors['libelle'])): ?>
                                <p class="text-red-600 text-sm mt-1"><?= $errors['libelle'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Actions -->
                        <div class="modal-action mt-8">
                            <button type="button" class="btn btn-ghost hover:bg-gray-100 px-6"
                                onclick="document.getElementById('my_modal_4').close()">Annuler</button>
                            <button type="submit" class="btn bg-red-600 hover:bg-red-700 px-6 text-white transition-transform hover:scale-105">
                                <?= !empty($isEditing) ? 'Mettre à jour' : 'Enregistrer' ?>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Overlay backdrop -->
                <form method="dialog" class="modal-backdrop bg-black/30 backdrop-blur-sm">
                    <button>close</button>
                </form>
            </dialog>

        </div>
    </div>

    <?php if ($matieres) : ?>
        <div class="gap-6 bg-white/80 backdrop-blur-sm border border-gray-100 rounded-xl p-6">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                <div class="relative w-full sm:max-w-md">
                    <input
                        type="text"
                        placeholder="Rechercher..."
                        class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition-all duration-200 placeholder-gray-400">
                    <i class="ri-search-2-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($matieres as $m) : ?>
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100 overflow-hidden">
                        <div class="p-6 relative">
                            <!-- Boutons d'action en haut à droite -->


                            <div class="flex items-baseline justify-between mb-3">
                                <h3 class="text-lg font-bold text-red-700 truncate"><?= htmlspecialchars($m['libelle']) ?></h3>
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Nouveau</span>
                            </div>

                            <div class="flex justify-between items-center ">
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-500">Créé le <?= date('d/m/Y', strtotime($m['created_at'])) ?></span>
                                </div>
                                <div class=" flex gap-2 h-8 mt-2  ">
                                    <a
                                        class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors"
                                        title="Modifier"
                                        href="<?= WEBROOT ?>?controller=matiere&is_editing=<?= $m['id'] ?>">

                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <button
                                        onclick="openModal('?controller=matiere&action=supprimer&id=<?= $m['id'] ?>')"
                                        class="p-2 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors"
                                        title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="flex justify-end mt-8">
                <nav class="pagination flex gap-x-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a
                            href="?controller=matiere&pagination=<?= $i ?>"
                            class="px-3 py-2 border border-red-300 rounded-lg font-medium text-sm 
                                <?= $i == $pagination
                                    ? 'bg-red-600 text-white ring-2 ring-red-300 border-transparent'
                                    : 'bg-white text-red-700 hover:bg-red-100 hover:text-red-800' ?>
                                transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-300">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </nav>
            </div>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
            <div class="relative w-64 h-64">
                <img src="assets/images/9214833-removebg-preview.png" alt="Aucun étudiant"
                    class="w-full h-full object-contain opacity-50">
            </div>
            <div class="text-center space-y-2">
                <p class="text-xl font-semibold text-gray-500">Aucune Matière trouvée</p>
                <p class="text-sm text-gray-500 max-w-md">
                    Aucun résultat pour votre recherche. Vérifiez le libellé ou essayez un autre terme.
                </p>
            </div>
        </div>
    <?php endif; ?>
</section>


<!-- Modal de confirmation -->
<div id="confirmDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-lg">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Confirmer la suppression</h2>
        <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette matière ? Cette action est irréversible.</p>

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300">Annuler</button>
            <form id="deleteForm" method="POST" action="">
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">Supprimer</button>
            </form>
        </div>
    </div>
</div>





<script>
    function openModal(deleteUrl) {
        const modal = document.getElementById('confirmDeleteModal');
        const form = document.getElementById('deleteForm');
        form.action = deleteUrl;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('confirmDeleteModal').classList.add('hidden');
    }
</script>