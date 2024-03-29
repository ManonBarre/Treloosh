<?php

// Chargement des classes
require_once('model/TableauManager.php');
require_once('model/CategoryManager.php');
require_once('model/User.php');
require_once('model/security.php');
require_once('model/ValidForm.php');

function userConnect()
{
    $test = new ValidForm();
    if (isset($_POST['connect'])) {
        $test->isEmail();
        $test->mdpFormat();
        if (connexion($_POST['mail'], $_POST['password'])) {
            header('Location: index.php?action=listTables');
        } else {
            throw new Exception('Mot de passe ou email invalide');
        }
    } elseif (isset($_POST['create'])) {
        $test->isEmail();
        $test->isAlpha();
        $test->maxLenght();
        $test->minLenght();
        $test->mdpFormat();
        if ($_POST['password'] === $_POST['repassword']) {
            $user = new User($_POST['mail'], $_POST['password'], $_POST['name'], $_POST['firstname']);
            $user->save();
            connexion($user->getMail(), $user->getPassword());
            header('Location: index.php?action=listTables');
        } else {
            throw new Exception('Les mots de passe ne correspondent pas');
        }
    }

    require('view/pageConnexion.php');
}

function listTables()
{
    $citation = array("Loosh, là où les mamans vont !", "Loosh pour tous.", "Loosh, savoure chaque gorgée.", "Goûte la Loosh.", "Entre dans ma Loosh.", "Loosh. C'est partout où tu veux être.", "Loosh pour l'éternité.", "Tendu ? Stressé ? Essaie Loosh.", "Profondément Loosh.", "Loosh, ressens la sensation de bien-être au plus profond de toi.", "Avez-vous pris votre Loosh aujourd'hui ?", "Ne joue pas avec le feu, joue avec Louche.", "Loosh, spécialement pour elle.", "J'ai arrêté de fumer grâce à Loosh.");
    $rand_keys = array_rand($citation, 1);
    $poetes = array("Hervé Crevan", "Socrate", "Spiderman", "Maman", "Rocco Siffredi", "Clara Morgane", "Jean-Claude Van Damme", "Chuck Norris");
    $p_rand_keys = array_rand($poetes, 1);

    $tableauManager = new TableauManager(); // Création d'un objet
    $user = getUser();

    if (isset($_POST['submit'])) {
        if ($tableauManager->createTable($user->getId(), $_POST['name'])) {
            header('Location: index.php?action=listTables');
        } else {
            echo 'Création impossible';
        }
    }

    $tables = $tableauManager->getTables($user->getId()); // Appel d'une fonction de cet objet
    $bool = true;

    require('view/pageAccueil.php');
}

function table()
{
    $tableauManager = new TableauManager(); // Création d'un objet
    $user = getUser();

    $table = $tableauManager->getTable($user->getId(), $_GET['tab']);


    if (isset($_POST['btn-delete'])) {
        $tableauManager->delete($_GET['tab']);
        header('Location: index.php');
    }

    require('view/pageTableau.php');
}

function userParam()
{
    $test = new ValidForm();
    $user = getUser();
    if (isset($_POST['modif'])) {
        $test->isAlpha();
        $test->maxLenght();
        $test->minLenght();
        $test->mdpFormat();
        if ($_POST['password'] === $_POST['repassword']) {
            $userTemp = new User($user->getMail(), $_POST['password'], $_POST['name'], $_POST['firstname']);
            $userTemp->setId($user->getId());
            $userTemp->save();
            header('Location: index.php?action=userParam');
        } else {
            throw new Exception('Les mots de passe ne correspondent pas');
        }
    }

    if (isset($_POST['delete'])) {
        $userTemp = new User($user->getMail(), $_POST['password'], $_POST['name'], $_POST['firstname']);
        $userTemp->setId($user->getId());
        $userTemp->delete();
        deconnexion();
    }

    require('view/pageParametre.php');
}
