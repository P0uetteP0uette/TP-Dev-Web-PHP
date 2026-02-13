<?php 
require_once 'db.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    
    // On sécurise le mot de passe avant de l'envoyer en BDD !
    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // On insère l'utilisateur en BDD
    $stmt = $pdo->prepare("INSERT INTO users (prenom, nom, email, password) VALUES (?, ?, ?, ?)");
    
    try {
        $stmt->execute([$prenom, $nom, $email, $password_hash]);
        // Redirection vers l'accueil avec un message
        header('Location: index.php?message=Compte créé avec succès ! Connectez-vous.');
        exit;
    } catch (PDOException $e) {
        // Si l'email existe déjà dans la BDD (car on a mis UNIQUE sur l'email)
        $error = "Cet email est déjà utilisé !";
    }
}

$pageTitle = "Inscription - Ticketing App"; 
include 'header.php'; 
?>

<body>
    <div class="login-container">
        <div class="login-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: var(--primary-color); margin-bottom: 0.5rem;">Créer un compte</h1>
                <p class="text-muted">Rejoignez l'équipe pour gérer vos tickets.</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger" style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="d-flex gap-1 mobile-col">
                    <div class="form-group flex-1">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group flex-1">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email professionnel</label>
                    <input type="email" id="email" name="email" placeholder="nom@entreprise.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn mb-1">S'inscrire</button>
                
                <div style="text-align: center; font-size: 0.9rem;">
                    Déjà un compte ? <a href="index.php" class="text-primary" style="font-weight: bold;">Se connecter</a>
                </div>
            </form>
        </div>
<?php include 'footer.php'; ?>