<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer mon compte</title>
    <link rel="stylesheet" href="/css/main.css">
    <script>
        function deleteAccount(deletionForm) {
            if (confirm("Êtes-vous sûr de vouloir supprimer votre compte ?") === true) {
                document.getElementById(deletionForm).submit();
            } else {
                return false;
            }
        }
    </script>
</head>
<body>
<?php
if (!isset($_SESSION['user'])) {
    echo "Vous n'êtes pas connecté !";
    echo "<a href='?page=login'><button type='button' class='button button--primary'>Cliquez ici pour vous connecter</button><a/>";
} else {
    ?>
    <header>
        <div class="container">
            <h1>Gérer mon compte</h1>
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
            <form method="post" action="/account/update">
                <div>
                    <label for="nom">Nom :</label>
                    <input id="nom" type="text" name="lastname" value="<?= $lastname ?? $_SESSION['user']->getLastname() ?>" required>
                </div>
                <div>
                    <label for="prenom">Prénom :</label>
                    <input id="prenom" type="text" name="firstname" value="<?= $firstname ?? $_SESSION['user']->getFirstname() ?>" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input id="email" type="email" name="email" value="<?= $email ?? $_SESSION['user']->getEmail() ?>" required>
                </div>
                <button type="submit" class="button button--primary">Modifier mes informations</button>
            </form>
            <form method="post" action="/account/delete" id="deletionForm">
                <button onclick="return deleteAccount('deletionForm')" class="button button--danger">Supprimer mon compte</button>
            </form>
            <a href="/index"><button type="button" class="button button--secondary">Retour vers l'accueil</button></a>
        </div>
    </main>
    <?php
}
?>
</body>
</html>