<!-- En-tête et actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 ">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><span class="text-red-600"> Promotion</span></h1>
                    <p class="text-gray-500 mt-2">Gérer les promotions de l'école</p>
                </div>
                <div class="flex items-center gap-3 ">
                    <!-- You can open the modal using ID.showModal() method -->
                <button class="btn px-4  text-red-600 rounded-xl border border-red-500 hover:text-white  hover:bg-red-700 transition-all" onclick="my_modal_4.showModal()">Ajouter promotion</button>
                <dialog id="my_modal_4" class="modal <?= !empty($errors) ? 'modal-open' : '' ?>">
                  <div class="modal-box w-11/12 md:w-8/12 max-w-3xl p-8 rounded-xl shadow-xl">
                    <!-- En-tête avec icône -->
                    <div class="flex items-center mb-8">
                      <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                      </svg>
                      <h3 class="text-2xl font-bold text-red-600">Ajouter une nouvelle promotion</h3>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                      <!-- Nom de la promo -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <div class="form-control">
                        <label class="label pl-0">
                          <span classlabel-text font-semibold text-gray-700">Nom de la promotion</span>
                        </label>
                        <input type="text" placeholder="Ex: Promotion 2024 - Dev Web" name="nom"
                                value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : (isset($promo['nom']) ? htmlspecialchars($promo['nom']) : '') ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                />
                          <?php if (isset($errors['nom'])): ?>
                              <p class="text-red-600 text-sm"> <?= $errors['nom'] ?> </p>
                        <?php endif; ?>
                      </div>
                      <div class="form-control">
                        <label class="label pl-0">
                          <span classlabel-text font-semibold text-gray-700">Nombre d'apprenants</span>
                        </label>
                        <input type="text" placeholder="Ex: 3O" name="nb_apprenants"
                                value="<?= isset($_POST['nb_apprenants']) ? htmlspecialchars($_POST['nb_apprenants']) : (isset($promo['nb_apprenants']) ? htmlspecialchars($promo['nb_apprenants']) : '') ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                />
                          <?php if (isset($errors['nb_apprenants'])): ?>
                              <p class="text-red-600 text-sm"> <?= $errors['nb_apprenants'] ?> </p>
                        <?php endif; ?>
                      </div>
                      </div>
                      
                      <!-- Dates -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                          <label class="label pl-0">
                            <span class="label-text font-semibold text-gray-700">Date de début</span>
                          </label>
                          <div class="relative">
                            <input type="date" name="date_debut"
                                  class="input input-bordered w-full calendar-icon pr-10"
                                    value="<?= isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : (isset($promo['date_debut']) ? htmlspecialchars($promo['date_debut']) : '') ?>"
                                    />
                            <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                          </div>
                          <?php if (isset($errors['date_debut'])): ?>
                                            <p class="text-red-600 text-sm"> <?= $errors['date_debut'] ?> </p>
                        <?php endif; ?>
                        </div>

                        <div class="form-control">
                          <label class="label pl-0">
                            <span class="label-text font-semibold text-gray-700">Date de fin</span>
                          </label>
                          <div class="relative">
                            <input type="date" name="date_fin"
                                  class="input input-bordered w-full calendar-icon pr-10"
                                    value="<?= isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : (isset($promo['date_fin']) ? htmlspecialchars($promo['date_fin']) : '') ?>"
                                    />
                            <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                          </div>
                          <?php if (isset($errors['date_fin'])): ?>
                                            <p class="text-red-600 text-sm"> <?= $errors['date_fin'] ?> </p>
                        <?php endif; ?>
                        </div>
                        
                      </div>
                      
                      <!-- Photo de la promo -->
                      <div class="form-control">
                        <label class="label pl-0">
                          <span class="label-text font-semibold text-gray-700">Photo de la promotion</span>
                        </label>
                        <div class="flex items-center justify-center w-full">
                          <label class="flex flex-col w-full border-2 border-dashed hover:border-red-200 transition-colors rounded-lg p-8 text-center cursor-pointer">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">Glissez-déposez ou cliquez pour uploader</span>
                            <input type="file" class="hidden" name="cover_photo" accept="image/*"
                                  value="<?= isset($_POST['cover_photo']) ? htmlspecialchars($_POST['cover_photo']) : (isset($promo['cover_photo']) ? htmlspecialchars($promo['cover_photo']) : '') ?>"

                            />
                            <span class="text-sm text-gray-500 mt-2">JPG, PNG ou GIF (max 2MB)</span>
                          </label>
                        </div>
                        <?php if (isset($errors['cover_photo'])): ?>
                              <p class="text-red-600 text-sm"> <?= $errors['cover_photo'] ?> </p>
                        <?php endif; ?>
                      </div>
                      
                      <!-- Référentiels -->
                      <div class="form-control">
                        <label class="label pl-0">
                          <span class="label-text font-semibold text-gray-700">Référentiels associés</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                          <?php foreach ($referentiels as $ref): ?>
                            <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-red-50 transition-colors cursor-pointer">
                            <input type="checkbox" name="referentiels[]" value="<?= htmlspecialchars($ref['id']) ?>"
                                <?= (in_array($ref['id'], $old['referentiels'] ?? [])) ? 'checked' : '' ?> />
                              <span class="text-gray-700"><?= htmlspecialchars($ref['libelle']) ?></span>
                            </label>
                          <?php endforeach; ?>
                        </div>
                        <?php if (isset($errors['referentiels'])): ?>
                                            <p class="text-red-600 text-sm"> <?= $errors['referentiels'] ?> </p>
                        <?php endif; ?>
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
            </div>
        
           <!-- Statistique -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Carte Apprenant -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-400 text-white p-6 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="mb-3">
                    <i class="fas fa-users text-3xl opacity-80"></i>
                </div>
                <p class="text-2xl font-bold mb-2">0</p>
                <p class="text-sm font-medium opacity-90 tracking-wide">Apprenants</p>
                </div>
            
                <!-- Carte Référentiel -->
                <div class="bg-gradient-to-br from-green-600 to-green-400 text-white p-6 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="mb-3">
                    <i class="fas fa-book-open text-3xl opacity-80"></i>
                </div>
                <p class="text-2xl font-bold mb-2">6</p>
                <p class="text-sm font-medium opacity-90 tracking-wide">Référentiels</p>
                </div>
            
                <!-- Carte Promotion active -->
                <div class="bg-gradient-to-br from-orange-600 to-orange-400 text-white p-6 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="mb-3">
                    <i class="fas fa-star text-3xl opacity-80"></i>
                </div>
                <p class="text-2xl font-bold mb-2">1</p>
                <p class="text-sm font-medium opacity-90 tracking-wide">Promotion active</p>
                </div>
            
                <!-- Carte Total promotion -->
                <div class="bg-gradient-to-br from-purple-600 to-purple-400 text-white p-6 rounded-xl text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="mb-3">
                    <i class="fas fa-layer-group text-3xl opacity-80"></i>
                </div>
                <p class="text-2xl font-bold mb-2">4</p>
                <p class="text-sm font-medium opacity-90 tracking-wide">Total promotions</p>
                </div>
            </div>