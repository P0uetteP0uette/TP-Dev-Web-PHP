<?php 
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Mes Projets - Ticketing App"; 
require_once 'db.php';

// 1. TRAITEMENT DE LA CRÉATION DE PROJET (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nom']) && !empty($_POST['client_id'])) {
    // Étape A : Créer le contrat
    $stmtContrat = $pdo->prepare("INSERT INTO contrats (client_id, nom_contrat, heures_incluses, taux_horaire) VALUES (?, ?, ?, ?)");
    $nomContrat = "Contrat " . $_POST['nom'];
    $stmtContrat->execute([$_POST['client_id'], $nomContrat, $_POST['heures'], $_POST['taux']]);
    
    // On récupère l'ID du contrat qu'on vient de créer
    $contrat_id = $pdo->lastInsertId();

    // Étape B : Créer le projet lié à ce contrat
    $stmtProjet = $pdo->prepare("INSERT INTO projects (contrat_id, nom, description) VALUES (?, ?, ?)");
    $stmtProjet->execute([$contrat_id, $_POST['nom'], $_POST['description']]);

    $messageSucces = "Le projet a été créé et enregistré dans la base de données !";
}

// 2. RECUPERATION DES PROJETS DEPUIS LA BDD
$sql = "
    SELECT p.id, p.nom, p.description, p.statut, c.nom_entreprise AS client, ctr.heures_incluses AS heures_total,
           COALESCE(SUM(tp.duree_heures), 0) AS heures_utilisees
    FROM projects p
    JOIN contrats ctr ON p.contrat_id = ctr.id
    JOIN clients c ON ctr.client_id = c.id
    LEFT JOIN tickets t ON t.projet_id = p.id
    LEFT JOIN temps_passe tp ON tp.ticket_id = t.id
    GROUP BY p.id
    ORDER BY p.id DESC
";
$projects = $pdo->query($sql)->fetchAll();

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
                        $percent = ($projet['heures_total'] > 0) ? ($projet['heures_utilisees'] / $projet['heures_total']) * 100 : 0;
                        $barColor = 'bg-green';
                        if ($percent > 70) $barColor = 'bg-orange';
                        if ($percent >= 100) $barColor = 'bg-red';
                        $badgeClass = ($projet['statut'] === 'Actif') ? 'badge-green' : 'badge-red';
                    ?>
                    <tr>
                        <td data-label="Nom du Projet">
                            <strong><?php echo htmlspecialchars($projet['nom']); ?></strong><br>
                            <small class="text-muted"><?php echo htmlspecialchars($projet['description']); ?></small>
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
                        <td data-label="Statut"><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($projet['statut']); ?></span></td>
                        <td data-label="Actions"><a href="project-detail.php?id=<?php echo $projet['id']; ?>" class="btn btn-sm btn-light">Détails</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>