<?php 
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Détail Ticket - Ticketing App"; 
require_once 'db.php';

$ticket_id = $_GET['id'] ?? 0;

// 1. TRAITEMENT DU FORMULAIRE : AJOUT DE TEMPS
$messageTemps = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['duree'])) {
    $duree = floatval($_POST['duree']); // On s'assure que c'est bien un nombre décimal (ex: 1.5)
    
    if ($duree > 0) {
        // On enregistre le temps passé dans la table temps_passe
        $stmtTemps = $pdo->prepare("INSERT INTO temps_passe (ticket_id, user_id, duree_heures) VALUES (?, ?, ?)");
        $stmtTemps->execute([$ticket_id, $_SESSION['user']['id'], $duree]);
        $messageTemps = "Temps ajouté avec succès !";
    }
}

// 2. RECUPERATION DU TICKET ET DU TEMPS TOTAL DE CE TICKET
// On ajoute une sous-requête pour calculer automatiquement la somme des heures de ce ticket
$stmt = $pdo->prepare("
    SELECT t.*, p.nom AS projet_nom, c.nom_entreprise AS client_nom, CONCAT(u.prenom, ' ', u.nom) AS auteur,
           (SELECT COALESCE(SUM(duree_heures), 0) FROM temps_passe WHERE ticket_id = t.id) AS temps_total_ticket
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
                        <li><strong>Créé le</strong> <span><?php echo date('d/m/Y', strtotime($ticket['date_creation'])); ?></span></li>
                    </ul>
                </div>

                <div class="card">
                    <h2>Suivi du temps</h2>
                    
                    <?php if ($messageTemps): ?>
                        <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9rem;">
                            <?php echo $messageTemps; ?>
                        </div>
                    <?php endif; ?>

                    <ul class="info-list">
                        <li><strong>Temps total passé</strong> <span class="text-primary" style="font-weight: bold; font-size: 1.1rem;"><?php echo $ticket['temps_total_ticket']; ?> h</span></li>
                    </ul>

                    <form action="ticket-detail.php?id=<?php echo $ticket['id']; ?>" method="POST" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                        <label for="duree" style="font-size: 0.85rem; font-weight: bold; display: block; margin-bottom: 5px;">Pointer des heures :</label>
                        <div class="d-flex gap-1">
                            <input type="number" step="0.5" min="0.5" id="duree" name="duree" placeholder="Ex: 1.5" required style="flex: 1; padding: 5px;">
                            <button type="submit" class="btn btn-sm">Ajouter</button>
                        </div>
                        <small class="text-muted" style="display: block; margin-top: 5px;">(Par tranches de 0.5h)</small>
                    </form>
                </div>

            </aside>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>