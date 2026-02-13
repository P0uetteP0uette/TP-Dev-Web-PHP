<?php 
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.php'); exit; }

$pageTitle = "Créer un Ticket - Ticketing App"; 
require_once 'db.php';

// Récupérer les vrais projets de la BDD
$stmt = $pdo->query("SELECT id, nom FROM projects ORDER BY nom ASC");
$projets = $stmt->fetchAll();

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
        <div class="container-narrow">
            <div class="page-header-simple">
                <a href="tickets.php" class="link-back">← Annuler et retour</a>
                <h1>Ouvrir un nouveau ticket</h1>
            </div>

            <div class="card">
                <form action="tickets.php" method="POST">
                    <div class="d-flex gap-1 mb-1 mobile-col">
                        <div class="form-group flex-1">
                            <label for="project">Projet concerné *</label>
                            <select id="project" name="projet_id" required>
                                <option value="" disabled selected>Choisir un projet...</option>
                                <?php foreach($projets as $p): ?>
                                    <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group flex-1">
                            <label for="priority">Priorité</label>
                            <select id="priority" name="priorite">
                                <option value="Basse">🟢 Basse</option>
                                <option value="Moyenne" selected>🟡 Normale</option>
                                <option value="Haute">🔴 Haute</option>
                                <option value="Critique">🔥 Critique</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Sujet de la demande *</label>
                        <input type="text" id="title" name="titre" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description détaillée *</label>
                        <textarea id="description" name="description" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de demande</label>
                        <select id="type" name="type">
                            <option value="inclus">Correction de Bug (Inclus)</option>
                            <option value="facturable">Nouvelle fonctionnalité (Facturable)</option>
                        </select>
                    </div>

                    <div class="text-right mt-2">
                        <button type="submit" class="btn btn-wide">Créer le ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<?php include 'footer.php'; ?>