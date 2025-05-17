<?php
   $connexion = new PDO('mysql:host=localhost;dbname=client_cougars', 'root', '');
   session_start();
   // Vérification de la soumission du formulaire
   if (isset($_POST['valider'])) {
       if ($_POST['email'] != '' AND $_POST['password'] != '') {
           // Récupération des données POST
           $email = $_POST['email'];
           $password = $_POST['password'];
   
           // Préparation de la requête pour récupérer l'utilisateur
           $req = $connexion->prepare('SELECT * FROM utilisateurs WHERE nom = ? AND mot_de_passe = ?');
           $req->execute(array($email, $password));
           
           // Comptage des résultats
           $cpt = $req->rowCount();
           
           if ($cpt == 1) {
               // Récupérer les informations de l'utilisateur
               $utilisateur = $req->fetch(PDO::FETCH_ASSOC);
               
               // Vérifier le rôle de l'utilisateur
               $role = $utilisateur['role'];
   
               // Redirection en fonction du rôle
               if ($role == 'admin') {
                   header("Location: admin.php");
               } elseif ($role == 'prof') {
                   header("Location: Menu.php");
               } elseif ($role == 'eleve') {
                        $_SESSION['id'] = $utilisateur['id'];
                        $_SESSION['nom'] = $utilisateur['nom'];
                        $_SESSION['prenom'] = $utilisateur['prenom'];
                        header("Location: Eleve.php");
               } else {
                   $erreur = "Rôle non défini.";
               }
           } else {
               // Si les identifiants sont incorrects
               $erreur = "Mauvais email ou mot de passe !";
           }
       } else {
           $erreur = "Veuillez remplir tous les champs.";
       }
   }
          if (isset($_POST['submit_register'])){
                  if ($_POST['prenom'] != '' AND $_POST['nom'] != '' AND $_POST['password'] != '' AND $_POST['password2'] != '') {
                        if ($_POST['password'] == $_POST['password2']) {
                                $prenom = $_POST['prenom'];
                                $nom = $_POST['nom'];
                                $password = $_POST['password'];
                                $insertUser = $connexion->prepare('INSERT INTO utilisateurs(nom, prenom, mot_de_passe) VALUES(?, ?, ?)');
                                $insertUser->execute(array($nom, $prenom, $password));
                                $recupUser = $connexion->prepare('SELECT * FROM utilisateurs WHERE nom = ? AND prenom = ? AND mot_de_passe = ?');
                                $recupUser->execute(array($nom, $prenom, $password));
                                if ($recupUser->rowCount() == 1) {
                                        header("Location: Menu.php");
                                } else {
                                        $erreur = "Erreur lors de l'inscription !";
                                }

                        } else {
                                $erreur = "Les mots de passe ne correspondent pas !";
                        }
                        

                  } else {
                          $erreur = "Veuillez remplir tous les champs !";
                  }

       }
   
?>
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
<form class="space-y-4" method="POST">
<div>
<label for="email-login" class="block text-gray-700 font-medium mb-2">Adresse Email</label>
<input 
                        type="text"
                        name="email" 
                        id="email" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="votre.email@exemple.com" 
                        required
>
</div>
<div>
<label for="password-login" class="block text-gray-700 font-medium mb-2">Mot de Passe</label>
<input 
                        name="password"
                        type="password" 
                        id="password" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<div class="flex items-center justify-between">
<a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
</div>
<button 
                    id="valider"  
                    name="valider"     
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
<form class="space-y-4" method="POST" action="">
<div class="flex gap-4">
<div class="w-1/2">
<label for="firstname" class="block text-gray-700 font-medium mb-2">Prénom</label>
<input 
                            type="text"
                            name="prenom" 
                            id="prenom" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre prénom" 
                            required
>
</div>
<div class="w-1/2">
<label for="lastname" class="block text-gray-700 font-medium mb-2">Nom</label>
<input 
                            type="text"
                            name="nom" 
                            id="nom" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Votre nom" 
                            required
>
</div>
</div>

<div>
<label for="password-register" class="block text-gray-700 font-medium mb-2">Mot de Passe</label>
<input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<div>
<label for="confirm-password" class="block text-gray-700 font-medium mb-2">Confirmez le Mot de Passe</label>
<input 
                        type="password" 
                        id="password2"
                        name="password2" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        placeholder="••••••••" 
                        required
>
</div>
<button 
                    type="submit" 
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300"
                    id="submit_register"
                    name="submit_register"
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