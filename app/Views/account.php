<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gérer mon compte</title>
    <link rel="stylesheet" href="../../style.css">
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
    echo "<a href='?page=login'><button type='button'>Cliquez ici pour vous connecter</button><a/>";
} else {
    ?>
    <header>
        <h1>Gérer mon compte</h1>
        <?php if (!empty($errors)):
            foreach ($errors as $error):
                ?>
                <h2 style="color: red;"><?= $error ?></h2>
            <?php
            endforeach;
        endif;
        ?>
    </header>
    <form method="post" action="?page=account/delete" id="deletionForm">
        <button onclick="return deleteAccount('deletionForm')" style="background-color: lightcoral;">Supprimer mon compte</button>
    </form>
    <?php
}
?>
</body>
</html>