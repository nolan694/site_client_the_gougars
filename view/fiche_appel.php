<?php
// Connexion à la base de données
try {
    $connexion = new PDO('mysql:host=localhost;dbname=client_cougars;charset=utf8', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête pour récupérer tous les élèves
$req = $connexion->prepare("SELECT * FROM utilisateurs WHERE role = 'eleve'");
$req->execute();
$eleves = $req->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if (isset($_POST['submit_register'])) {
    foreach ($eleves as $eleve) {
        $presence = isset($_POST['presence'][$eleve['id']]) ? $_POST['presence'][$eleve['id']] : 0;
        $transport = isset($_POST['transport'][$eleve['id']]) ? $_POST['transport'][$eleve['id']] : null;
        //echo $presence . "<br>";
        if ($presence == 'on'){
            $appel = 1;
        }else if ($presence == 0){ 
            $appel = 0;
        }
        //echo $appel . "<br>";
        $rek = $connexion->prepare("INSERT INTO appels (eleve_id, present, transports) VALUES (?, ?, ?)");
        $rek->execute(array($eleve['id'], $appel, $transport));
        if ($rek->rowCount() == 1) {
            $erreur = "Validation réussie !";
    } else {
            $erreur = "Erreur lors de la validation !";
    }
    if ($transport == 'Voiture'){
        $score = 1;
    } else if ($transport == 'Bus/trottinette_electrique'){
        $score = 2;
    } else if ($transport == 'Vélo/trottinette'){
        $score = 4;
    } else if ($transport == 'À pied'){
        $score = 5;
    } else if ($transport == 'Covoiturage'){
        $score = 3;
    }else {
        $score = 0; // Si aucun transport n'est sélectionné
    }
    //echo "Score calculé: " . $score . "<br>";
    $rec = $connexion->prepare("UPDATE eleves SET points = points + ? WHERE id = ?");
    $rec->execute(array($score, $eleve['id']));

    if ($rec->rowCount() == 1) {
        //echo "Points mis à jour avec succès pour l'élève ID: " . $eleve['id'] . "<br>";
    } else {
        //echo "Erreur lors de la mise à jour des points pour l'élève ID: " . $eleve['id'] . "<br>";
    }

    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche d'appel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Fiche d'appel</h1>
        <form id="attendance-form" method="POST" action="">
            <div id="students-list" class="space-y-4">
                <!-- Génération de la liste des élèves en PHP -->
                <?php foreach ($eleves as $eleve): ?>
                    <div class="flex items-center gap-4 p-4 border rounded-lg">
                        <img src="/api/placeholder/100/100" alt="<?= htmlspecialchars($eleve['prenom']) . ' ' . htmlspecialchars($eleve['nom']) ?>" class="w-16 h-16 rounded-full object-cover">
                        <div class="flex-1">
                            <h2 class="font-semibold"><?= htmlspecialchars($eleve['prenom']) . ' ' . htmlspecialchars($eleve['nom']) ?></h2>
                            <div class="flex items-center gap-4 mt-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="presence[<?= $eleve['id'] ?>]" class="presence-checkbox" data-student-id="<?= $eleve['id'] ?>" checked>
                                    Présent
                                </label>
                                <select name="transport[<?= $eleve['id'] ?>]" class="transport-select border rounded px-2 py-1" data-student-id="<?= $eleve['id'] ?>">
                                    <option value="Voiture">Voiture</option>
                                    <option value="Bus/trottinette_electrique">Bus</option>
                                    <option value="Vélo/trottinette">Vélo/trottinette</option>
                                    <option value="À pied">À pied</option>
                                    <option value="Covoiturage">Covoiturage</option>
                                </select>
                            </div>
                            <input type="hidden" name="student_ids[<?= $eleve['id'] ?>]" value="<?= $eleve['id'] ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-300 mt-4" id="submit_register" name="submit_register">
                Valider l'appel
            </button>
        </form>
    </div>

    <script>
        // Optionnel : Vous pouvez conserver cette partie de JavaScript si vous voulez désactiver les choix de transport
        const presenceCheckboxes = document.querySelectorAll('.presence-checkbox');

        presenceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const studentId = this.dataset.studentId;
                const transportSelect = document.querySelector(`.transport-select[data-student-id="${studentId}"]`);
                transportSelect.disabled = !this.checked;
                if (!this.checked) {
                    transportSelect.selectedIndex = 0;
                }
            });
        });
    </script>
</body>
</html>
