<?php
session_start();
?>
<style>
        :root {
            --primary-color: #3B4371;
            --secondary-color: #F3F4F6;
            --accent-color: #4A55A2;
            --danger-color: #DC2626;
            --success-color: #059669;
            --text-color: #1F2937;
            --bg-color: #FFFFFF;
            --card-hover: #F9FAFB;
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
            background: var(--bg-color);
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
            letter-spacing: -0.025em;
        }

        .admin-badge {
            background-color: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent-color);
            text-decoration: none;
            margin-bottom: 2rem;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filters select, .filters input {
            padding: 0.75rem;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            width: 100%;
        }

        .table-container {
            overflow-x: auto;
            background: var(--bg-color);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        th {
            background-color: var(--secondary-color);
            font-weight: 600;
        }

        tr:hover {
            background-color: var(--card-hover);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-badge.success {
            background-color: rgba(5, 150, 105, 0.1);
            color: var(--success-color);
        }

        .status-badge.warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #D97706;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination button {
            padding: 0.5rem 1rem;
            border: 1px solid var(--accent-color);
            background: none;
            color: var(--accent-color);
            border-radius: 6px;
            cursor: pointer;
        }

        .pagination button.active {
            background-color: var(--accent-color);
            color: white;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --primary-color: #E5E7EB;
                --secondary-color: #1F2937;
                --accent-color: #818CF8;
                --danger-color: #EF4444;
                --success-color: #10B981;
                --text-color: #F9FAFB;
                --bg-color: #111827;
                --card-hover: #1F2937;
            }

            select, input {
                background-color: var(--secondary-color);
                border-color: rgba(255,255,255,0.1);
                color: var(--text-color);
            }

            th {
                background-color: var(--secondary-color);
            }

            .table-container {
                border: 1px solid rgba(255,255,255,0.1);
            }
        }
    </style>
    <?php
// Connexion à la base de données
try {
    $connexion = new PDO('mysql:host=localhost;dbname=client_cougars;charset=utf8', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les classes
$classesQuery = $connexion->prepare("SELECT * FROM classes");
$classesQuery->execute();
$classes = $classesQuery->fetchAll(PDO::FETCH_ASSOC);?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Score - Historique des Points</title>
    <style>
        /* Votre style CSS ici */
    </style>
</head>
<body>
    <header class="header">
        <h1>Transport Score</h1>
        <span class="admin-badge">Administration</span>
    </header>

    <main class="container">
        <a href="Eleve.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Retour au tableau de bord
        </a>

        <h2 style="margin-bottom: 2rem; color: var(--primary-color);">Historique des Points</h2>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>Points</th>
                            <th>Classement</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Afficher les élèves de chaque classe
                    foreach ($classes as $classe): 
                        // Récupérer les élèves de la classe actuelle
                        $sql_eleves = $connexion->prepare("SELECT
                            utilisateurs.prenom,
                            utilisateurs.nom,
                            classes.nom_classe,
                            eleves.points,
                            ROW_NUMBER() OVER (ORDER BY eleves.points DESC) AS classement
                        FROM eleves
                        JOIN utilisateurs ON eleves.utilisateur_id = utilisateurs.id
                        JOIN classes ON eleves.classe_id = classes.id
                        ORDER BY eleves.points DESC;");
                        $sql_eleves->execute();
                        $eleves = $sql_eleves->fetchAll(PDO::FETCH_ASSOC);
                        $_SESSION['classe'] = $classe['nom_classe']; 
                        ?>
                        
                    <?php endforeach; ?>
                    <?php foreach ($eleves as $eleve): ?>
                        <tr>
                            <td><?= htmlspecialchars($eleve['nom']) ?></td>
                            <td><?= htmlspecialchars($eleve['prenom']) ?></td>
                            <td><?= htmlspecialchars($eleve['points']) ?></td>
                            <td><?= htmlspecialchars($eleve['classement']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </main>

    <script>
        // Simulation du chargement des données
        document.getElementById('filter-type').addEventListener('change', function() {
            console.log('Filtrage par type:', this.value);
        });

        document.getElementById('filter-target').addEventListener('change', function() {
            console.log('Filtrage par cible:', this.value);
        });

        // Gestion de la pagination
        document.querySelectorAll('.pagination button').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.classList.contains('active') && !this.querySelector('i')) {
                    document.querySelector('.pagination button.active').classList.remove('active');
                    this.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
