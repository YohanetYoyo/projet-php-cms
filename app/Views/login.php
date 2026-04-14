<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Connexion</h1>
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
        <form method="post" action="/login">
            <div>
                <label for="email">Email :</label>
                <input id="email" type="email" name="email" value="<?= $email ?? "" ?>" required>
            </div>
            <div>
                <label for="pwd">Mot de passe :</label>
                <input id="pwd" type="password" name="pwd" required>
            </div>
            <button type="submit" class="button button--primary">Connexion</button>
            <hr>
            <a href="/register"><button type="button" class="button button--secondary">S'inscrire</button></a>
            <a href="/forgot-password">Mot de passe oublié ?</a>
        </form>
    </div>
</main>
</body>
</html>