<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='/login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button><a/>";
} else {
if ($_SESSION['user']->getIsAdmin() != 1) {
    echo "Vous n'êtes pas autorisé à visionner cette page !";
    echo "<a href='/index'><button type='button' class='button button--primary'>Cliquez ici pour retourner à l'accueil</button><a/>";
} else {
    ?>
    <header>
        <div class="container">
            <h1>Modifier l'utilisateur <?= $user['lastname']. " ". $user['firstname'] ?></h1>
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
            <form method="post" action="/modify-user">
                <div>
                    <label for="nom">Nom :</label>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? $user['lastname'] ?>" required>
                </div>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? $user['firstname'] ?>" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input id="email" type="email" name="email" value="<?= $email ?? $user['email'] ?>" required>
                </div>
                <div class="radio">
                    <label>Admin :</label>
                    <label for="isAdmin">Oui :</label>
                    <input id="isAdmin" type="radio" name="isAdmin" value="1" <?= $isAdmin ?? $user['is_admin'] === 1 ? 'checked' : '' ?>>
                    <label for="isNotAdmin">Non :</label>
                    <input id="isNotAdmin" type="radio" name="isAdmin" value="0" <?= $isAdmin ?? $user['is_admin'] === 0 ? 'checked' : '' ?>>
                </div>
                <div>
                    <input type="hidden" name="idUser" value="<?= $idUser ?? $user['id_user'] ?>">
                    <button type="submit" class="button button--primary">Modifier les informations</button>
                </div>
            </form>
            <a href="/manage-users"><button type="button" class="button button--secondary">Retour vers gestion des utilisateurs</button></a>
        </div>
    </main>
    <?php
    }
}
?>
</body>
</html>