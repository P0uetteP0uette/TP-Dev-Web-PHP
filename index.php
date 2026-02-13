<?php 
session_start();
require_once 'db.php'; // On se connecte à la BDD

// GESTION DE LA DÉCONNEXION
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    $message = "Vous avez été déconnecté.";
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. On cherche l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 2. On vérifie le mot de passe (soit haché, soit 'secret' pour notre admin de test)
    if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
        
        // Connexion réussie : on sauvegarde dans la session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'prenom' => $user['prenom'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
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
                <div class="alert alert-danger" style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if (isset($message) || isset($_GET['message'])): ?>
                <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : $message; ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="admin@ticketing.app" required>
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