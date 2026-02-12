<?php $pageTitle = "Détail Ticket - Ticketing App"; include 'header.php'; ?>

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
        
        <div class="page-header-simple">
            <a href="tickets.html" class="link-back">← Retour à la liste</a>
            <div class="header-flex mt-1">
                <h1>#1039 - Ajout module export PDF</h1>
                <span class="badge badge-red">Facturable</span>
            </div>
        </div>

        <div class="grid-2-1">
            
            <section class="col-main">
                
                <div class="card">
                    <h2>Description de la demande</h2>
                    <div class="ticket-description">
                        <p>Bonjour,</p>
                        <p>Nous aurions besoin d'un bouton sur la page "Commandes" pour télécharger la facture au format PDF. Le PDF doit contenir notre logo et le récapitulatif de la TVA.</p>
                        <p>Cordialement,<br>Jean Dupont.</p>
                    </div>
                </div>

                <div class="card">
                    <h2>Historique des échanges</h2>
                    
                    <div class="message">
                        <span class="message-meta">Jean Dupont (Client) - 27 Janv. 10:00</span>
                        <p>Avez-vous pu estimer le temps nécessaire ?</p>
                    </div>

                    <div class="message message-support">
                        <span class="message-meta">Admin (Support) - 27 Janv. 14:30</span>
                        <p>Oui, nous estimons cela à 4h de développement. Comme votre forfait est épuisé, ce ticket passe en "Facturable". Merci de valider ci-contre.</p>
                    </div>

                    <div class="comment-area mt-1">
                        <textarea rows="3" placeholder="Écrire un message..."></textarea>
                        <button class="btn btn-sm mt-1">Envoyer</button>
                    </div>
                </div>
            </section>

            <aside class="col-sidebar">
                
                <div class="card card-alert-orange">
                    <h2>⚠️ Action requise</h2>
                    <p class="mb-1">Ce ticket est hors forfait. Veuillez valider le devis de 4h.</p>
                    <button class="btn bg-green mb-1 w-100">✅ Accepter le devis</button>
                    <button class="btn bg-red w-100">Refuser</button>
                </div>

                <div class="card">
                    <h2>Informations</h2>
                    <ul class="info-list">
                        <li><strong>Statut</strong> <span class="badge badge-yellow">En attente</span></li>
                        <li><strong>Priorité</strong> <span>Haute 🔴</span></li>
                        <li><strong>Client</strong> <span>Acme Corp</span></li>
                        <li><strong>Projet</strong> <span>Site Vitrine</span></li>
                        <li><strong>Créé le</strong> <span>26 Janv. 2026</span></li>
                    </ul>
                </div>

                <div class="card">
                    <h2>Suivi du temps</h2>
                    <ul class="info-list">
                        <li><strong>Estimé</strong> <span>4h 00</span></li>
                        <li><strong>Réel passé</strong> <span>0h 00</span></li>
                        <li><strong>Reste à faire</strong> <span>4h 00</span></li>
                    </ul>
                    <div class="progress-container mt-1">
                        <div class="progress-bar" style="width: 0%;"></div>
                    </div>
                </div>

            </aside>

        </div>

    </main>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>