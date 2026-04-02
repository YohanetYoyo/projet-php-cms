<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<header>
    <h1>Connexion</h1>
    <?php if (!empty($errors)):
        foreach ($errors as $error):
            ?>
            <h2 style="color: red;"><?= $error ?></h2>
        <?php
        endforeach;
    endif;
    ?>
</header>
    <form method="post" action="/login">
        <table>
            <tr>
                <td>
                    <label for="email">Email :</label>
                </td>
                <td>
                    <input id="email" type="email" name="email" value="<?= $email ?? "" ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pwd">Mot de passe :</label>
                </td>
                <td>
                    <input id="pwd" type="password" name="pwd" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">Connexion</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <a href="/register">Pas de compte ? Cliquez ici pour vous inscrire</a>
</body>
</html>