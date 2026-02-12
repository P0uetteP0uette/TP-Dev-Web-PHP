<?php 
$pageTitle = "Détail Projet - Ticketing App"; 

// 1. MOCKUP DONNÉES (On remet les mêmes données que dans la liste pour simuler la BDD)
$projects = [
    [
        "id" => 1,
        "nom" => "Site Vitrine 2026",
        "description" => "Refonte complète du site corporate.",
        "client" => "Acme Corp",
        "heures_total" => 50,
        "heures_utilisees" => 12,
        "taux" => 80,
        "statut" => "Actif",
        "equipe" => ["Alice L.", "Jean P."]
    ],
    [
        "id" => 2,
        "nom" => "Intranet RH",
        "description" => "Maintenance évolutive du portail employés.",
        "client" => "Globex",
        "heures_total" => 100,
        "heures_utilisees" => 85,
        "taux" => 90,
        "statut" => "Actif",
        "equipe" => ["Sophie M.", "Marc D."]
    ],
    [
        "id" => 3,
        "nom" => "Campagne Marketing Q1",
        "description" => "Landing pages promotionnelles.",
        "client" => "Wayne Ent.",
        "heures_total" => 20,
        "heures_utilisees" => 22,
        "taux" => 100,
        "statut" => "Épuisé",
        "equipe" => ["Batman"]
    ]
];

// 2. RECUPERATION DE L'ID VIA L'URL (Ex: project-detail.php?id=1)
// Si pas d'ID, on met 1 par défaut
$project_id = $_GET['id'] ?? 1;
$project = null;

// On cherche le projet correspondant dans le tableau
foreach ($projects as $p) {
    if ($p['id'] == $project_id) {
        $project = $p;
        break;
    }
}

// Si on ne trouve pas le projet (ex: id=999), on redirige ou on affiche une erreur
if (!$project) {
    echo "Projet introuvable.";
    exit;
}

// 3. CALCULS
$percent = ($project['heures_total'] > 0) ? ($project['heures_utilisees'] / $project['heures_total']) * 100 : 0;
$heures_restantes = $project['heures_total'] - $project['heures_utilisees'];
$hors_forfait = ($heures_restantes < 0) ? abs($heures_restantes) : 0; // Si négatif, c'est du hors forfait

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
            <li><a href="projects.php" class="active">📁 Projets</a></li>
            <li><a href="tickets.php">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <div class="page-header-simple">
            <a href="projects.php" class="link-back">← Retour aux projets</a>
            
            <div class="header-flex mt-1">
                <div>
                    <h1><?php echo htmlspecialchars($project['nom']); ?></h1>
                    <p class="text-muted">Client : <strong><?php echo htmlspecialchars($project['client']); ?></strong> • <?php echo htmlspecialchars($project['description']); ?></p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-sm btn-outline">⚙️ Configurer</button>
                    <a href="ticket-create.php" class="btn btn-sm">➕ Nouveau Ticket</a>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            
            <div class="card">
                <h2 class="card-title-simple">Consommation Heures</h2>
                
                <div class="stat-value">
                    <?php echo $project['heures_utilisees']; ?>h <span class="stat-sub">/ <?php echo $project['heures_total']; ?>h</span>
                </div>
                
                <div class="progress-container">
                    <div class="progress-bar <?php echo ($percent > 100) ? 'bg-red' : 'bg-green'; ?>" style="width: <?php echo min($percent, 100); ?>%;"></div>
                </div>
                
                <p class="stat-label">
                    <?php if ($heures_restantes >= 0): ?>
                        Il reste <strong><?php echo $heures_restantes; ?>h</strong> dans le forfait.
                    <?php else: ?>
                        <span class="text-danger">Forfait dépassé de <?php echo abs($heures_restantes); ?>h !</span>
                    <?php endif; ?>
                </p>
            </div>

            <div class="card">
                <h2 class="card-title-simple">Hors Forfait (Facturable)</h2>
                <div class="stat-value text-warning"><?php echo $hors_forfait; ?>h</div>
                <p class="stat-label">Tickets validés en supplément.</p>
                <small class="text-muted">Taux horaire : <?php echo $project['taux']; ?>€ / h</small>
            </div>

            <div class="card">
                <h2 class="card-title-simple">Collaborateurs</h2>
                
                <div class="avatar-group mt-1">
                    <?php foreach($project['equipe'] as $membre): ?>
                        <div class="avatar avatar-blue" title="<?php echo $membre; ?>">
                            <?php echo substr($membre, 0, 2); ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="avatar avatar-add">+</div>
                </div>
                
                <p class="stat-label mt-1"><?php echo implode(', ', $project['equipe']); ?></p>
            </div>

        </div>

        <div class="card card-no-padding">
            <div class="card-header-border">
                <h2>Derniers tickets du projet</h2>
            </div>
            
            <div class="table-container">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sujet</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="ID">#1042</td>
                            <td data-label="Sujet"><strong>Bug affichage menu</strong></td>
                            <td data-label="Statut"><span class="badge badge-yellow">En cours</span></td>
                            <td data-label="Actions"><a href="ticket-detail.html" class="btn btn-sm btn-light">Voir</a></td>
                        </tr>
                        <tr>
                            <td data-label="ID">#1039</td>
                            <td data-label="Sujet"><strong>Module Export PDF</strong></td>
                            <td data-label="Statut"><span class="badge badge-blue">Nouveau</span></td>
                            <td data-label="Actions"><a href="ticket-detail.html" class="btn btn-sm btn-light">Voir</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
<?php include 'footer.php'; ?>