    <header class="fixed w-full top-0 bg-white/80 backdrop-blur-sm border-b border-gray-100 z-20">
            <div class="flex items-center justify-between px-80 py-4">
                <!-- Partie gauche -->
                <div class="flex items-center space-x-4">
                    <!-- Menu toggle pour mobile -->
                    <button class="p-2 hover:bg-gray-100 rounded-xl lg:hidden">
                        <heroicon-outline-bars-3 class="w-6 h-6 text-gray-600" />
                    </button>
        
                    
        
                    <!-- Séparateur -->
                    <div class="h-6 w-px bg-gray-200 hidden md:block"></div>
        
                    
                </div>
        
                <!-- Partie droite -->
                <div class="flex items-center space-x-4">
                    <!-- Recherche -->
                    <div class="relative hidden lg:block">
                        <input type="text" 
                               class="w-64 px-4 pl-10 py-2 bg-gray-50 rounded-xl border-0 focus:ring-2 focus:ring-red-500" 
                               placeholder="Rechercher...">
                        <heroicon-outline-magnifying-glass class="w-5 h-5 text-gray-400 absolute left-3 top-3" />
                    </div>
        
                    <!-- Actions rapides -->
                    <div class="flex items-center space-x-2">
                        <!-- Calendrier -->
                        <button class="p-2 hover:bg-gray-100 rounded-xl relative">
                            <i class="ri-calendar-line"></i>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">3</span>
                        </button>
        
                        <!-- Notifications -->
                        <button class="p-2 hover:bg-gray-100 rounded-xl relative">
                            <i class="ri-notification-snooze-line"></i>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-xs text-white rounded-full flex items-center justify-center">2</span>
                        </button>
        
                        <!-- Dark Mode -->
                        <button class="p-2 hover:bg-gray-100 rounded-xl">
                            <i class="ri-sun-line"></i>
                        </button>
        
                        <!-- Profil -->
                        <div class="relative group flex items-center space-x-2">
                            <div class="relative">
                                <img src="https://img.freepik.com/free-photo/confident-business-woman-portrait-smiling-face_53876-137693.jpg?uid=R128466424&ga=GA1.1.810359603.1727369869&semt=ais_hybrid&w=740" 
                                     class="w-10 h-10 rounded-xl object-cover border-2 border-red-100">
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </div>
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-medium">Fatima Niang</p>
                                <p class="text-xs text-gray-500">Responsable Pédagogique</p>
                            </div>
                            
                            <!-- Menu déroulant -->
                            <div class="absolute right-0 top-12 w-48 bg-white shadow-xl rounded-xl p-2 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300">
                                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-50 rounded-lg">
                                    <heroicon-outline-user class="w-5 h-5" />
                                    <span>Profil</span>
                                </a>
                                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:bg-gray-50 rounded-lg">
                                    <heroicon-outline-cog-6-tooth class="w-5 h-5" />
                                    <span>Paramètres</span>
                                </a>
                                <div class="border-t my-2"></div>
                                <a href="#" class="flex items-center space-x-2 px-3 py-2 text-red-500 hover:bg-red-50 rounded-lg">
                                    <heroicon-outline-arrow-left-on-rectangle class="w-5 h-5" />
                                    <span>Déconnexion</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Barre de recherche mobile -->
            <div class="lg:hidden px-6 pb-4">
                <div class="relative">
                    <input type="text" 
                           class="w-full px-4 pl-10 py-2 bg-gray-50 rounded-xl border-0 focus:ring-2 focus:ring-red-500" 
                           placeholder="Rechercher...">
                    <heroicon-outline-magnifying-glass class="w-5 h-5 text-gray-400 absolute left-3 top-3" />
                </div>
            </div>
        </header>
