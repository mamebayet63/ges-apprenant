
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
 <section class="container mx-auto">
       
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-red-600  text-center animate-fade-in-down">
                        Nos Référentiels
                        <div class="w-16 h-1 bg-red-300 mx-auto mt-2     rounded-full"></div>
                    </h1>
                </div>
                <div class="flex items-center gap-3 ">
                    <!-- You can open the modal using ID.showModal() method -->
                <button class="btn px-4  text-red-600 rounded-xl border border-red-500 hover:text-white  hover:bg-red-700 transition-all" onclick="my_modal_4.showModal()">Ajouter referentiel</button>
                <dialog id="my_modal_4" class="modal <?= !empty($errors) ? 'modal-open' : '' ?>">
                  <div class="modal-box w-11/12 md:w-8/12 max-w-3xl p-8 rounded-xl shadow-xl">
                    <!-- En-tête avec icône -->
                    <div class="flex items-center mb-8">
                      <svg class="w-8 h-8 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                      </svg>
                      <h3 class="text-2xl font-bold text-red-600">Ajouter un nouveau referentiel</h3>
                    </div>

                    <form method="POST" enctype="multipart/form-data" class="space-y-6">
                      <!-- Nom de la promo -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <div class="form-control">
                        <label class="label pl-0">
                          <span classlabel-text font-semibold text-gray-700">Libelle du referentiel</span>
                        </label>
                        <input type="text" placeholder="Ex: Promotion 2024 - Dev Web" name="libelle"
                                value="<?= isset($_POST['libelle']) ? htmlspecialchars($_POST['libelle']) : (isset($promo['libelle']) ? htmlspecialchars($promo['libelle']) : '') ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                />
                          <?php if (isset($errors['libelle'])): ?>
                              <p class="text-red-600 text-sm"> <?= $errors['libelle'] ?> </p>
                        <?php endif; ?>
                      </div>
                      <div class="form-control">
                        <label class="label pl-0">
                          <span classlabel-text font-semibold text-gray-700">Capacité</span>
                        </label>
                        <input type="text" placeholder="Ex: 3O" name="capacite"
                                value="<?= isset($_POST['capacite']) ? htmlspecialchars($_POST['capacite']) : (isset($promo['capacite']) ? htmlspecialchars($promo['capacite']) : '') ?>"
                              class="input input-bordered w-full focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                                />
                          <?php if (isset($errors['capacite'])): ?>
                              <p class="text-red-600 text-sm"> <?= $errors['capacite'] ?> </p>
                        <?php endif; ?>
                      </div>
                      </div>
                      
                   
                      
                      <!-- Photo de la promo -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-control">
                            <label class="label pl-0">
                            <span class="label-text font-semibold text-gray-700">Photo du referentiel</span>
                            </label>
                            <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col w-full border-2 border-dashed hover:border-red-200 transition-colors rounded-lg p-8 text-center cursor-pointer">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-600">Glissez-déposez ou cliquez pour uploader</span>
                                <input type="file" class="hidden" name="photo" accept="image/*"
                                    value="<?= isset($_POST['photo']) ? htmlspecialchars($_POST['photo']) : (isset($promo['photo']) ? htmlspecialchars($promo['photo']) : '') ?>"

                                />
                                <span class="text-sm text-gray-500 mt-2">JPG, PNG ou GIF (max 2MB)</span>
                            </label>
                            </div>
                            <?php if (isset($errors['photo'])): ?>
                                <p class="text-red-600 text-sm"> <?= $errors['photo'] ?> </p>
                            <?php endif; ?>
                        </div> 
                        <div class="form-control">
                            <label class="label pl-0">
                                <span class="label-text font-semibold text-gray-700">Description</span>
                            </label>
                            <textarea 
                                name="description"
                                placeholder="Ajoutez une description détaillée..."
                                class="textarea   mt-4 textarea-bordered w-full min-h-[120px] focus:ring-2 focus:ring-red-500 focus:border-red-500"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : (isset($promo['description']) ? htmlspecialchars($promo['description']) : '') ?></textarea>
                            
                            <?php if (isset($errors['description'])): ?>
                                <p class="text-red-600 text-sm"><?= $errors['description'] ?></p>
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
        </div>
        <?php if ($referentiel) : ?>
            <div class=" gap-6 bg-white/80 backdrop-blur-sm border-b border-gray-100 rounded-xl p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                        <!-- Search Bar -->
                        <div class="relative w-full sm:max-w-md">
                        <input 
                            type="text" 
                            placeholder="Rechercher..." 
                            class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition-all duration-200 placeholder-gray-400"
                        >
                        <i class="ri-search-2-line absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    
                      
                    </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 bg-white">
                    <?php foreach ($referentiel as $r) : ?>
                        <!-- Carte 1 -->
                        <div class="group bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                            <div class="h-32 overflow-hidden rounded-t-2xl relative">
                                <?php if (!empty($r['photo'])): 

                                        // Si c'est une ressource (stream), on lit son contenu en chaîne
                                        if (is_resource($r['photo'])) {
                                            $data = stream_get_contents($r['photo']);
                                        } else {
                                            $data = $r['photo'];
                                        }
                                        // dd($data);

                                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                        $type = finfo_buffer($finfo, $data);
                                        finfo_close($finfo);
                                    ?>
                                          <img src="data:<?= $type ?>;base64,<?= base64_encode($data) ?>" 
                                              alt="<?= htmlspecialchars($r['libelle']) ?>" 
                                              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                      <?php else: ?>
                                          <div class="w-full h-full bg-gradient-to-br from-red-50 to-red-100 flex items-center justify-center">
                                              <i class="ri-links-line text-3xl text-red-200"></i>
                                          </div>
                                      <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-red-600/20 to-transparent"></div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-baseline justify-between mb-3">
                                    <h3 class="text-sm font-bold text-red-700"><?= htmlspecialchars($r['libelle']) ?></h3>
                                    <span class="bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Nouveau</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm leading-relaxed text-xs font-medium">
                                    <?= htmlspecialchars($r['description']) ?>
                                </p>
                                <div class="flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 2c2.9 0 5.44 1.56 6.84 3.88-.43.07-.88.12-1.34.12-2.9 0-5.44-1.56-6.84-3.88.43-.07.88-.12 1.34-.12zM8.08 5.03C7.45 6.92 6.13 8.5 4.42 9.47 5.05 7.58 6.37 6 8.08 5.03zM12 20c-4.41 0-8-3.59-8-8 0-.05.01-.1.01-.15 2.75-.98 4.71-3.06 5.68-5.66 1.23 2.08 3.51 3.44 6.31 3.44 3.8 0 6.89-3.14 6.89-7h.01c.04 1.1.07 2.18.07 3.25 0 4.41-3.59 8-8 8z"/>
                                    </svg>
                                    <span class="text-xs font-medium">Capacité : <?= htmlspecialchars($r['capacite']) ?> personnes</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="flex justify-end">
                    <nav class="pagination mt-4 flex gap-x-2">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a 
                                href="?controller=referentiel&page=referentiel&pagination=<?= $i ?>" 
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
            </div>

        <?php endif; ?>
    </section>
