<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
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
    <form method="post" action="?page=register">
        <table>
            <tr>
                <td>
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? "" ?>" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? "" ?>" required>
                </td>
            </tr>
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
                <td>
                    <label for="confirmPwd">Confirmer mot de passe :</label>
                </td>
                <td>
                    <input id="confirmPwd" type="password" name="confirmPwd" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">S'inscrire</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <a href="?page=login">Déjà un compte ? Cliquez ici pour vous connecter</a>
</body>
</html>