<?php 
// TRAITEMENT
$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sent = true; // On affiche juste un message de confirmation
}

$pageTitle = "Mot de passe oublié - Ticketing App"; 
include 'header.php'; 
?>

<body>

    <div class="login-container">
        <div class="login-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="margin-bottom: 0.5rem;">Mot de passe oublié ?</h1>
                <p class="text-muted">Entrez votre email, nous vous enverrons un lien de réinitialisation.</p>
            </div>

            <?php if ($sent): ?>
                <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                    Un email de réinitialisation a été envoyé !
                </div>
            <?php else: ?>

            <form action="forgot-password.php" method="POST"> 
                <div class="form-group">
                    <label for="email">Email associé au compte</label>
                    <input type="email" id="email" name="email" placeholder="nom@entreprise.com" required>
                </div>

                <button type="submit" class="btn mb-1">Envoyer le lien</button>
            </form>
            
            <?php endif; ?>

            <div style="text-align: center; font-size: 0.9rem; margin-top: 10px;">
                <a href="index.php" class="text-muted">← Retour à la connexion</a>
            </div>
        </div>
<?php include 'footer.php'; ?>