<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Score - Calcul des Points</title>
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

        .calculator-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .calculator-card {
            background: var(--bg-color);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .calculator-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            background-color: var(--bg-color);
        }

        .points-display {
            background-color: var(--secondary-color);
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 1rem;
            text-align: center;
        }

        .points-display h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .points-value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--accent-color);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
        }

        .history-list {
            margin-top: 1rem;
            max-height: 200px;
            overflow-y: auto;
        }

        .history-item {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-item:last-child {
            border-bottom: none;
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

            .calculator-card {
                border: 1px solid rgba(255,255,255,0.1);
            }

            .form-group select,
            .form-group input {
                background-color: var(--secondary-color);
                border-color: rgba(255,255,255,0.1);
                color: var(--text-color);
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

        <h2 style="color: var(--primary-color);">Calcul des Points</h2>

        <div class="calculator-grid">
            <div class="calculator-card">
                <h3>Calculateur de Points</h3>
                <div class="form-group">
                    <label for="transport-type">Type de Transport</label>
                    <select id="transport-type">
                        <option value="">Sélectionner un type</option>
                        <option value="bus">Bus</option>
                        <option value="velo">Vélo</option>
                        <option value="marche">Marche</option>
                        <option value="covoiturage">Covoiturage</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="distance">Distance (km)</label>
                    <input type="number" id="distance" min="0" step="0.1">
                </div>

                <div class="form-group">
                    <label for="frequency">Fréquence</label>
                    <select id="frequency">
                        <option value="daily">Quotidien</option>
                        <option value="weekly">Hebdomadaire</option>
                        <option value="monthly">Mensuel</option>
                    </select>
                </div>

                <div class="points-display">
                    <h4>Points Calculés</h4>
                    <div class="points-value" id="calculated-points">0</div>
                </div>

                <div class="action-buttons">
                    <button class="btn btn-secondary" id="reset-btn">Réinitialiser</button>
                    <button class="btn btn-primary" id="calculate-btn">Calculer</button>
                </div>
            </div>

            <div class="calculator-card">
                <h3>Historique des Calculs</h3>
                <div class="history-list" id="calculation-history">
                    <!-- Les éléments seront ajoutés dynamiquement -->
                </div>
            </div>
        </div>
    </main>

    <script>
        const transportPoints = {
            bus: 2,
            velo: 5,
            marche: 4,
            covoiturage: 3
        };

        const frequencyMultiplier = {
            daily: 20,
            weekly: 4,
            monthly: 1
        };

        function calculatePoints() {
            const transportType = document.getElementById('transport-type').value;
            const distance = parseFloat(document.getElementById('distance').value) || 0;
            const frequency = document.getElementById('frequency').value;

            if (!transportType) {
                alert('Veuillez sélectionner un type de transport');
                return;
            }

            const basePoints = transportPoints[transportType];
            const multiplier = frequencyMultiplier[frequency];
            const distanceMultiplier = Math.ceil(distance / 5); // Points supplémentaires tous les 5km
            
            const totalPoints = basePoints * multiplier * distanceMultiplier;
            
            document.getElementById('calculated-points').textContent = totalPoints;
            
            addToHistory(transportType, distance, frequency, totalPoints);
        }

        function addToHistory(transport, distance, frequency, points) {
            const historyList = document.getElementById('calculation-history');
            const historyItem = document.createElement('div');
            historyItem.className = 'history-item';
            
            const date = new Date().toLocaleDateString();
            historyItem.innerHTML = `
                <div>
                    <strong>${transport.charAt(0).toUpperCase() + transport.slice(1)}</strong>
                    <br>
                    <small>${distance}km - ${frequency}</small>
                </div>
                <div>
                    <strong>${points} points</strong>
                    <br>
                    <small>${date}</small>
                </div>
            `;
            
            historyList.insertBefore(historyItem, historyList.firstChild);
        }

        function resetCalculator() {
            document.getElementById('transport-type').value = '';
            document.getElementById('distance').value = '';
            document.getElementById('frequency').value = 'daily';
            document.getElementById('calculated-points').textContent = '0';
        }

        document.getElementById('calculate-btn').addEventListener('click', calculatePoints);
        document.getElementById('reset-btn').addEventListener('click', resetCalculator);
    </script>
</body>
</html>