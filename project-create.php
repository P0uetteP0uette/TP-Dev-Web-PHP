<?php $pageTitle = "Créer un Projet - Ticketing App"; include 'header.php'; ?>

<body>

<button id="mobile-menu-btn" class="menu-btn">
    <span>&#8942;</span>
</button>

<div class="app-layout">
    
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.html">📊 Tableau de bord</a></li>
            <li><a href="projects.html" class="active">📁 Projets</a></li>
            <li><a href="tickets.html">🎫 Tickets</a></li>
            <li><a href="profile.html">👤 Mon Profil</a></li>
            <li><a href="settings.html">⚙️ Paramètres</a></li>
            <li><a href="index.html" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <div class="container-narrow">
            
            <div class="page-header-simple">
                <a href="projects.html" class="link-back">← Annuler et retour</a>
                <h1>Créer un nouveau projet</h1>
                <p>Définissez le cadre contractuel et l'équipe assignée.</p>
            </div>

            <div class="card">
                <form id="createProjectForm">
                    
                    <h2 class="form-section-title">1. Identité du projet</h2>
                    
                    <div class="d-flex gap-1 mb-1 mobile-col">
                        <div class="form-group flex-2">
                            <label for="name">Nom du projet *</label>
                            <input type="text" id="name" placeholder="Ex: Refonte Site E-commerce" required>
                        </div>
                        
                        <div class="form-group flex-1">
                            <label for="client">Client *</label>
                            <select id="client" required>
                                <option value="" disabled selected>Choisir...</option>
                                <option value="1">Acme Corp</option>
                                <option value="2">Globex</option>
                                <option value="3">Wayne Ent.</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Contexte / Description</label>
                        <textarea id="description" rows="3" placeholder="Décrivez les objectifs principaux du projet..."></textarea>
                    </div>

                    <hr class="divider">

                    <h2 class="form-section-title">2. Contrat & Heures</h2>

                    <div class="d-flex gap-1 mb-1 mobile-col">
                        
                        <div class="form-group flex-1">
                            <label for="hours">Volume d'heures inclus *</label>
                            <input type="number" id="hours" placeholder="Ex: 50" min="0" required>
                            <p class="form-text">Une fois épuisé, les tickets passent en "Facturable".</p>
                        </div>

                        <div class="form-group flex-1">
                            <label for="rate">Taux horaire suppl. (€) *</label>
                            <input type="number" id="rate" placeholder="Ex: 80" min="0" required>
                            <p class="form-text">Prix de l'heure hors forfait.</p>
                        </div>

                    </div>

                    <div class="d-flex gap-1 mb-1 mobile-col">
                        <div class="form-group flex-1">
                            <label for="start_date">Date de début</label>
                            <input type="date" id="start_date">
                        </div>
                        <div class="form-group flex-1">
                            <label for="end_date">Date de fin (Optionnel)</label>
                            <input type="date" id="end_date">
                        </div>
                    </div>

                    <hr class="divider">

                    <h2 class="form-section-title">3. Équipe assignée</h2>
                    
                    <div class="form-group">
                        <label class="d-block mb-1">Sélectionnez les collaborateurs :</label>
                        
                        <div class="d-flex gap-1 flex-wrap">
                            
                            <label class="checkbox-pill">
                                <input type="checkbox" name="team" value="1" checked> Alice L. (Lead Dev)
                            </label>

                            <label class="checkbox-pill">
                                <input type="checkbox" name="team" value="2"> Jean P. (Frontend)
                            </label>

                            <label class="checkbox-pill">
                                <input type="checkbox" name="team" value="3"> Sophie M. (Backend)
                            </label>

                        </div>
                    </div>

                    <div class="form-actions text-right mt-2">
                        <button type="submit" class="btn btn-wide">Valider le projet</button>
                    </div>

                </form>
            </div>

        </div>

    </main>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>