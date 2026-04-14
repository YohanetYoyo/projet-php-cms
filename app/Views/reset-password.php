<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Réinitialiser votre mot de passe</h1>
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
            <div>
                <p style="color: green;">Votre mot de passe a été réinitialisé avec succès.</p>
                <p><a href="/login"><button type="button" class="button button--primary">Cliquez ici pour vous connecter</button></a></p>
            </div>
        <?php else: ?>
        <form method="post">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
            <div>
                <label for="pwd"><strong>Nouveau mot de passe :</strong></label>
                <input id="pwd" type="password" name="pwd" required>
            </div>
            <div>
                <small style="display: block; margin-top: 5px;">
                    Minimum 8 caractères : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial (.;?,-!)
                </small>
            </div>
            <div>
                <label for="confirm_pwd"><strong>Confirmer le mot de passe :</strong></label>
                <input id="confirm_pwd" type="password" name="confirm_pwd" required>
            </div>
            <button type="submit" class="button button--primary">Réinitialiser le mot de passe</button>
            <a href="/login"><button type="button" class="button button--secondary">Annuler</button></a>
        </form>
        <?php endif; ?>
    </div>
</main>
</body>
</html>
