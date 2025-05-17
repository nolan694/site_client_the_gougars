<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> - Administration</title>
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

        .menu-container {
            max-width: 1400px;
            margin: 100px auto 0;
            padding: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .menu-card {
            background: var(--bg-color);
            border-radius: 12px;
            padding: 1.75rem;
            text-align: center;
            transition: all 0.2s ease;
            border: 1px solid rgba(0,0,0,0.05);
            cursor: pointer;
            margin-top: 100px;
            z-index: 10px;
        }

        .menu-card:hover {
            transform: translateY(-2px);
            background: var(--card-hover);
            border-color: rgba(74, 85, 162, 0.2);
        }

        .menu-card.danger:hover {
            border-color: rgba(220, 38, 38, 0.2);
        }

        .menu-card i {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
            opacity: 0.9;
        }

        .menu-card.danger i {
            color: var(--danger-color);
        }

        .menu-card.success i {
            color: var(--success-color);
        }

        .menu-card h2 {
            color: var(--primary-color);
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .menu-card p {
            color: #6B7280;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .section-title {
            grid-column: 1 / -1;
            color: var(--primary-color);
            font-size: 1.25rem;
            margin-top: 2rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
        }

        @media (max-width: 768px) {
            .menu-container {
                padding: 1rem;
                margin-top: 80px;
            }

            .header h1 {
                font-size: 1.25rem;
            }

            .menu-card {
                padding: 1.5rem;
            }
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

            .menu-card {
                border-color: rgba(255,255,255,0.05);
            }

            .menu-card:hover {
                border-color: rgba(129, 140, 248, 0.2);
            }

                        .menu-card p {
                            color: #9CA3AF;
                        }
                    }
                </style>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            </head>
            <body>
                <header class="header">
                    <span class="admin-badge">Administration</span>
                </header>
                <main>
                    <div class="menu-card" onclick="location.href='historique-points.php'">
                        <i class="fas fa-history"></i>
                        <h2>Historique des Points</h2>
                        <p>Consulter l'historique des attributions</p>
                    </div>
                </main>
            </body>
            </html>
