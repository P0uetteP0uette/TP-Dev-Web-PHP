<?php 
session_start();

// SÉCURITÉ : Si l'utilisateur n'est pas connecté, on le renvoie au login
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$pageTitle = "Tableau de bord - Ticketing App"; 

// DONNÉES SIMULÉES (Pour les stats)
$tickets = [
    ["statut" => "En cours", "priorite" => "Haute"],
    ["statut" => "Terminé", "priorite" => "Basse"],
    ["statut" => "Nouveau", "priorite" => "Critique"],
    ["statut" => "En attente", "priorite" => "Moyenne"],
    ["statut" => "En cours", "priorite" => "Moyenne"]
];

$projects = [
    ["statut" => "Actif"],
    ["statut" => "Actif"],
    ["statut" => "Épuisé"],
    ["statut" => "Actif"]
];

// CALCULS
$nbTicketsTotal = count($tickets);
$nbProjetsTotal = count($projects);
$nbUrgences = 0;
foreach ($tickets as $t) {
    if ($t['priorite'] === 'Haute' || $t['priorite'] === 'Critique') $nbUrgences++;
}

// Récupération du prénom depuis la session
$prenomUser = $_SESSION['user']['prenom'];

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
                <p class="stat-value text-primary"><?php echo $nbTicketsTotal; ?></p>
            </div>

            <div class="stat-card">
                <h2>Urgences</h2>
                <p class="stat-value text-warning"><?php echo $nbUrgences; ?></p>
            </div>

            <div class="stat-card">
                <h2>Projets actifs</h2>
                <p class="stat-value text-success"><?php echo $nbProjetsTotal; ?></p>
            </div>
        </section>
        
        </main>
<?php include 'footer.php'; ?>