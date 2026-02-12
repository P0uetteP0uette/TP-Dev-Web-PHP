<?php $pageTitle = "Liste des Tickets - Ticketing App"; include 'header.php'; ?>

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
        
        <header class="header-flex mb-2">
            <div>
                <h1>Liste des Tickets</h1>
                <p class="text-muted">Gérez les demandes et suivez l'avancement.</p>
            </div>
            <a href="ticket-create.html" class="btn btn-sm btn-create">➕ Nouveau Ticket</a>
        </header>

        <div class="d-flex gap-1 mb-1" style="flex-wrap: wrap;">
            <button class="btn btn-sm filter-btn active" data-filter="all" style="background:#64748b;">Tout voir</button>
            <button class="btn btn-sm filter-btn" data-filter="facturable" style="background:#ef4444;">Facturable</button>
            <button class="btn btn-sm filter-btn" data-filter="inclus" style="background:#64748b;">Inclus</button>
        </div>

        <div class="table-container">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sujet</th>
                        <th>Client / Projet</th>
                        <th>Statut</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ticketList">
                    <tr data-type="inclus">
                        <td data-label="ID">#1042</td>
                        <td data-label="Sujet">
                            <strong>Bug affichage menu mobile</strong>
                            <br><small class="text-muted">Le menu ne s'ouvre pas sur iPhone...</small>
                        </td>
                        <td data-label="Client / Projet">
                            Acme Corp
                            <br><small class="text-muted">Site Vitrine</small>
                        </td>
                        <td data-label="Statut"><span class="badge badge-yellow">En cours</span></td>
                        <td data-label="Type"><span class="badge badge-gray">Inclus</span></td>
                        <td data-label="Actions">
                            <a href="ticket-detail.html" class="btn btn-sm btn-light">Voir</a>
                        </td>
                    </tr>

                    <tr data-type="inclus">
                        <td data-label="ID">#1041</td>
                        <td data-label="Sujet">
                            <strong>Mise à jour texte RGPD</strong>
                            <br><small class="text-muted">Changement des mentions légales</small>
                        </td>
                        <td data-label="Client / Projet">
                            Globex
                            <br><small class="text-muted">Intranet RH</small>
                        </td>
                        <td data-label="Statut"><span class="badge badge-green">Terminé</span></td>
                        <td data-label="Type"><span class="badge badge-gray">Inclus</span></td>
                        <td data-label="Actions">
                            <a href="ticket-detail.html" class="btn btn-sm btn-light">Voir</a>
                        </td>
                    </tr>

                    <tr data-type="facturable">
                        <td data-label="ID">#1039</td>
                        <td data-label="Sujet">
                            <strong>Ajout module export PDF</strong>
                            <br><small class="text-muted">Nouvelle fonctionnalité demandée par...</small>
                        </td>
                        <td data-label="Client / Projet">
                            Acme Corp
                            <br><small class="text-muted">Site Vitrine</small>
                        </td>
                        <td data-label="Statut"><span class="badge badge-blue">Nouveau</span></td>
                        <td data-label="Type"><span class="badge badge-red">Facturable</span></td>
                        <td data-label="Actions">
                            <a href="ticket-detail.html" class="btn btn-sm btn-light">Voir</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
<?php include 'footer.php'; ?>