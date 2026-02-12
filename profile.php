<?php 
session_start();

// SÉCURITÉ
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// TRAITEMENT : Mise à jour du profil
$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On met à jour la session avec les nouvelles infos
    $_SESSION['user']['prenom'] = $_POST['prenom'];
    $_SESSION['user']['nom'] = $_POST['nom'];
    $_SESSION['user']['email'] = $_POST['email'];
    
    $message = "Profil mis à jour avec succès !";
}

// Données actuelles
$user = $_SESSION['user'];

$pageTitle = "Mon Profil - Ticketing App"; 
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
            <li><a href="tickets.php">🎫 Tickets</a></li>
            
            <li><a href="profile.php" class="active">👤 Mon Profil</a></li>
            <li><a href="settings.php">⚙️ Paramètres</a></li>

            <li><a href="index.php?logout=true" class="btn-logout">🚪 Déconnexion</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="container-narrow">
            
            <header class="page-header-simple">
                <h1>Mon Profil</h1>
                <p class="text-muted">Gérez vos informations personnelles.</p>
            </header>

            <?php if ($message): ?>
                <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="card d-flex align-center gap-1 mobile-col">
                <div class="avatar avatar-blue" style="width: 80px; height: 80px; font-size: 2rem;">
                    <?php echo substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1); ?>
                </div>
                <div>
                    <h2 class="card-title-simple" style="margin-bottom: 0;">
                        <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?>
                    </h2>
                    <p class="text-muted"><?php echo htmlspecialchars($user['role']); ?></p>
                </div>
            </div>

            <div class="card">
                <h2 class="form-section-title">Informations de contact</h2>
                <form method="POST">
                    <div class="d-flex gap-1 mobile-col">
                        <div class="form-group flex-1">
                            <label>Prénom</label>
                            <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required>
                        </div>
                        <div class="form-group flex-1">
                            <label>Nom</label>
                            <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2 class="form-section-title">Sécurité</h2>
                <form>
                    <div class="form-group">
                        <label>Mot de passe actuel</label>
                        <input type="password">
                    </div>
                    <div class="d-flex gap-1 mobile-col">
                        <div class="form-group flex-1">
                            <label>Nouveau mot de passe</label>
                            <input type="password">
                        </div>
                        <div class="form-group flex-1">
                            <label>Confirmer nouveau</label>
                            <input type="password">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-light">Changer le mot de passe</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
<?php include 'footer.php'; ?>