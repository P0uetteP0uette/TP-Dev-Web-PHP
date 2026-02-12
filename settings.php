<?php $pageTitle = "Paramètres - Ticketing App"; include 'header.php'; ?>

<body>

<button id="mobile-menu-btn" class="menu-btn"><span>&#8942;</span></button>

<div class="app-layout">
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.html">📊 Tableau de bord</a></li>
            <li><a href="projects.html">📁 Projets</a></li>
            <li><a href="tickets.html">🎫 Tickets</a></li>
            
            <li><a href="profile.html">👤 Mon Profil</a></li>
            <li><a href="settings.html" class="active">⚙️ Paramètres</a></li>

            <li><a href="index.html" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="container-narrow">
            
            <header class="page-header-simple">
                <h1>Paramètres de l'application</h1>
                <p class="text-muted">Personnalisez votre expérience.</p>
            </header>

            <div class="card">
                <h2 class="form-section-title">Notifications</h2>
                <p class="text-muted mb-1">Choisissez quand vous souhaitez être alerté.</p>
                
                <div class="form-group">
                    <label class="checkbox-pill mb-1">
                        <input type="checkbox" checked> M'avertir quand un ticket m'est assigné
                    </label>
                    <label class="checkbox-pill mb-1">
                        <input type="checkbox" checked> M'avertir lors d'une nouvelle réponse
                    </label>
                    <label class="checkbox-pill mb-1">
                        <input type="checkbox"> Recevoir le résumé hebdomadaire par email
                    </label>
                </div>
            </div>

            <div class="card">
                <h2 class="form-section-title">Préférences générales</h2>
                
                <div class="form-group">
                    <label>Langue de l'interface</label>
                    <select>
                        <option value="fr" selected>Français</option>
                        <option value="en">English</option>
                        <option value="es">Español</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fuseau horaire</label>
                    <select>
                        <option value="paris" selected>Europe/Paris (GMT+1)</option>
                        <option value="london">Europe/London (GMT+0)</option>
                        <option value="ny">America/New_York (GMT-5)</option>
                    </select>
                </div>
                
                <div class="text-right mt-1">
                    <button class="btn">Sauvegarder les préférences</button>
                </div>
            </div>

            <div class="card" style="border: 1px solid #fee2e2;">
                <h2 class="form-section-title" style="color: var(--danger); border-left-color: var(--danger);">Zone de danger</h2>
                <p class="text-muted mb-1">La suppression de votre compte est irréversible. Toutes vos données seront perdues.</p>
                
                <div class="d-flex justify-center">
                    <button class="btn btn-outline" style="color: var(--danger); border-color: var(--danger);">Supprimer mon compte</button>
                </div>
            </div>

        </div>
    </main>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>