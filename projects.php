<?php $pageTitle = "Mes Projets - Ticketing App"; include 'header.php'; ?>

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
        
        <header class="header-flex mb-2">
            <div>
                <h1>Liste des Projets</h1>
                <p class="text-muted">Suivi des contrats et des enveloppes d'heures.</p>
            </div>
            <a href="project-create.html" class="btn btn-sm btn-create">➕ Nouveau Projet</a>
        </header>

        <div class="d-flex gap-1 mb-1" style="flex-wrap: wrap;">
            <button class="btn btn-sm project-filter-btn active" data-filter="all" style="background:#64748b;">Tout voir</button>
            <button class="btn btn-sm project-filter-btn" data-filter="actif" style="background:#22c55e;">Actifs</button>
            <button class="btn btn-sm project-filter-btn" data-filter="epuise" style="background:#ef4444;">Épuisés</button>
        </div>

        <div class="table-container">
            <table class="w-100">
                <thead>
                    <tr>
                        <th>Nom du Projet</th>
                        <th>Client</th>
                        <th>Contrat (Heures)</th>
                        <th>Consommation</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-status="actif">
                        <td data-label="Nom du Projet">
                            <strong>Site Vitrine 2026</strong>
                            <br><small class="text-muted">Refonte complète</small>
                        </td>
                        <td data-label="Client">Acme Corp</td>
                        <td data-label="Contrat">50h / an</td>
                        <td data-label="Consommation" class="td-progress">
                            <div class="progress-info">
                                <strong>12h</strong> utilisées (24%)
                            </div>
                            <div class="progress-container sm">
                                <div class="progress-bar bg-green" style="width: 24%;"></div>
                            </div>
                        </td>
                        <td data-label="Statut"><span class="badge badge-green">Actif</span></td>
                        <td data-label="Actions">
                            <a href="project-detail.html" class="btn btn-sm btn-light">Détails</a>
                        </td>
                    </tr>

                    <tr data-status="actif">
                        <td data-label="Nom du Projet">
                            <strong>Intranet RH</strong>
                            <br><small class="text-muted">Maintenance évolutive</small>
                        </td>
                        <td data-label="Client">Globex</td>
                        <td data-label="Contrat">100h / an</td>
                        <td data-label="Consommation" class="td-progress">
                            <div class="progress-info">
                                <strong>85h</strong> utilisées (85%)
                            </div>
                            <div class="progress-container sm">
                                <div class="progress-bar bg-orange" style="width: 85%;"></div>
                            </div>
                        </td>
                        <td data-label="Statut"><span class="badge badge-yellow">Actif</span></td>
                        <td data-label="Actions">
                            <a href="project-detail.html" class="btn btn-sm btn-light">Détails</a>
                        </td>
                    </tr>

                    <tr data-status="epuise">
                        <td data-label="Nom du Projet">
                            <strong>Campagne Marketing Q1</strong>
                            <br><small class="text-muted">Landing pages</small>
                        </td>
                        <td data-label="Client">Wayne Ent.</td>
                        <td data-label="Contrat">20h / an</td>
                        <td data-label="Consommation" class="td-progress">
                            <div class="progress-info">
                                <strong>22h</strong> utilisées (110%)
                            </div>
                            <div class="progress-container sm">
                                <div class="progress-bar bg-red" style="width: 100%;"></div>
                            </div>
                        </td>
                        <td data-label="Statut"><span class="badge badge-red">Épuisé</span></td>
                        <td data-label="Actions">
                            <a href="project-detail.html" class="btn btn-sm btn-light">Détails</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
<?php include 'footer.php'; ?>