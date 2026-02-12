<?php 
$pageTitle = "Mes Projets - Ticketing App"; 

// 1. MOCKUP DONNÉES (Base de données simulée)
$projects = [
    [
        "id" => 1,
        "nom" => "Site Vitrine 2026",
        "description" => "Refonte complète",
        "client" => "Acme Corp",
        "heures_total" => 50,
        "heures_utilisees" => 12,
        "statut" => "Actif"
    ],
    [
        "id" => 2,
        "nom" => "Intranet RH",
        "description" => "Maintenance évolutive",
        "client" => "Globex",
        "heures_total" => 100,
        "heures_utilisees" => 85,
        "statut" => "Actif"
    ],
    [
        "id" => 3,
        "nom" => "Campagne Marketing Q1",
        "description" => "Landing pages",
        "client" => "Wayne Ent.",
        "heures_total" => 20,
        "heures_utilisees" => 22,
        "statut" => "Épuisé"
    ]
];

// 2. TRAITEMENT DU FORMULAIRE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // On vérifie le champ obligatoire
    if (!empty($_POST['nom']) && !empty($_POST['client'])) {
        
        $nouveauProjet = [
            "id" => rand(100, 999),
            "nom" => $_POST['nom'],
            "description" => $_POST['description'] ?? "Aucune description", // ?? gère le cas si vide
            "client" => $_POST['client'],
            "heures_total" => intval($_POST['heures']), // intval assure que c'est un nombre
            "heures_utilisees" => 0, // Un nouveau projet commence à 0
            "statut" => "Actif"
        ];

        // On l'ajoute au début de la liste
        array_unshift($projects, $nouveauProjet);
        
        $messageSucces = "Projet créé avec succès !";
    }
}

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
        
        <header class="header-flex mb-2">
            <div>
                <h1>Liste des Projets</h1>
                <p class="text-muted">Suivi des contrats et des enveloppes d'heures.</p>
            </div>
            <a href="project-create.php" class="btn btn-sm btn-create">➕ Nouveau Projet</a>
        </header>

        <?php if (isset($messageSucces)): ?>
            <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $messageSucces; ?>
            </div>
        <?php endif; ?>

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
                    <?php foreach ($projects as $projet) : 
                        
                        // Calcul du pourcentage pour la barre de progression
                        $percent = 0;
                        if ($projet['heures_total'] > 0) {
                            $percent = ($projet['heures_utilisees'] / $projet['heures_total']) * 100;
                        }
                        
                        // Couleur de la barre selon le pourcentage
                        $barColor = 'bg-green';
                        if ($percent > 70) $barColor = 'bg-orange';
                        if ($percent >= 100) $barColor = 'bg-red';

                        // Badge statut
                        $badgeClass = ($projet['statut'] === 'Actif') ? 'badge-green' : 'badge-red';
                        if ($projet['statut'] === 'En pause') $badgeClass = 'badge-yellow';
                    ?>
                    
                    <tr data-status="<?php echo strtolower($projet['statut']); ?>">
                        <td data-label="Nom du Projet">
                            <strong><?php echo htmlspecialchars($projet['nom']); ?></strong>
                            <br><small class="text-muted"><?php echo htmlspecialchars($projet['description']); ?></small>
                        </td>
                        
                        <td data-label="Client"><?php echo htmlspecialchars($projet['client']); ?></td>
                        
                        <td data-label="Contrat"><?php echo htmlspecialchars($projet['heures_total']); ?>h / an</td>
                        
                        <td data-label="Consommation" class="td-progress">
                            <div class="progress-info">
                                <strong><?php echo $projet['heures_utilisees']; ?>h</strong> utilisées (<?php echo round($percent); ?>%)
                            </div>
                            <div class="progress-container sm">
                                <div class="progress-bar <?php echo $barColor; ?>" style="width: <?php echo min($percent, 100); ?>%;"></div>
                            </div>
                        </td>
                        
                        <td data-label="Statut">
                            <span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($projet['statut']); ?></span>
                        </td>
                        
                        <td data-label="Actions">
                            <a href="project-detail.php?id=<?php echo $projet['id']; ?>" class="btn btn-sm btn-light">Détails</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </main>
<?php include 'footer.php'; ?>