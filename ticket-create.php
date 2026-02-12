<?php 
$pageTitle = "Créer un Ticket - Ticketing App"; 
include 'header.php'; 
?>

<body>

<button id="mobile-menu-btn" class="menu-btn">
    <span>&#8942;</span>
</button>

<div class="app-layout">
    
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php">📊 Tableau de bord</a></li>
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php" class="active">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <div class="container-narrow">
            
            <div class="page-header-simple">
                <a href="tickets.php" class="link-back">← Annuler et retour</a>
                <h1>Ouvrir un nouveau ticket</h1>
                <p>Décrivez votre problème ou votre demande d'évolution.</p>
            </div>

            <div class="card">
                <form action="tickets.php" method="POST">
                    
                    <div class="d-flex gap-1 mb-1 mobile-col">
                        <div class="form-group flex-1">
                            <label for="project">Projet concerné *</label>
                            <select id="project" name="projet" required>
                                <option value="" disabled selected>Choisir un projet...</option>
                                <option value="Site Vitrine">Site Vitrine (Acme Corp)</option>
                                <option value="Intranet RH">Intranet RH (Globex)</option>
                                <option value="App Mobile">App Mobile (Wayne Ent)</option>
                            </select>
                        </div>

                        <div class="form-group flex-1">
                            <label for="priority">Priorité</label>
                            <select id="priority" name="priorite">
                                <option value="Basse">🟢 Basse</option>
                                <option value="Moyenne" selected>🟡 Normale</option>
                                <option value="Haute">🔴 Haute</option>
                                <option value="Critique">🔥 Critique</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Sujet de la demande *</label>
                        <input type="text" id="title" name="titre" placeholder="Ex: Erreur lors de l'upload de fichiers..." required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description détaillée *</label>
                        <textarea id="description" name="description" rows="6" placeholder="Expliquez le contexte, les étapes pour reproduire le bug..." required></textarea>
                        <p class="form-text">Soyez le plus précis possible pour accélérer le traitement.</p>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de demande</label>
                        <select id="type" name="type">
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

<?php include 'footer.php'; ?>