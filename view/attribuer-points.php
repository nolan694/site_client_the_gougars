<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Score - Attribuer des Points</title>
    <style>
        /* Mêmes styles CSS que admin.html */
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
            max-width: 800px;
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
        }

        select, input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .button {
            background-color: var(--accent-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .button:hover {
            opacity: 0.9;
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
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Transport Score</h1>
        <span class="admin-badge">Administration</span>
    </header>

    <main class="container">
        <a href="admin.html" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Retour au tableau de bord
        </a>

        <h2 style="margin-bottom: 2rem; color: var(--primary-color);">Attribuer des Points</h2>

        <form id="attributionForm">
            <div class="form-group">
                <label for="target-type">Type d'attribution</label>
                <select id="target-type" required>
                    <option value="">Sélectionner le type</option>
                    <option value="eleve">Élève</option>
                    <option value="classe">Classe</option>
                </select>
            </div>

            <div class="form-group">
                <label for="target">Sélectionner la cible</label>
                <select id="target" required>
                    <option value="">Choisir...</option>
                </select>
            </div>

            <div class="form-group">
                <label for="points">Nombre de points</label>
                <input type="number" id="points" required min="0" step="1">
            </div>

            <div class="form-group">
                <label for="reason">Motif</label>
                <select id="reason" required>
                    <option value="">Sélectionner un motif</option>
                    <option value="participation">Participation active</option>
                    <option value="comportement">Bon comportement</option>
                    <option value="progres">Progrès significatifs</option>
                    <option value="autre">Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comments">Commentaires (optionnel)</label>
                <input type="text" id="comments" placeholder="Ajouter un commentaire...">
            </div>

            <button type="submit" class="button">
                <i class="fas fa-plus-circle"></i>
                Attribuer les points
            </button>
        </form>
    </main>

    <script>
        document.getElementById('attributionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Logique d'attribution des points à implémenter
            alert('Points attribués avec succès !');
        });

        document.getElementById('target-type').addEventListener('change', function() {
            const targetSelect = document.getElementById('target');
            targetSelect.innerHTML = '<option value="">Choisir...</option>';
            
            if (this.value === 'eleve') {
                // Simuler le chargement des élèves
                const eleves = ['Jean Dupont', 'Marie Martin', 'Lucas Bernard'];
                eleves.forEach(eleve => {
                    const option = document.createElement('option');
                    option.value = eleve.toLowerCase().replace(' ', '-');
                    option.textContent = eleve;
                    targetSelect.appendChild(option);
                });
            } else if (this.value === 'classe') {
                // Simuler le chargement des classes
                const classes = ['6e A', '5e B', '4e C', '3e D'];
                classes.forEach(classe => {
                    const option = document.createElement('option');
                    option.value = classe.toLowerCase().replace(' ', '-');
                    option.textContent = classe;
                    targetSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>