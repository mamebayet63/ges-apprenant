
    <div class=" mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-red-600">Liste des Apprenants</h1>
                <p class="text-gray-600 mt-2">Gérez et suivez les apprenants de votre organisation</p>
            </div>
            
        </div>
        <div class="flex items-center gap-3 justify-end mb-5">
                <a href="<?= WEBROOT?>?controller=apprenant&page=telecharger&format=pdf" class="btn bg-red-600 text-white hover:bg-red-700">📄 Télécharger PDF</a>
                <a href="<?= WEBROOT?>?controller=apprenant&page=telecharger&format=excel" class="btn bg-green-600 text-white hover:bg-green-700">📊 Télécharger Excel</a>
                <button class="btn px-4  text-red-600 rounded-xl border border-red-500 hover:text-white  hover:bg-red-700 transition-all" onclick="my_modal_4.showModal()">Ajouter Apprenant</button>
                <dialog id="my_modal_4" class="modal <?= !empty($errors) ? 'modal-open' : '' ?>">
                  <div class="modal-box w-11/12 md:w-8/12 max-w-3xl p-8 rounded-xl shadow-xl">
                    <!-- En-tête avec icône -->
                    <div class="flex items-center mb-8">
                      <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                      </svg>
                      <h3 class="text-2xl font-bold text-red-600">Ajouter un nouvel apprenant</h3>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                      <!-- Informations de l'apprenant -->
                      <div class="space-y-6">
                        <h4 class="text-lg font-semibold text-gray-700">Informations personnelles</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Nom -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Nom</span>
                            </label>
                            <input type="text" name="nom" placeholder="Dupont"
                              value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500"/>
                            <?php if (isset($errors['nom'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['nom'] ?></p>
                            <?php endif; ?>
                          </div>

                          <!-- Prénom -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Prénom</span>
                            </label>
                            <input type="text" name="prenom" placeholder="Jean"
                              value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '' ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500"/>
                            <?php if (isset($errors['prenom'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['prenom'] ?></p>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Date de naissance -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Date de naissance</span>
                            </label>
                            <input type="date" name="date_naissance"
                              value="<?= isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['date_naissance'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['date_naissance'] ?></p>
                            <?php endif; ?>
                          </div>

                          <!-- Lieu de naissance -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Lieu de naissance</span>
                            </label>
                            <input type="text" name="lieu_naissance" placeholder="Paris"
                              value="<?= isset($_POST['lieu_naissance']) ? htmlspecialchars($_POST['lieu_naissance']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['lieu_naissance'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['lieu_naissance'] ?></p>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Adresse -->
                            <div class="form-control">
                              <label class="label pl-0">
                                <span class="label-text font-semibold text-gray-700">Adresse</span>
                              </label>
                              <input type="text" name="adresse" placeholder="123 Rue de la République"
                                value="<?= isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : '' ?>"
                                class="input input-bordered w-full"/>
                              <?php if (isset($errors['adresse'])): ?>
                                <p class="text-red-600 text-sm"><?= $errors['adresse'] ?></p>
                              <?php endif; ?>
                            </div>
                            <!-- Sélection du référentiel -->
                            <div class="form-control">
                              <label class="label pl-0">
                                <span class="label-text font-semibold text-gray-700">Référentiel</span>
                              </label>
                              <select name="id_referentiel" class="select select-bordered w-full">
                                <option value="">-- Sélectionnez un référentiel --</option>
                                <?php foreach ($referentiels as $ref): ?>
                                  <option value="<?= $ref['id'] ?>"
                                    <?= isset($_POST['id_referentiel']) && $_POST['id_referentiel'] == $ref['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($ref['libelle']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                              <?php if (isset($errors['id_referentiel'])): ?>
                                <p class="text-red-600 text-sm"><?= $errors['id_referentiel'] ?></p>
                              <?php endif; ?>
                            </div>

                          </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Email -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Email</span>
                            </label>
                            <input type="email" name="email" placeholder="jean.dupont@example.com"
                              value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['email'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['email'] ?></p>
                            <?php endif; ?>
                          </div>

                          <!-- Téléphone -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Téléphone</span>
                            </label>
                            <input type="tel" name="telephone" placeholder="06 12 34 56 78"
                              value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['telephone'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['telephone'] ?></p>
                            <?php endif; ?>
                          </div>
                        </div>

                        <!-- Photo -->
                        <div class="form-control">
                          <label class="label pl-0">
                            <span class="label-text font-semibold text-gray-700">Photo de l'apprenant</span>
                          </label>
                          <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col w-full border-2 border-dashed hover:border-red-200 transition-colors rounded-lg p-8 text-center cursor-pointer">
                              <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                              </svg>
                              <input type="file" class="hidden" name="photo" accept="image/*"/>
                              <span class="text-gray-600">Glissez-déposez ou cliquez pour uploader</span>
                              <span class="text-sm text-gray-500 mt-2">JPG, PNG ou GIF (max 2MB)</span>
                            </label>
                          </div>
                          <?php if (isset($errors['photo'])): ?>
                            <p class="text-red-600 text-sm"><?= $errors['photo'] ?></p>
                          <?php endif; ?>
                        </div>
                      </div>

                      <!-- Informations du tuteur -->
                      <div class="space-y-6 pt-6">
                        <h4 class="text-lg font-semibold text-gray-700">Informations du tuteur</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Tuteur Nom -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Nom du tuteur</span>
                            </label>
                            <input type="text" name="tuteur_nom" placeholder="Dupont"
                              value="<?= isset($_POST['tuteur_nom']) ? htmlspecialchars($_POST['tuteur_nom']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['tuteur_nom'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['tuteur_nom'] ?></p>
                            <?php endif; ?>
                          </div>

                          <!-- Tuteur Prénom -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Prénom du tuteur</span>
                            </label>
                            <input type="text" name="tuteur_prenom" placeholder="Marie"
                              value="<?= isset($_POST['tuteur_prenom']) ? htmlspecialchars($_POST['tuteur_prenom']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['tuteur_prenom'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['tuteur_prenom'] ?></p>
                            <?php endif; ?>
                          </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                          <!-- Lien de parenté -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Lien de parenté</span>
                            </label>
                            <input type="text" name="tuteur_lien" placeholder="Père, Mère, Tuteur légal..."
                              value="<?= isset($_POST['tuteur_lien']) ? htmlspecialchars($_POST['tuteur_lien']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['tuteur_lien'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['tuteur_lien'] ?></p>
                            <?php endif; ?>
                          </div>

                          <!-- Téléphone -->
                          <div class="form-control">
                            <label class="label pl-0">
                              <span class="label-text font-semibold text-gray-700">Téléphone du tuteur</span>
                            </label>
                            <input type="tel" name="tuteur_telephone" placeholder="06 12 34 56 78"
                              value="<?= isset($_POST['tuteur_telephone']) ? htmlspecialchars($_POST['tuteur_telephone']) : '' ?>"
                              class="input input-bordered w-full"/>
                            <?php if (isset($errors['tuteur_telephone'])): ?>
                              <p class="text-red-600 text-sm"><?= $errors['tuteur_telephone'] ?></p>
                            <?php endif; ?>
                          </div>
                        </div>

                        <!-- Adresse du tuteur -->
                        <div class="form-control">
                          <label class="label pl-0">
                            <span class="label-text font-semibold text-gray-700">Adresse du tuteur</span>
                          </label>
                          <input type="text" name="tuteur_adresse" placeholder="123 Rue de la République"
                            value="<?= isset($_POST['tuteur_adresse']) ? htmlspecialchars($_POST['tuteur_adresse']) : '' ?>"
                            class="input input-bordered w-full"/>
                          <?php if (isset($errors['tuteur_adresse'])): ?>
                            <p class="text-red-600 text-sm"><?= $errors['tuteur_adresse'] ?></p>
                          <?php endif; ?>
                        </div>
                      </div>

                      <!-- Actions -->
                      <div class="modal-action mt-8">
                        <button type="button" 
                                class="btn btn-ghost hover:bg-gray-100 px-6"
                                onclick="document.getElementById('my_modal_4').close()">Annuler</button>
                        <button type="submit" 
                                class="btn bg-red-600 hover:bg-red-700 px-6 text-white transition-transform hover:scale-105">
                          Enregistrer
                        </button>
                      </div>
                    </form>
                  </div>

                  <!-- Backdrop avec flou -->
                  <form method="dialog" class="modal-backdrop bg-black/30 backdrop-blur-sm">
                    <button>close</button>
                  </form>
                </dialog>
            </div>
       <?php if ($apprenant) : ?>

        <!-- Tableau -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full ">
                    <thead class="bg-red-800 text-white">
                        <tr>
                            <th class="px-4 py-4 text-left text-sm font-medium">Nom & Prénom</th>
                            <th class="px-4 py-4 text-left text-sm font-medium">Matricule</th>
                            <th class="px-4 py-4 text-left text-sm font-medium">Email</th>
                            <!-- <th class="px-4 py-4 text-left text-sm font-medium">Telephone</th> -->
                            <th class="px-4 py-4 text-left text-sm font-medium">Adresse</th>
                            <th class="px-4 py-4 text-left text-sm font-medium">Cohorte</th>
                            <th class="px-4 py-4 text-left text-sm font-medium">Statut</th>
                            <th class="px-4 py-4 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Exemple de ligne -->
                        <?php foreach ($apprenant as $a) : ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                               
                                <td class="px-4 py-4 ">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-md overflow-hidden">
                                            <?php afficherPhoto($a['photo'], $a['nom']); ?>

                                        </div>
                                        <span class="font-bold text-xs">
                                            <?= htmlspecialchars($a['prenom']) ?> <?= htmlspecialchars($a['nom']) ?>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-3 py-4 text-xs text-gray-600 font-medium whitespace-nowrap">
                                    <?= htmlspecialchars($a['matricule']) ?>
                                </td>
                                <td class="px-2 py-4 text-xs text-gray-600 font-medium"><?= htmlspecialchars($a['email']) ?></td>
                                <!-- <td class="px-2 py-4 text-xs text-gray-600 font-medium">
                                    <?= htmlspecialchars($a['telephone']) ?>
                                </td> -->
                                <td class="px-2 py-4 text-xs text-gray-600 font-medium whitespace-nowrap">
                                    <?= htmlspecialchars($a['adresse']) ?>
                                </td>
                                <td class="px-2 py-4 text-xs text-gray-600 font-medium whitespace-nowrap ">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs">
                                        <?= htmlspecialchars($a['nom_referentiel']) ?></span>
                                </td>
                                <td class="px-2 py-4 font-medium">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs">
                                        Actif
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-xs text-gray-600 font-medium">
                                    <a href="<?= WEBROOT?>?controller=apprenant&page=details"><i class="ri-more-2-fill"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t border-gray-200 px-4 py-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-600">Page 1 sur 10</span>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-gray-600 hover:bg-red-50 rounded-lg disabled:opacity-50" disabled>
                            Précédent
                        </button>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a 
                                href="?controller=apprenant&pagination=<?= $i ?>" 
                                class="px-3 py-2 border border-red-300 rounded-lg font-medium text-sm 
                                    <?= $i == $pagination 
                                        ? 'bg-red-600 text-white ring-2 ring-red-300 border-transparent' 
                                        : 'bg-white text-red-700 hover:bg-red-100 hover:text-red-800' ?>
                                    transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-300"
                            >
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                        <button class="px-3 py-1 text-gray-600 hover:bg-red-50 rounded-lg">
                            Suivant
                        </button>
                    </div>
                </div>
            </div>
        </div>
         <?php else: ?>
                <!-- État vide amélioré -->
                <div class="flex flex-col items-center justify-center w-full mt-12 gap-8">
                    <div class="relative w-64 h-64">
                        <img src="assets/images/9214833-removebg-preview.png" alt="Aucun étudiant" 
                            class="w-full h-full object-contain opacity-50">
                        <!-- <div class="absolute inset-0 bg-gradient-to-t from-red-100 to-transparent"></div> -->
                    </div>
                    <div class="text-center space-y-2">
                        <p class="text-xl font-semibold text-gray-500">Aucun apprenant trouvé</p>
                        <p class="text-sm text-gray-500 max-w-md">
                            Aucune résultat pour votre recherche. Vérifiez le libelle ou essayez un autre terme.
                        </p>
                    </div>
                </div>
            <?php endif; ?>
    </div>
