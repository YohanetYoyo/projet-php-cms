<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Récupérer votre mot de passe</h1>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</header>
<main>
    <div class="container">
        <?php if (isset($success) && $success): ?>
            <div class="success">
                <p style="color: green; font-weight: bold;">✅ Lien de réinitialisation généré avec succès !</p>
                <p>Ce lien expire dans 2 heures.</p>
                <br>
                <p><strong>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</strong></p>
                <p><a href="<?= htmlspecialchars($resetLink) ?>">
                        Réinitialiser mon mot de passe
                    </a></p>
                <br>
                <p><a href="/login"><button type="button" class="button button--primary">Retour à la connexion</button></a></p>
            </div>
        <?php else: ?>
            <form method="post">
                <p>Entrez l'email associé à votre compte pour générer un token de réinitialisation.</p>
                <div>
                    <label for="email"><strong>Email :</strong></label>
                    <input id="email" type="email" name="email" required>
                </div>
                <button type="submit" class="button button--primary">Envoyer le lien</button>
                <a href="/login"><button type="button" class="button button--secondary">Retour</button></a>
                </form>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
