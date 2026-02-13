<?php 
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

// On récupère les vrais chiffres de la BDD
$nbTickets = $pdo->query("SELECT COUNT(*) FROM tickets")->fetchColumn();
$nbProjets = $pdo->query("SELECT COUNT(*) FROM projects WHERE statut = 'Actif'")->fetchColumn();
$nbUrgences = $pdo->query("SELECT COUNT(*) FROM tickets WHERE priorite = 'Haute' OR priorite = 'Critique'")->fetchColumn();

$prenomUser = $_SESSION['user']['prenom'];
$pageTitle = "Tableau de bord - Ticketing App";
include 'header.php'; 
?>

<body>
<button id="mobile-menu-btn" class="menu-btn"><span>&#8942;</span></button>

<div class="app-layout">
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php" class="active">📊 Tableau de bord</a></li>
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php?logout=true" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="page-header">
            <h1>Bonjour, <a href="profile.php" style="text-decoration: underline; text-decoration-color: #ccc;"><?php echo htmlspecialchars($prenomUser); ?></a> 👋</h1>
            <p>Voici un aperçu de l'activité.</p>
        </header>

        <section class="d-flex gap-1">
            <div class="stat-card">
                <h2>Tickets Totaux</h2>
                <p class="stat-value text-primary"><?php echo $nbTickets; ?></p>
            </div>

            <div class="stat-card">
                <h2>Urgences</h2>
                <p class="stat-value text-warning"><?php echo $nbUrgences; ?></p>
            </div>

            <div class="stat-card">
                <h2>Projets actifs</h2>
                <p class="stat-value text-success"><?php echo $nbProjets; ?></p>
            </div>
        </section>
    </main>
</div>
<?php include 'footer.php'; ?>