<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<header>
    <h1>Réinitialiser votre mot de passe</h1>
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
        <p style="color: green;">Votre mot de passe a été réinitialisé avec succès.</p>
        <p><a href="/login">Cliquez ici pour vous connecter</a></p>
    </div>
<?php else: ?>
    <main>
        <form method="post">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token ?? '') ?>">
            
            <table>
                <tr>
                    <td>
                        <label for="pwd"><strong>Nouveau mot de passe :</strong></label>
                    </td>
                    <td>
                        <input id="pwd" type="password" name="pwd" required>
                        <small style="display: block; margin-top: 5px;">
                            Minimum 8 caractères : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial (.;?,-!)
                        </small>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="confirm_pwd"><strong>Confirmer le mot de passe :</strong></label>
                    </td>
                    <td>
                        <input id="confirm_pwd" type="password" name="confirm_pwd" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Réinitialiser le mot de passe</button>
                        <a href="/login"><button type="button">Annuler</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </main>
<?php endif; ?>
</body>
</html>
