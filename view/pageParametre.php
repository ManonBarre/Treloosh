<?php $title = 'Paramètres' ?>
<?php $css = 'assets/css/param.css'; ?>

<?php ob_start(); ?>

<div id="bann">
    <h1>Paramètres</h1>
</div>

<section>
    <form method="POST">
        <label for="mail"></label>
        <input type="email" placeholder="Adresse e-mail" name="mail" value="<?= $user->getMail(); ?>" disabled />

        <label for="password"></label>
        <input type="password" name="password" placeholder="Mot de passe" value="<?= $user->getPassword(); ?>" />

        <label for="repassword"></label>
        <input type="password" name="repassword" placeholder="Confirmer le mot de passe"
            value="<?= $user->getPassword(); ?>" />

        <label for="name"></label>
        <input type="text" name="name" placeholder="Nom" value="<?= $user->getName(); ?>" />

        <label for="firstname"></label>
        <input type="text" name="firstname" placeholder="Prénom" value="<?= $user->getFirstname(); ?>" />

        <input id="button" type="submit" value="Enregistrer les modifications" name="modif">
        <input id="button-delete" type="submit" value="Supprimer le compte" name="delete">
    </form>

    <div>
        <div id="photo"></div>
        <input type="file" name="photo" value="<?= $user->getPhoto(); ?>" />
    </div>
</section>



<?php
$content = ob_get_clean();
require('view/template.php');
?>