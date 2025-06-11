<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Apprenant | École Digitale</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F3F4F6;
        }
        .profile-header {
            background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        }
        .progress-bar {
            height: 8px;
            border-radius: 4px;
        }
        .skill-badge {
            transition: all 0.3s ease;
        }
        .skill-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .tab-button {
            transition: all 0.3s ease;
        }
        .tab-button.active {
            background-color: #ffffff;
            color: #4F46E5;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .attendance-marker {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        .attendance-present {
            background-color: #10B981;
        }
        .attendance-absent {
            background-color: #EF4444;
        }
        .attendance-late {
            background-color: #F59E0B;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="profile-header text-white py-6 px-4 md:px-8">
            <div class="container mx-auto flex flex-col md:flex-row items-center">
                <div class="flex items-center mb-6 md:mb-0">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" 
                             alt="Photo de profil" 
                             class="w-24 h-24 rounded-full border-4 border-white border-opacity-30 object-cover">
                        <span class="absolute bottom-2 right-2 bg-green-500 border-2 border-white rounded-full w-5 h-5"></span>
                    </div>
                    <div class="ml-6">
                        <h1 class="text-2xl md:text-3xl font-bold">Alexandre Dubois</h1>
                        <p class="text-indigo-100 mt-1">Développeur Full Stack</p>
                        <div class="flex mt-2">
                            <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm mr-2">Promo 2024</span>
                            <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">Niveau Avancé</span>
                        </div>
                    </div>
                </div>
                
                <div class="md:ml-auto flex space-x-4">
                    <button class="bg-white text-primary px-5 py-2 rounded-lg font-medium hover:bg-opacity-90 transition">
                        <i class="fas fa-envelope mr-2"></i> Contacter
                    </button>
                    <button class="bg-primary bg-opacity-20 text-white px-5 py-2 rounded-lg font-medium hover:bg-opacity-30 transition">
                        <i class="fas fa-edit mr-2"></i> Éditer
                    </button>
                </div>
            </div>
            
            <!-- Barre de navigation Cours/Absences -->
            <div class="container mx-auto mt-6">
                <div class="bg-white bg-opacity-20 rounded-lg p-1 flex">
                    <button id="tab-profile" class="tab-button active w-1/3 py-3 rounded-lg text-center font-medium">
                        <i class="fas fa-user mr-2"></i> Profil
                    </button>
                    <button id="tab-courses" class="tab-button w-1/3 py-3 rounded-lg text-center font-medium">
                        <i class="fas fa-book mr-2"></i> Cours
                    </button>
                    <button id="tab-attendance" class="tab-button w-1/3 py-3 rounded-lg text-center font-medium">
                        <i class="fas fa-calendar-check mr-2"></i> Absences
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <!-- Contenu du Profil -->
            <div id="profile-content" class="tab-content active">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Colonne de gauche -->
                    <div class="lg:col-span-2">
                        <!-- À propos -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-user-graduate mr-3 text-primary"></i>
                                À propos
                            </h2>
                            <p class="text-gray-600 mb-6">
                                Passionné par le développement web et les nouvelles technologies, je suis actuellement en formation de développeur full stack. 
                                Je recherche une alternance pour mettre en pratique mes compétences et contribuer à des projets innovants.
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <div class="bg-gray-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-envelope text-primary text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Email</p>
                                        <p class="font-medium">alexandre.dubois@example.com</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-gray-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-phone text-primary text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Téléphone</p>
                                        <p class="font-medium">+33 6 12 34 56 78</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-gray-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-map-marker-alt text-primary text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Localisation</p>
                                        <p class="font-medium">Paris, France</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-gray-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-calendar-alt text-primary text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 text-sm">Date d'inscription</p>
                                        <p class="font-medium">15 Septembre 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Compétences -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-bold text-dark flex items-center">
                                    <i class="fas fa-code mr-3 text-primary"></i>
                                    Compétences techniques
                                </h2>
                                <span class="bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-full text-sm">
                                    12 compétences
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium">HTML/CSS</span>
                                        <span class="text-primary font-bold">90%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 90%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium">JavaScript</span>
                                        <span class="text-primary font-bold">85%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium">React.js</span>
                                        <span class="text-primary font-bold">80%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium">Node.js</span>
                                        <span class="text-primary font-bold">75%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <h3 class="font-medium text-gray-700 mb-3">Autres compétences</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="skill-badge bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Tailwind CSS</span>
                                    <span class="skill-badge bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">MongoDB</span>
                                    <span class="skill-badge bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Express.js</span>
                                    <span class="skill-badge bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm">TypeScript</span>
                                    <span class="skill-badge bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">Git</span>
                                    <span class="skill-badge bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">API REST</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Projets récents -->
                        <div class="card bg-white rounded-xl p-6">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-project-diagram mr-3 text-primary"></i>
                                Projets récents
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold text-lg">Application E-commerce</h3>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Terminé</span>
                                    </div>
                                    <p class="text-gray-600 my-2">Plateforme e-commerce complète avec React, Node.js et Stripe pour les paiements.</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">React</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">Node.js</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">MongoDB</span>
                                        </div>
                                        <a href="#" class="text-primary hover:underline flex items-center">
                                            Voir le projet <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold text-lg">Réseau Social</h3>
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">En cours</span>
                                    </div>
                                    <p class="text-gray-600 my-2">Réseau social éducatif avec système de messagerie en temps réel.</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">Vue.js</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">Firebase</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">WebSockets</span>
                                        </div>
                                        <a href="#" class="text-primary hover:underline flex items-center">
                                            Voir le projet <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-primary transition">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold text-lg">Gestionnaire de tâches</h3>
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Terminé</span>
                                    </div>
                                    <p class="text-gray-600 my-2">Application de gestion de tâches avec calendrier et rappels.</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">JavaScript</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">LocalStorage</span>
                                            <span class="bg-gray-100 px-2 py-1 rounded text-sm">CSS Grid</span>
                                        </div>
                                        <a href="#" class="text-primary hover:underline flex items-center">
                                            Voir le projet <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Colonne de droite -->
                    <div>
                        <!-- Progression académique -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                                <i class="fas fa-chart-line mr-3 text-primary"></i>
                                Progression académique
                            </h2>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium">Modules complétés</span>
                                        <span class="font-bold text-primary">24/30</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-primary h-3 rounded-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium">Projets validés</span>
                                        <span class="font-bold text-primary">8/10</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-primary h-3 rounded-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium">Taux de réussite</span>
                                        <span class="font-bold text-primary">92%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" style="width: 92%"></div>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-gray-600">Prochain examen</p>
                                            <p class="font-bold">Architecture des applications</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-600">15 Juin 2023</p>
                                            <p class="text-sm text-red-500 font-medium">10 jours restants</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Certifications -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-award mr-3 text-primary"></i>
                                Certifications
                            </h2>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-medal text-indigo-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">Développeur Front-End</h3>
                                        <p class="text-gray-600 text-sm">Certification Google • Octobre 2023</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-medal text-green-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">JavaScript Avancé</h3>
                                        <p class="text-gray-600 text-sm">Certification MDN • Août 2023</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-amber-100 p-3 rounded-lg mr-4">
                                        <i class="fas fa-medal text-amber-600 text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold">Responsive Web Design</h3>
                                        <p class="text-gray-600 text-sm">FreeCodeCamp • Juin 2023</p>
                                    </div>
                                </div>
                            </div>
                            
                            <button class="mt-4 w-full py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium text-gray-700 transition">
                                Voir toutes les certifications
                            </button>
                        </div>
                        
                        <!-- Statistiques -->
                        <div class="card bg-white rounded-xl p-6">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-chart-pie mr-3 text-primary"></i>
                                Statistiques
                            </h2>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-indigo-50 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-primary">142</div>
                                    <div class="text-gray-600 text-sm mt-1">Heures de code</div>
                                </div>
                                
                                <div class="bg-green-50 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-green-600">48</div>
                                    <div class="text-gray-600 text-sm mt-1">Projets réalisés</div>
                                </div>
                                
                                <div class="bg-purple-50 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-purple-600">96%</div>
                                    <div class="text-gray-600 text-sm mt-1">Taux présence</div>
                                </div>
                                
                                <div class="bg-amber-50 rounded-lg p-4 text-center">
                                    <div class="text-3xl font-bold text-amber-600">4.8</div>
                                    <div class="text-gray-600 text-sm mt-1">Note moyenne</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenu des Cours -->
            <div id="courses-content" class="tab-content">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                                <i class="fas fa-book-open mr-3 text-primary"></i>
                                Mes Cours
                            </h2>
                            
                            <div class="space-y-4">
                                <!-- Cours 1 -->
                                <div class="border border-gray-200 rounded-xl p-5 hover:border-primary transition">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                                        <div>
                                            <h3 class="font-bold text-lg text-gray-800">Développement Front-End Avancé</h3>
                                            <p class="text-gray-600">Formateur: Sophie Martin</p>
                                        </div>
                                        <div class="mt-2 md:mt-0">
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">En cours</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-gray-500 mr-2"></i>
                                            <span>Lundi & Mercredi | 14h-17h</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-gray-500 mr-2"></i>
                                            <span>Salle B203</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-600">Progression</span>
                                            <span class="font-bold text-primary">65%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-primary h-2.5 rounded-full" style="width: 65%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <p class="text-gray-600">Prochain cours:</p>
                                            <p class="font-medium">Demain | React Hooks Avancés</p>
                                        </div>
                                        <button class="text-primary hover:underline flex items-center">
                                            Détails <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Cours 2 -->
                                <div class="border border-gray-200 rounded-xl p-5 hover:border-primary transition">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                                        <div>
                                            <h3 class="font-bold text-lg text-gray-800">Back-End avec Node.js</h3>
                                            <p class="text-gray-600">Formateur: Thomas Dubois</p>
                                        </div>
                                        <div class="mt-2 md:mt-0">
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Terminé</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-gray-500 mr-2"></i>
                                            <span>Mardi & Jeudi | 9h-12h</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-gray-500 mr-2"></i>
                                            <span>Salle A107</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-600">Progression</span>
                                            <span class="font-bold text-primary">100%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <p class="text-gray-600">Note finale:</p>
                                            <p class="font-medium">17/20</p>
                                        </div>
                                        <button class="text-primary hover:underline flex items-center">
                                            Détails <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Cours 3 -->
                                <div class="border border-gray-200 rounded-xl p-5 hover:border-primary transition">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                                        <div>
                                            <h3 class="font-bold text-lg text-gray-800">Base de Données NoSQL</h3>
                                            <p class="text-gray-600">Formatrice: Émilie Bernard</p>
                                        </div>
                                        <div class="mt-2 md:mt-0">
                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">À venir</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day text-gray-500 mr-2"></i>
                                            <span>Vendredi | 10h-13h</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-gray-500 mr-2"></i>
                                            <span>Salle C305</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-gray-600">Démarrage dans</span>
                                            <span class="font-bold text-primary">12 jours</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-gray-300 h-2.5 rounded-full" style="width: 0%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex justify-between">
                                        <div>
                                            <p class="text-gray-600">Prérequis:</p>
                                            <p class="font-medium">JavaScript, Concepts DB</p>
                                        </div>
                                        <button class="text-primary hover:underline flex items-center">
                                            Préparation <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <!-- Calendrier des Cours -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-primary"></i>
                                Calendrier des Cours
                            </h2>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="font-bold">Juillet 2023</h3>
                                    <div class="flex space-x-2">
                                        <button class="p-2 rounded-full hover:bg-gray-200">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="p-2 rounded-full hover:bg-gray-200">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-7 gap-1 mb-2">
                                    <div class="text-center text-gray-500 text-sm">Lun</div>
                                    <div class="text-center text-gray-500 text-sm">Mar</div>
                                    <div class="text-center text-gray-500 text-sm">Mer</div>
                                    <div class="text-center text-gray-500 text-sm">Jeu</div>
                                    <div class="text-center text-gray-500 text-sm">Ven</div>
                                    <div class="text-center text-gray-500 text-sm">Sam</div>
                                    <div class="text-center text-gray-500 text-sm">Dim</div>
                                </div>
                                
                                <div class="grid grid-cols-7 gap-1">
                                    <!-- Semaine 1 -->
                                    <div class="text-center p-2 text-gray-400">26</div>
                                    <div class="text-center p-2 text-gray-400">27</div>
                                    <div class="text-center p-2 text-gray-400">28</div>
                                    <div class="text-center p-2 text-gray-400">29</div>
                                    <div class="text-center p-2 text-gray-400">30</div>
                                    <div class="text-center p-2">1</div>
                                    <div class="text-center p-2">2</div>
                                    
                                    <!-- Semaine 2 -->
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>3</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">4</div>
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>5</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">6</div>
                                    <div class="text-center p-2">7</div>
                                    <div class="text-center p-2">8</div>
                                    <div class="text-center p-2">9</div>
                                    
                                    <!-- Semaine 3 -->
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>10</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">11</div>
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>12</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">13</div>
                                    <div class="text-center p-2">14</div>
                                    <div class="text-center p-2">15</div>
                                    <div class="text-center p-2">16</div>
                                    
                                    <!-- Semaine 4 -->
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>17</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">18</div>
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>19</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">20</div>
                                    <div class="text-center p-2">21</div>
                                    <div class="text-center p-2">22</div>
                                    <div class="text-center p-2">23</div>
                                    
                                    <!-- Semaine 5 -->
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>24</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">25</div>
                                    <div class="text-center p-2 bg-blue-50 rounded-lg border border-blue-100">
                                        <div>26</div>
                                        <div class="text-xs mt-1 text-blue-600">Cours Front-End</div>
                                    </div>
                                    <div class="text-center p-2">27</div>
                                    <div class="text-center p-2">28</div>
                                    <div class="text-center p-2">29</div>
                                    <div class="text-center p-2">30</div>
                                    
                                    <!-- Semaine 6 -->
                                    <div class="text-center p-2">31</div>
                                    <div class="text-center p-2 text-gray-400">1</div>
                                    <div class="text-center p-2 text-gray-400">2</div>
                                    <div class="text-center p-2 text-gray-400">3</div>
                                    <div class="text-center p-2 text-gray-400">4</div>
                                    <div class="text-center p-2 text-gray-400">5</div>
                                    <div class="text-center p-2 text-gray-400">6</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ressources -->
                        <div class="card bg-white rounded-xl p-6">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-folder-open mr-3 text-primary"></i>
                                Ressources de cours
                            </h2>
                            
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-file-pdf text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">Guide React Avancé</h3>
                                            <p class="text-gray-600 text-sm">PDF • 2.4 MB</p>
                                        </div>
                                    </div>
                                    <button class="text-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-green-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-file-code text-green-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">Exercices JavaScript</h3>
                                            <p class="text-gray-600 text-sm">ZIP • 5.7 MB</p>
                                        </div>
                                    </div>
                                    <button class="text-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-video text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">Vidéo: Hooks React</h3>
                                            <p class="text-gray-600 text-sm">MP4 • 45 min</p>
                                        </div>
                                    </div>
                                    <button class="text-primary">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="bg-amber-100 p-3 rounded-lg mr-4">
                                            <i class="fas fa-link text-amber-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium">Liens utiles API</h3>
                                            <p class="text-gray-600 text-sm">Page Web</p>
                                        </div>
                                    </div>
                                    <button class="text-primary">
                                        <i class="fas fa-external-link-alt"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button class="mt-4 w-full py-3 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium text-gray-700 transition">
                                Voir toutes les ressources
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenu des Absences -->
            <div id="attendance-content" class="tab-content">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                                <i class="fas fa-user-clock mr-3 text-primary"></i>
                                Historique des Absences
                            </h2>
                            
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Date</th>
                                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Cours</th>
                                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Statut</th>
                                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Justification</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">15 Juin 2023</td>
                                            <td class="py-3 px-4">Développement Front-End</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-absent attendance-marker"></span>
                                                Absent
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-red-500">Non justifié</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">10 Juin 2023</td>
                                            <td class="py-3 px-4">Back-End Node.js</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-present attendance-marker"></span>
                                                Présent
                                            </td>
                                            <td class="py-3 px-4">-</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">5 Juin 2023</td>
                                            <td class="py-3 px-4">Base de Données</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-late attendance-marker"></span>
                                                Retard (25 min)
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-blue-500">Problème transport</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">1 Juin 2023</td>
                                            <td class="py-3 px-4">Développement Front-End</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-absent attendance-marker"></span>
                                                Absent
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-green-500">Justifié (maladie)</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">28 Mai 2023</td>
                                            <td class="py-3 px-4">Back-End Node.js</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-present attendance-marker"></span>
                                                Présent
                                            </td>
                                            <td class="py-3 px-4">-</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">24 Mai 2023</td>
                                            <td class="py-3 px-4">Base de Données</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-present attendance-marker"></span>
                                                Présent
                                            </td>
                                            <td class="py-3 px-4">-</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4">20 Mai 2023</td>
                                            <td class="py-3 px-4">Développement Front-End</td>
                                            <td class="py-3 px-4">
                                                <span class="attendance-late attendance-marker"></span>
                                                Retard (15 min)
                                            </td>
                                            <td class="py-3 px-4">
                                                <span class="text-blue-500">Problème transport</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-6 flex justify-between items-center">
                                <div class="text-gray-600">
                                    Affichage des 7 derniers cours
                                </div>
                                <button class="text-primary hover:underline flex items-center">
                                    Voir tout l'historique <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Statistiques d'absences -->
                        <div class="card bg-white rounded-xl p-6">
                            <h2 class="text-xl font-bold text-dark mb-6 flex items-center">
                                <i class="fas fa-chart-bar mr-3 text-primary"></i>
                                Statistiques de Présence
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
                                    <div class="text-4xl font-bold text-green-600">92%</div>
                                    <div class="text-gray-600 mt-2">Taux de présence</div>
                                    <div class="mt-4 w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 92%"></div>
                                    </div>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
                                    <div class="text-4xl font-bold text-red-600">3</div>
                                    <div class="text-gray-600 mt-2">Absences</div>
                                    <div class="mt-4 w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-red-500 h-2.5 rounded-full" style="width: 8%"></div>
                                    </div>
                                </div>
                                
                                <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
                                    <div class="text-4xl font-bold text-amber-600">2</div>
                                    <div class="text-gray-600 mt-2">Retards</div>
                                    <div class="mt-4 w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-amber-500 h-2.5 rounded-full" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-8">
                                <h3 class="font-bold text-gray-700 mb-4">Répartition par cours</h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-medium">Développement Front-End</span>
                                            <span>88%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-purple-500 h-2.5 rounded-full" style="width: 88%"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-medium">Back-End Node.js</span>
                                            <span>95%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: 95%"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-medium">Base de Données</span>
                                            <span>100%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <!-- Justifier une absence -->
                        <div class="card bg-white rounded-xl p-6 mb-8">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-file-medical mr-3 text-primary"></i>
                                Justifier une absence
                            </h2>
                            
                            <p class="text-gray-600 mb-4">
                                Vous pouvez justifier une absence en téléchargeant un justificatif valide (certificat médical, convocation, etc.).
                            </p>
                            
                            <form class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">Date d'absence</label>
                                    <input type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 mb-2">Cours concerné</label>
                                    <select class="w-full p-3 border border-gray-300 rounded-lg focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                        <option>Sélectionner un cours</option>
                                        <option>Développement Front-End</option>
                                        <option>Back-End Node.js</option>
                                        <option>Base de Données</option>
                                        <option>Projet personnel encadré</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 mb-2">Type de justification</label>
                                    <select class="w-full p-3 border border-gray-300 rounded-lg focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                        <option>Sélectionner un motif</option>
                                        <option>Maladie</option>
                                        <option>Problème de transport</option>
                                        <option>Rendez-vous médical</option>
                                        <option>Raison personnelle</option>
                                        <option>Autre</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 mb-2">Téléverser un justificatif</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:bg-gray-50 transition">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600">Cliquez pour téléverser ou glissez-déposez un fichier</p>
                                        <p class="text-gray-500 text-sm mt-1">PDF, JPG ou PNG (max. 5MB)</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-700 mb-2">Commentaire</label>
                                    <textarea rows="3" class="w-full p-3 border border-gray-300 rounded-lg focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" placeholder="Ajoutez des détails si nécessaire..."></textarea>
                                </div>
                                
                                <button class="w-full py-3 bg-primary hover:bg-indigo-700 text-white rounded-lg font-medium transition">
                                    Soumettre la justification
                                </button>
                            </form>
                        </div>
                        
                        <!-- Politique d'absence -->
                        <div class="card bg-white rounded-xl p-6">
                            <h2 class="text-xl font-bold text-dark mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3 text-primary"></i>
                                Politique d'absence
                            </h2>
                            
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <p class="text-gray-600">Les absences doivent être justifiées dans un délai de 7 jours</p>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <p class="text-gray-600">Un taux de présence minimum de 80% est requis pour valider la formation</p>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <p class="text-gray-600">Plus de 3 absences non justifiées peuvent entraîner un avertissement</p>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                                        <i class="fas fa-check text-blue-600 text-xs"></i>
                                    </div>
                                    <p class="text-gray-600">Les retards de plus de 30 minutes sont comptabilisés comme une demi-absence</p>
                                </div>
                            </div>
                            
                            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                                <h3 class="font-bold text-blue-800 mb-2 flex items-center">
                                    <i class="fas fa-headset mr-2"></i>
                                    Besoin d'aide?
                                </h3>
                                <p class="text-blue-700">
                                    Contactez le service administratif à 
                                    <a href="mailto:admin@ecole-digitale.fr" class="font-medium underline">admin@ecole-digitale.fr</a> 
                                    ou par téléphone au 01 23 45 67 89.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Gestion des onglets
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer les éléments
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            // Fonction pour changer d'onglet
            function changeTab(tabId) {
                // Désactiver tous les onglets
                tabButtons.forEach(button => button.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Activer l'onglet sélectionné
                document.getElementById(tabId).classList.add('active');
                document.getElementById(`${tabId}-content`).classList.add('active');
            }
            
            // Ajouter les écouteurs d'événements
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    changeTab(button.id);
                });
            });
        });
    </script>
</body>
</html>