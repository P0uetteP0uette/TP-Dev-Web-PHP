<?php 
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Détail Projet - Ticketing App"; 
require_once 'db.php';

$project_id = $_GET['id'] ?? 0;

// On récupère le projet
$stmt = $pdo->prepare("
    SELECT p.*, c.nom_entreprise AS client, ctr.heures_incluses AS heures_total, ctr.taux_horaire AS taux,
           COALESCE(SUM(tp.duree_heures), 0) AS heures_utilisees
    FROM projects p
    JOIN contrats ctr ON p.contrat_id = ctr.id
    JOIN clients c ON ctr.client_id = c.id
    LEFT JOIN tickets t ON t.projet_id = p.id
    LEFT JOIN temps_passe tp ON tp.ticket_id = t.id
    WHERE p.id = ?
    GROUP BY p.id
");
$stmt->execute([$project_id]);
$project = $stmt->fetch();

if (!$project) { die("Projet introuvable dans la base de données."); }

// On récupère les tickets de ce projet
$stmtTickets = $pdo->prepare("SELECT id, titre, statut FROM tickets WHERE projet_id = ? ORDER BY id DESC");
$stmtTickets->execute([$project_id]);
$project_tickets = $stmtTickets->fetchAll();

$percent = ($project['heures_total'] > 0) ? ($project['heures_utilisees'] / $project['heures_total']) * 100 : 0;
$heures_restantes = $project['heures_total'] - $project['heures_utilisees'];
$hors_forfait = ($heures_restantes < 0) ? abs($heures_restantes) : 0;

include 'header.php'; 
?>

<body>
<button id="mobile-menu-btn" class="menu-btn"><span>&#8942;</span></button>

<div class="app-layout">
    <nav class="sidebar">
        <h2>Ticketing App</h2>
        <ul>
            <li><a href="dashboard.php">📊 Tableau de bord</a></li>
            <li><a href="projects.php" class="active">📁 Projets</a></li>
            <li><a href="tickets.php">🎫 Tickets</a></li>
            <li><a href="profile.php">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>
            <li><a href="index.php?logout=true" class="btn-logout">🚪 Déconnexion</a></li>
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
        </div>

        <div class="card card-no-padding">
            <div class="card-header-border"><h2>Derniers tickets du projet</h2></div>
            <div class="table-container">
                <table class="w-100">
                    <thead><tr><th>ID</th><th>Sujet</th><th>Statut</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php foreach($project_tickets as $pt): ?>
                        <tr>
                            <td>#<?php echo $pt['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($pt['titre']); ?></strong></td>
                            <td><span class="badge badge-gray"><?php echo htmlspecialchars($pt['statut']); ?></span></td>
                            <td><a href="ticket-detail.php?id=<?php echo $pt['id']; ?>" class="btn btn-sm btn-light">Voir</a></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($project_tickets)) echo "<tr><td colspan='4'>Aucun ticket pour ce projet.</td></tr>"; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>