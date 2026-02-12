<?php $pageTitle = "Tableau de bord - Ticketing App"; include 'header.php'; ?>

<body>

<button id="mobile-menu-btn" class="menu-btn">
    <span>&#8942;</span>
</button>

<div class="app-layout">
    
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php" class="active">📊 Tableau de bord</a></li>
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php">🎫 Tickets</a></li>
            
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>

            <li><a href="index.php" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="page-header">
            <h1>Bonjour, <a href="profile.php" style="text-decoration: underline; text-decoration-color: #ccc;">Admin</a> 👋</h1>
            <p>Voici un aperçu de l'activité.</p>
        </header>

        <section class="d-flex gap-1">
            <div class="stat-card">
                <h2>Tickets en cours</h2>
                <p class="stat-value text-primary">12</p>
            </div>

            <div class="stat-card">
                <h2>Tickets à valider</h2>
                <p class="stat-value text-warning">3</p>
            </div>

            <div class="stat-card">
                <h2>Projets actifs</h2>
                <p class="stat-value text-success">5</p>
            </div>
        </section>

    </main>
<?php include 'footer.php'; ?>