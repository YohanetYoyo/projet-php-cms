<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Créer une page</title>
        </head>
    <body>
    <?php
    if (!isset($_SESSION['user'])) {
        echo "Vous n'êtes pas connecté !";
        echo "<a href='?page=login'><button type='buton'>Cliquez ici pour vous connecter</button></a>";
    } else {
        ?>
        <header>
            <h1>Créer une page</h1>
        </header>
        <?php if (!empty($errors)):
            foreach ($errors as $error):
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            <?php 
            endforeach;
        endif; 
        ?>


         <form method="post" action="?page=pages/create">
            <table>
                <tr>
                    <td>
                        <label for="title">Titre :</label>
                    </td>
                    <td>
                      <input id="title" type="text" name="title" value="<?= htmlspecialchars($title ?? '') ?>" required>

                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="slug">Slug :</label>
                    </td>
                <td>
                    <textarea id="content" name="content" rows="8" cols="40" required><?= htmlspecialchars($content ?? '') ?></textarea>
                </td>
                <td>
                    <textarea id="content" name="content" rows="8" cols="40" required><?= htmlspecialchars($content ?? '') ?></textarea>
                </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Créer la page</button>
                    </td>
                </tr>
            </table>
         </form>
         <br>
             <a href="?page=pages"><button type="button">Retour à la liste des pages</button></a>
    <?php
}
?>
</body>
</html>