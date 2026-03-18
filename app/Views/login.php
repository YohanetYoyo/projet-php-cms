<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
</head>
<body>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
            ?>
            <h2 style="color: red;"><?= $error ?></h2>
        <?php
        endforeach;
    endif;
    ?>
    <form method="post" action="?page=login">
        <label for="email">Email:</label>
        <input id="email" type="email" name="email" value="<?= $email ?? "" ?>" required>
        <label for="pwd">Mot de passe:</label>
        <input id="pwd" type="password" name="pwd" required>
        <button type="submit">Connexion</button>
    </form>
    <br>
    <a href="?page=register">Pas de compte ? Cliquez ici pour vous inscrire</a>
</body>
</html>