<!-- En-tête et actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 ">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><span class="text-red-600"> Promotion</span></h1>
                    <p class="text-gray-500 mt-2">Gérer les promotions de l'école</p>
                </div>
                <div class="flex items-center gap-3 ">
                    <button class="flex items-center gap-2 px-4 py-2.5 bg-ecole-red text-white rounded-xl border border-red-500  hover:bg-red-700 transition-all">
                        <span class="text-red-600 hover:text-white"><i class="ri-add-line"></i> Ajouter promotion</span>
                    </button>
                    
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