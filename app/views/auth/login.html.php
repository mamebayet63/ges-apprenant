
    <div class="container mx-auto px-4 h-screen flex items-center justify-center">
        <div class="w-full max-w-md space-y-8">
            <!-- En-tête -->
            <div class="text-center">
                <div class="mb-8 animate-bounce">
                    <img src="ecol221-logo.png" alt="ecol221 Logo" class="mx-auto h-24 w-auto">
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">
                    Bienvenue sur
                </h1>
                <h2 class="text-3xl font-semibold text-red-600">
                    ECOl221 Platform
                </h2>
            </div>

            <!-- Formulaire -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 space-y-6 transform transition-all hover:shadow-xl">
                <form class="space-y-6"  method="POST">
                    <?php if (!empty($errors)) : ?>
                <div class="error-card bg-red-100 border border-red-400/20 text-red-300 px-6 py-4 rounded-xl backdrop-blur-sm animate-error-appear">
                    <?php foreach ($errors as $error) : ?>
                        <p class="text-sm flex items-center space-x-3">
                            <svg class="w-5 h-5 flex-shrink-0 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                            </svg>
                            <span class="text-red-600"><?= $error ?></span>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Identifiant
                        </label>
                        <input type="email"  name="email" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all placeholder-gray-400"
                            placeholder="exemple@ecol221.edu.sn">
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Mot de passe
                        </label>
                        <input type="password"  name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all placeholder-gray-400"
                            placeholder="••••••••">
                    </div>

                    <!-- Options -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" type="checkbox" 
                                class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 text-sm text-gray-600">
                                Se souvenir de moi
                            </label>
                        </div>
                        <a href="#" class="text-sm text-red-600 hover:text-red-800">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <!-- Bouton de connexion -->
                    <button type="submit" 
                        class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg 
                        transition-all duration-300 transform hover:scale-[1.02] shadow-md hover:shadow-red-200">
                        Se connecter
                    </button>
                </form>

                <!-- Footer -->
                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        Nouveau sur ecol221 ? 
                        <a href="#" class="text-red-600 hover:text-red-800 font-medium">
                            Créer un compte
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
