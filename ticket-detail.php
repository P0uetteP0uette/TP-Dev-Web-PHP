<?php 
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Détail Ticket - Ticketing App"; 
require_once 'db.php';

$ticket_id = $_GET['id'] ?? 0;

// Requête de sélection complète avec Jointures multiples
$stmt = $pdo->prepare("
    SELECT t.*, p.nom AS projet_nom, c.nom_entreprise AS client_nom, CONCAT(u.prenom, ' ', u.nom) AS auteur
    FROM tickets t
    JOIN projects p ON t.projet_id = p.id
    JOIN contrats ctr ON p.contrat_id = ctr.id
    JOIN clients c ON ctr.client_id = c.id
    JOIN users u ON t.auteur_id = u.id
    WHERE t.id = ?
");
$stmt->execute([$ticket_id]);
$ticket = $stmt->fetch();

if (!$ticket) { die("Ticket introuvable."); }

$est_facturable = ($ticket['type'] === 'facturable');

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
        <div class="page-header-simple">
            <a href="tickets.php" class="link-back">← Retour à la liste</a>
            <div class="header-flex mt-1">
                <h1>#<?php echo $ticket['id']; ?> - <?php echo htmlspecialchars($ticket['titre']); ?></h1>
                <?php if($est_facturable): ?>
                    <span class="badge badge-red">Facturable</span>
                <?php else: ?>
                    <span class="badge badge-gray">Inclus</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid-2-1">
            <section class="col-main">
                <div class="card">
                    <h2>Description de la demande</h2>
                    <div class="ticket-description">
                        <p><?php echo nl2br(htmlspecialchars($ticket['description'])); ?></p>
                    </div>
                </div>
            </section>

            <aside class="col-sidebar">
                <?php if ($est_facturable): ?>
                <div class="card card-alert-orange">
                    <h2>⚠️ Action requise</h2>
                    <p class="mb-1">Ce ticket est hors forfait. Veuillez valider le devis.</p>
                    <button class="btn bg-green mb-1 w-100">✅ Accepter le devis</button>
                </div>
                <?php endif; ?>

                <div class="card">
                    <h2>Informations</h2>
                    <ul class="info-list">
                        <li><strong>Statut</strong> <span class="badge badge-yellow"><?php echo htmlspecialchars($ticket['statut']); ?></span></li>
                        <li><strong>Priorité</strong> <span><?php echo htmlspecialchars($ticket['priorite']); ?></span></li>
                        <li><strong>Client</strong> <span><?php echo htmlspecialchars($ticket['client_nom']); ?></span></li>
                        <li><strong>Projet</strong> <span><?php echo htmlspecialchars($ticket['projet_nom']); ?></span></li>
                        <li><strong>Créé le</strong> <span><?php echo htmlspecialchars($ticket['date_creation']); ?></span></li>
                    </ul>
                </div>
            </aside>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>