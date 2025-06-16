
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e53e3e',
                        primaryLight: '#fef2f2',
                        primaryDark: '#b91c1c',
                        secondary: '#4a5568'
                    },
                    boxShadow: {
                        'card': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 5px 10px -5px rgba(0, 0, 0, 0.02)',
                        'hover': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fafafa 0%, #f5f5f7 100%);
            min-height: 100vh;
        }
        
        .card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 5px 10px -5px rgba(0, 0, 0, 0.02);
        }
        
        .card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        #tab1:checked ~ .tab-content#content1,
        #tab2:checked ~ .tab-content#content2 {
            display: block;
        }
        
        .tab-label {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .tab-label::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: #e53e3e;
            transition: width 0.3s ease;
        }
        
        #tab1:checked ~ .tab-label[for="tab1"]::after,
        #tab2:checked ~ .tab-label[for="tab2"]::after {
            width: 100%;
        }
        
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 0.6s ease;
        }
        
        .module-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .module-card:hover {
            transform: translateX(5px);
            border-left-color: #e53e3e;
        }
        
        .presence-badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }
        
        .absence-row {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        
        .absence-row:hover {
            background-color: #fef2f2;
            border-left-color: #e53e3e;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Nouveaux styles pour la grille de modules */
        .modules-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        
        @media (max-width: 1024px) {
            .modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            .modules-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 ">
         
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 ">
            <!-- Colonne de gauche - Profil réduit avec statistiques en haut -->
            <div class="lg:col-span-1 space-y-8">
                 <!-- Carte de profil réduite -->
                <div class="card">
                    <div class="bg-gradient-to-r from-primary to-primaryDark p-4">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-full bg-white border-4 border-white flex items-center justify-center mb-3">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-20 h-20 flex items-center justify-center">
                                    <i class="fas fa-user-graduate text-3xl text-primary"></i>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold text-white">Marie Dubois</h2>
                            <p class="text-primaryLight mb-1 text-sm">Promotion 2024</p>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="text-gray-500 text-sm">Matricule</p>
                                <p class="font-medium text-sm">ES2024-125</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Filière</p>
                                <p class="font-medium text-sm">Développement Web</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-500 text-sm">Email</p>
                                <p class="font-medium text-sm">marie.dubois@ecole.fr</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Téléphone</p>
                                <p class="font-medium text-sm">+33 6 12 34 56 78</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Niveau</p>
                                <p class="font-medium text-sm">BAC+3</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2 mt-4">
                            <button class="flex-1 bg-primary text-white py-2 rounded-lg hover:bg-primaryDark transition flex items-center justify-center text-sm">
                                <i class="fas fa-envelope mr-1"></i> Contacter
                            </button>
                            <button class="flex-1 bg-white border border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition flex items-center justify-center text-sm">
                                <i class="fas fa-edit mr-1"></i> Modifier
                            </button>
                        </div>
                    </div>
                </div>
              
                
               
            </div>
            
            <!-- Colonne de droite - Contenu principal élargi -->
            <div class="lg:col-span-3 space-y-8">
                 <!-- Section Absences -->
                <div class="card">
                    <div class="border-b border-gray-100 flex">
                        <input type="radio" id="tab1" name="tabs" class="hidden" checked>
                        <input type="radio" id="tab2" name="tabs" class="hidden">
                        
                        <label for="tab1" class="tab-label py-4 px-6 text-center cursor-pointer font-medium text-gray-800 w-1/2">
                            <i class="fas fa-history mr-2"></i> Historique des absences
                        </label>
                        
                        <label for="tab2" class="tab-label py-4 px-6 text-center cursor-pointer font-medium text-gray-800 w-1/2">
                            <i class="fas fa-calendar-alt mr-2"></i> Calendrier des présences
                        </label>
                    </div>
                    
                    <!-- Contenu des onglets -->
                    <div class="tab-content p-6" id="content1">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Date</th>
                                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Module</th>
                                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Type</th>
                                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Justification</th>
                                        <th class="py-3 px-4 text-left text-gray-500 font-medium">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="absence-row">
                                        <td class="py-3 px-4 font-medium">12/10/2023</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium">Algorithmique</div>
                                            <div class="text-sm text-gray-500">08:00 - 10:00</div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Absence</span>
                                        </td>
                                        <td class="py-3 px-4">Maladie (certificat médical)</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Validée</span>
                                        </td>
                                    </tr>
                                    <tr class="absence-row">
                                        <td class="py-3 px-4 font-medium">05/10/2023</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium">Base de données</div>
                                            <div class="text-sm text-gray-500">10:15 - 12:15</div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Retard</span>
                                        </td>
                                        <td class="py-3 px-4">Problème de transport</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">En attente</span>
                                        </td>
                                    </tr>
                                    <tr class="absence-row">
                                        <td class="py-3 px-4 font-medium">28/09/2023</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium">Framework JS</div>
                                            <div class="text-sm text-gray-500">13:30 - 15:30</div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Absence</span>
                                        </td>
                                        <td class="py-3 px-4">Rendez-vous médical</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Validée</span>
                                        </td>
                                    </tr>
                                    <tr class="absence-row">
                                        <td class="py-3 px-4 font-medium">20/09/2023</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium">Gestion de projet</div>
                                            <div class="text-sm text-gray-500">15:45 - 17:45</div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Retard</span>
                                        </td>
                                        <td class="py-3 px-4">-</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Non justifié</span>
                                        </td>
                                    </tr>
                                    <tr class="absence-row">
                                        <td class="py-3 px-4 font-medium">15/09/2023</td>
                                        <td class="py-3 px-4">
                                            <div class="font-medium">Développement Mobile</div>
                                            <div class="text-sm text-gray-500">10:15 - 12:15</div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Absence</span>
                                        </td>
                                        <td class="py-3 px-4">Problème familial</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Validée</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-6 flex justify-between items-center">
                            <p class="text-gray-500">5 absences / retards enregistrés</p>
                            <button class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition flex items-center">
                                <i class="fas fa-plus mr-2"></i> Ajouter une absence
                            </button>
                        </div>
                    </div>
                    
                    <div class="tab-content p-6" id="content2">
                        <div class="flex justify-center items-center h-64">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-primaryLight rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-calendar text-xl text-primary"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-800 mb-2">Calendrier des présences</h4>
                                <p class="text-gray-500 max-w-md mx-auto">Visualisez les présences et absences sur un calendrier mensuel. Cette fonctionnalité sera bientôt disponible.</p>
                                <button class="mt-4 bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                                    Activer les notifications
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section Modules avec disposition en grille 3x -->
                <div class="card">
                    <div class="p-6 modules-grid  space-x-4">
                       <!-- Module 1 - Design amélioré -->
                                    <div class="module-card p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                        <div class="flex flex-col h-full">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                                                    <i class="fas fa-code text-lg text-red-500"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-bold text-gray-800 text-sm truncate">Développement Frontend</h4>
                                                    <span class="presence-badge bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1 inline-block">
                                                        3 jrs
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <p class="text-gray-600 text-xs mb-4 flex-1">HTML, CSS, JavaScript et frameworks modernes</p>
                                            
                                            <div class="mt-auto space-y-3 pt-2 border-t border-gray-100">
                                                <!-- Nouveau : Date et Heure -->
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <i class="far fa-calendar text-xs w-4"></i>
                                                    <span class="text-xs font-medium"><i class="ri-calendar-event-line"></i> 12 Juin 2024</span>
                                                    <span class="text-xs font-medium"><i class="ri-time-line"></i> 14:30</span>
                                                </div>
                                                
                                                <!-- Nouveau : Jours restants -->
                                                <div class="flex items-center gap-2">
                                                    <i class="far fa-clock text-xs w-4 text-amber-500"></i>
                                                    <span class="text-xs font-medium">
                                                        <span class="text-amber-600"></span>
                                                    </span>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                        
                      
                    </div>
                </div>
                
               
            </div>
        </div>
    </div>
</body>
</html>