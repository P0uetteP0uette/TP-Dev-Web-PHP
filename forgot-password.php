<?php $pageTitle = "Mot de passe oublié - Ticketing App"; include 'header.php'; ?>

<body>

    <div class="login-container">
        <div class="login-card">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="margin-bottom: 0.5rem;">Mot de passe oublié ?</h1>
                <p class="text-muted">Entrez votre email, nous vous enverrons un lien de réinitialisation.</p>
            </div>

            <form action="index.html"> <div class="form-group">
                    <label for="email">Email associé au compte</label>
                    <input type="email" id="email" placeholder="nom@entreprise.com" required>
                </div>

                <button type="submit" class="btn mb-1">Envoyer le lien</button>
                
                <div style="text-align: center; font-size: 0.9rem;">
                    <a href="index.html" class="text-muted">← Retour à la connexion</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>