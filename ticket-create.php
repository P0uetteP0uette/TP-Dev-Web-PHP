<?php $pageTitle = "Créer un Ticket - Ticketing App"; include 'header.php'; ?>

<body>

<button id="mobile-menu-btn" class="menu-btn">
    <span>&#8942;</span>
</button>

<div class="app-layout">
    
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.html">📊 Tableau de bord</a></li>
            <li><a href="projects.html">📁 Projets</a></li>
            <li><a href="tickets.html" class="active">🎫 Tickets</a></li>
            <li><a href="profile.html">👤 Mon Profil</a></li>
            <li><a href="settings.html">⚙️ Paramètres</a></li>
            <li><a href="index.html" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <div class="container-narrow">
            
            <div class="page-header-simple">
                <a href="tickets.html" class="link-back">← Annuler et retour</a>
                <h1>Ouvrir un nouveau ticket</h1>
                <p>Décrivez votre problème ou votre demande d'évolution.</p>
            </div>

            <div class="card">
                <form id="createTicketForm">
                    
                    <div class="d-flex gap-1 mb-1 mobile-col">
                        <div class="form-group flex-1">
                            <label for="project">Projet concerné *</label>
                            <select id="project" required>
                                <option value="" disabled selected>Choisir un projet...</option>
                                <option value="1">Site Vitrine (Acme Corp)</option>
                                <option value="2">Intranet RH (Globex)</option>
                                <option value="3">App Mobile (Wayne Ent)</option>
                            </select>
                        </div>

                        <div class="form-group flex-1">
                            <label for="priority">Priorité</label>
                            <select id="priority">
                                <option value="low">🟢 Basse</option>
                                <option value="medium" selected>🟡 Normale</option>
                                <option value="high">🔴 Haute</option>
                                <option value="critical">🔥 Critique</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Sujet de la demande *</label>
                        <input type="text" id="title" placeholder="Ex: Erreur lors de l'upload de fichiers..." required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description détaillée *</label>
                        <textarea id="description" rows="6" placeholder="Expliquez le contexte, les étapes pour reproduire le bug..." required></textarea>
                        <p class="form-text">Soyez le plus précis possible pour accélérer le traitement.</p>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de demande</label>
                        <select id="type">
                            <option value="bug">Correction de Bug (Inclus)</option>
                            <option value="feature">Nouvelle fonctionnalité (Potentiellement facturable)</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>

                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-wide">Créer le ticket</button>
                    </div>

                </form>
            </div>

        </div>

    </main>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>