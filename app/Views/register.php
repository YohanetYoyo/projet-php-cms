<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Inscription</h1>
        <?php if (!empty($errors)):
            foreach ($errors as $error):
                ?>
                <h2 style="color: red;"><?= $error ?></h2>
            <?php
            endforeach;
        endif;
        ?>
    </div>
</header>
<main>
    <div class="container">
        <form method="post" action="/register">
            <div>
                <label for="nom">Nom :</label>
                <input id="nom" type="text" name="lastname" value="<?= $lastname ?? "" ?>" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? "" ?>" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input id="email" type="email" name="email" value="<?= $email ?? "" ?>" required>
            </div>
            <div>
                <label for="pwd">Mot de passe :</label>
                <input id="pwd" type="password" name="pwd" required>
            </div>
            <div>
                <label for="confirmPwd">Confirmer mot de passe :</label>
                <input id="confirmPwd" type="password" name="confirmPwd" required>
            </div>
            <button type="submit" class="button button--primary">S'inscrire</button>
            <a href="/login">Se connecter</a>
        </form>
    </div>
</main>
</body>
</html>