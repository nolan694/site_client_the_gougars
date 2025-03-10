<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>École - Connexion</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            loginForm.classList.toggle('hidden');
            registerForm.classList.toggle('hidden');
        }
</script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
<div class="w-full max-w-md bg-white shadow-md rounded-xl p-8 space-y-6">
<div class="text-center">
<h1 class="text-3xl font-bold text-gray-800">École</h1>
<p class="text-gray-500 mt-2">Espace Utilisateur</p>
</div>
 
        <!-- Formulaire de Connexion -->
<div id="login-form" class="space-y-4">
<form class="space-y-4">
<div>
<label for="email-login" class="block text-gray-700 font-medium mb-2">Adresse Email</label>
<input 
                        type="text" 
                        id="email-login" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="votre.email@exemple.com" 
                        required
>
</div>
<div>
<label for="password-login" class="block text-gray-700 font-medium mb-2">Mot de Passe</label>
<input 
                        type="password" 
                        id="password-login" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<div class="flex items-center justify-between">
<a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
</div>
<button 
                    type="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-300"
>
                    Se Connecter
</button>
</form>
<div class="text-center">
<p class="text-gray-600 text-sm">
                    Pas encore de compte ? 
<a href="javascript:void(0)" onclick="toggleForm()" class="text-blue-600 hover:underline">
                        Inscrivez-vous
</a>
</p>
</div>
</div>
 
        <!-- Formulaire d'Inscription -->
<div id="register-form" class="space-y-4 hidden">
<form class="space-y-4">
<div class="flex gap-4">
<div class="w-1/2">
<label for="firstname" class="block text-gray-700 font-medium mb-2">Prénom</label>
<input 
                            type="text" 
                            id="firstname" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre prénom" 
                            required
>
</div>
<div class="w-1/2">
<label for="lastname" class="block text-gray-700 font-medium mb-2">Nom</label>
<input 
                            type="text" 
                            id="lastname" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre nom" 
                            required
>
</div>
</div>
<div>
<label for="email-register" class="block text-gray-700 font-medium mb-2">Adresse Email</label>
<input 
                        type="email" 
                        id="email-register" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="votre.email@exemple.com" 
                        required
>
</div>
<div>
<label for="password-register" class="block text-gray-700 font-medium mb-2">Mot de Passe</label>
<input 
                        type="password" 
                        id="password-register" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<div>
<label for="confirm-password" class="block text-gray-700 font-medium mb-2">Confirmez le Mot de Passe</label>
<input 
                        type="password" 
                        id="confirm-password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<button 
                    type="submit" 
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300"
>
                    Créer un Compte
</button>
</form>
<div class="text-center">
<p class="text-gray-600 text-sm">
                    Déjà un compte ? 
<a href="javascript:void(0)" onclick="toggleForm()" class="text-blue-600 hover:underline">
                        Connectez-vous
</a>
</p>
</div>
</div>
</div>
</body>
</html>