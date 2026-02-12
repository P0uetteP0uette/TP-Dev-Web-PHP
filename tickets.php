<?php
$pageTitle = "Liste des tickets - Ticketing App"; 

// 1. Simulation de la base de données (Tableau de tableaux)
$tickets = [
    [
        "id" => 1,
        "titre" => "Problème d'imprimante",
        "description" => "L'imprimante du 2ème étage ne répond plus.",
        "auteur" => "Jean Admin",
        "statut" => "En cours",
        "priorite" => "Haute"
    ],
    [
        "id" => 2,
        "titre" => "Erreur 404",
        "description" => "Page introuvable sur le site client.",
        "auteur" => "Sophie Dev",
        "statut" => "Terminé",
        "priorite" => "Basse"
    ],
    [
        "id" => 3,
        "titre" => "Ecran bleu",
        "description" => "Mon PC plante au démarrage.",
        "auteur" => "Marc Compta",
        "statut" => "Nouveau",
        "priorite" => "Moyenne"
    ]
];

// 2. TRAITEMENT DU FORMULAIRE (Le Back-end)
// On vérifie si la page a été appelée via la méthode POST (donc via le bouton "Créer")
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // On vérifie que les champs obligatoires sont bien remplis
    if (!empty($_POST['titre']) && !empty($_POST['description'])) {
        
        // On crée le nouveau ticket avec les données reçues du formulaire
        $nouveauTicket = [
            "id" => rand(100, 999), // On génère un ID au hasard
            "titre" => $_POST['titre'], // Vient du champ name="titre"
            "description" => $_POST['description'], // Vient du champ name="description"
            "auteur" => "Moi (Utilisateur)", // Simulé pour l'instant
            "statut" => "Nouveau", // Par défaut
            "priorite" => $_POST['priorite'] // Vient du select name="priorite"
        ];

        // On ajoute ce ticket au début du tableau $tickets
        // (array_unshift ajoute au début, array_push ajoute à la fin)
        array_unshift($tickets, $nouveauTicket);
        
        // Petit message de succès (optionnel)
        $messageSucces = "Ticket créé avec succès !";
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
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php" class="active">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        
        <header class="header-flex mb-2">
            <div>
                <h1>Liste des Tickets</h1>
                <p class="text-muted">Gérez les demandes et suivez l'avancement.</p>
            </div>
            <a href="ticket-create.php" class="btn btn-sm btn-create">➕ Nouveau Ticket</a>
        </header>

        <?php if (isset($messageSucces)): ?>
            <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $messageSucces; ?>
            </div>
        <?php endif; ?>

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
                        <th>Auteur</th> 
                        <th>Statut</th>
                        <th>Priorité</th> 
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ticketList">
                    <?php foreach ($tickets as $ticket) : 
                        // Petite logique pour les couleurs des badges
                        $statusClass = 'badge-gray';
                        if ($ticket['statut'] === 'Nouveau') $statusClass = 'badge-blue';
                        if ($ticket['statut'] === 'En cours') $statusClass = 'badge-yellow';
                        if ($ticket['statut'] === 'Terminé') $statusClass = 'badge-green';

                        $priorityClass = 'badge-gray';
                        if ($ticket['priorite'] === 'Haute') $priorityClass = 'badge-red';
                        if ($ticket['priorite'] === 'Moyenne') $priorityClass = 'badge-yellow';
                        if ($ticket['priorite'] === 'Critique') $priorityClass = 'badge-red'; // Ajout pour le formulaire
                        if ($ticket['priorite'] === 'Basse') $priorityClass = 'badge-green'; // Ajout pour le formulaire
                    ?>
                    <tr>
                        <td data-label="ID">#<?php echo htmlspecialchars($ticket['id']); ?></td>
                        
                        <td data-label="Sujet">
                            <strong><?php echo htmlspecialchars($ticket['titre']); ?></strong>
                            <br><small class="text-muted"><?php echo htmlspecialchars($ticket['description']); ?></small>
                        </td>
                        
                        <td data-label="Auteur">
                            <?php echo htmlspecialchars($ticket['auteur']); ?>
                        </td>
                        
                        <td data-label="Statut">
                            <span class="badge <?php echo $statusClass; ?>">
                                <?php echo htmlspecialchars($ticket['statut']); ?>
                            </span>
                        </td>
                        
                        <td data-label="Priorité">
                            <span class="badge <?php echo $priorityClass; ?>">
                                <?php echo htmlspecialchars($ticket['priorite']); ?>
                            </span>
                        </td>
                        
                        <td data-label="Actions">
                            <a href="ticket-detail.php?id=<?php echo $ticket['id']; ?>" class="btn btn-sm btn-light">Voir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div> 

<?php include 'footer.php'; ?>