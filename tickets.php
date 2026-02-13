<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Liste des tickets - Ticketing App"; 
require_once 'db.php';

// 1. TRAITEMENT DE LA CRÉATION DE TICKET (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titre'])) {
    // Requête préparée pour l'insertion
    $stmt = $pdo->prepare("INSERT INTO tickets (projet_id, auteur_id, titre, description, priorite, type) VALUES (?, ?, ?, ?, ?, ?)");
    // On met l'ID 1 pour l'auteur (l'admin créé dans le SQL par défaut)
    $stmt->execute([$_POST['projet_id'], 1, $_POST['titre'], $_POST['description'], $_POST['priorite'], $_POST['type']]);
    
    $messageSucces = "Ticket enregistré en base de données !";
}

// 2. RECUPERATION DES TICKETS (Avec le nom du projet et de l'auteur)
$sql = "
    SELECT t.*, p.nom AS projet_nom, CONCAT(u.prenom, ' ', u.nom) AS auteur 
    FROM tickets t 
    JOIN projects p ON t.projet_id = p.id 
    JOIN users u ON t.auteur_id = u.id 
    ORDER BY t.date_creation DESC
";
$tickets = $pdo->query($sql)->fetchAll();

include 'header.php'; 
?>

<body>
<button id="mobile-menu-btn" class="menu-btn"><span>&#8942;</span></button>

<div class="app-layout">
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php">📊 Tableau de bord</a></li>
            <li><a href="projects.php">📁 Projets</a></li>
            <li><a href="tickets.php" class="active">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php?logout=true" class="btn-logout">🚪 Déconnexion</a></li>
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

        <div class="table-container">
            <table class="w-100">
                <thead>
                    <tr><th>ID</th><th>Sujet</th><th>Auteur</th><th>Statut</th><th>Priorité</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket) : 
                        $statusClass = 'badge-gray';
                        if ($ticket['statut'] === 'Nouveau') $statusClass = 'badge-blue';
                        if ($ticket['statut'] === 'En cours') $statusClass = 'badge-yellow';
                        if ($ticket['statut'] === 'Terminé') $statusClass = 'badge-green';

                        $priorityClass = 'badge-gray';
                        if ($ticket['priorite'] === 'Haute' || $ticket['priorite'] === 'Critique') $priorityClass = 'badge-red';
                        if ($ticket['priorite'] === 'Moyenne') $priorityClass = 'badge-yellow';
                    ?>
                    <tr>
                        <td data-label="ID">#<?php echo htmlspecialchars($ticket['id']); ?></td>
                        <td data-label="Sujet">
                            <strong><?php echo htmlspecialchars($ticket['titre']); ?></strong><br>
                            <span class="badge <?php echo ($ticket['type'] === 'facturable') ? 'badge-red' : 'badge-gray'; ?>"><?php echo htmlspecialchars($ticket['type']); ?></span>
                        </td>
                        <td data-label="Auteur"><?php echo htmlspecialchars($ticket['auteur']); ?></td>
                        <td data-label="Statut"><span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($ticket['statut']); ?></span></td>
                        <td data-label="Priorité"><span class="badge <?php echo $priorityClass; ?>"><?php echo htmlspecialchars($ticket['priorite']); ?></span></td>
                        <td data-label="Actions"><a href="ticket-detail.php?id=<?php echo $ticket['id']; ?>" class="btn btn-sm btn-light">Voir</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div> 
<?php include 'footer.php'; ?>