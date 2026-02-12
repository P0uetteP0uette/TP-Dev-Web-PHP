<?php 
// TRAITEMENT INSCRIPTION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulation : Inscription réussie
    header('Location: index.php?message=Compte créé ! Connectez-vous.');
    exit;
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

                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn mb-1">S'inscrire</button>
                
                <div style="text-align: center; font-size: 0.9rem;">
                    Déjà un compte ? <a href="index.php" class="text-primary" style="font-weight: bold;">Se connecter</a>
                </div>
            </form>
        </div>
<?php include 'footer.php'; ?>