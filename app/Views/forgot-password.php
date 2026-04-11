<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <h1>Récupérer votre mot de passe</h1>
</header>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <?php foreach ($errors as $error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (isset($success) && $success): ?>
    <div class="success">
        <p style="color: green; font-weight: bold;">✅ Lien de réinitialisation généré avec succès !</p>
        <p>Ce lien expire dans 2 heures.</p>
        <br>
        <p><strong>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</strong></p>
        <p><a href="<?= htmlspecialchars($resetLink) ?>" style="color: blue; text-decoration: underline; font-size: 16px;">
            Réinitialiser mon mot de passe
        </a></p>
        <br>
        <p><a href="/login">Retour à la connexion</a></p>
    </div>
<?php else: ?>
    <main>
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="email"><strong>Email :</strong></label>
                    </td>
                    <td>
                        <input id="email" type="email" name="email" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Entrez l'email associé à votre compte pour générer un token de réinitialisation.</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Envoyer le lien</button>
                        <a href="/login"><button type="button">Retour</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </main>
<?php endif; ?>
</body>
</html>
