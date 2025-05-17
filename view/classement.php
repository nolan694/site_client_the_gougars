<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "client_cougars";

// Connexion à la base de données
$conn = new mysqli($host, $user, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupérer le classement des élèves
$sql_eleves = "
    SELECT u.nom AS eleve_nom, u.prenom AS eleve_prenom, c.nom_classe, 
           COALESCE(cs.points_totaux, 0) AS total_points
    FROM eleves e
    JOIN utilisateurs u ON e.utilisateur_id = u.id
    JOIN classes c ON e.classe_id = c.id
    LEFT JOIN competition_scores cs ON e.id = cs.eleve_id
    ORDER BY total_points DESC";

$eleves = $conn->query($sql_eleves);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement des Élèves - Gestion Ecole</title>
    <style>
        :root {
            --primary-color: #3B4371;
            --secondary-color: #F3F4F6;
            --accent-color: #4A55A2;
            --text-color: #1F2937;
            --bg-color: #F9FAFB;
            --header-bg: #F3F4F6;
            --card-bg: #FFFFFF;
            --border-color: rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            padding-top: 100px;
        }

        .header {
            background: var(--header-bg);
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .card {
            background: var(--card-bg);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        h2 {
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            font-weight: 600;
        }
    </style>
</head>
<body>

    <header class="header">
        <h1>Gestion Ecole</h1>
    </header>

    <main class="container">
        <a href="menu.php" class="back-button">⬅ Retour au menu</a>

        <h2>Classement des Élèves</h2>
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Classe</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($eleve = $eleves->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($eleve['eleve_nom']) ?></td>
                            <td><?= htmlspecialchars($eleve['eleve_prenom']) ?></td>
                            <td><?= htmlspecialchars($eleve['nom_classe']) ?></td>
                            <td><?= $eleve['total_points'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
