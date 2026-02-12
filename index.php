<?php 
// On démarre la session au tout début
session_start();

// GESTION DE LA DÉCONNEXION
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    $message = "Vous avez été déconnecté.";
}

// TRAITEMENT DU FORMULAIRE DE CONNEXION
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simulation d'une vérification en base de données
    // Login: admin@ticketing.app / Mot de passe: secret
    if ($email === "admin@ticketing.app" && $password === "secret") {
        
        // Connexion réussie : On enregistre l'utilisateur en session
        $_SESSION['user'] = [
            'prenom' => 'Admin',
            'nom' => 'User',
            'email' => $email,
            'role' => 'Administrateur'
        ];

        // Redirection vers le tableau de bord
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Identifiants incorrects. (Essayez : admin@ticketing.app / secret)";
    }
}

$pageTitle = "Connexion - Ticketing App"; 
include 'header.php'; 
?>

<body>
    <div class="login-container">
        <div class="login-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: var(--primary-color); margin-bottom: 0.5rem;">Connexion</h1>
                <p class="text-muted">Accédez à votre espace de gestion.</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger" style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($message)): ?>
                <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="admin@ticketing.app" value="admin@ticketing.app" required>
                </div>
                <div class="form-group">
                    <div class="d-flex" style="justify-content: space-between; align-items: center;">
                        <label for="password" style="margin:0;">Mot de passe</label>
                        <a href="forgot-password.php" style="font-size: 0.85rem; color: var(--primary-color);">Mot de passe oublié ?</a>
                    </div>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn mb-1">Se connecter</button>

                <div style="text-align: center; font-size: 0.9rem;">
                    Pas encore de compte ? <a href="register.php" class="text-primary" style="font-weight: bold;">S'inscrire</a>
                </div>
            </form>
        </div>
<?php include 'footer.php'; ?>