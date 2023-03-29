<?php $title = 'Tableau'; ?>
<?php $css = 'assets/css/projet.css'; ?>

<?php ob_start(); ?>

<div class="app">
    <div id="bann">
        <h1><?= $table['nom_tableau']; ?></h1>
    </div>

    <div class="lists">

        <div class="list" id="addItem">
            <h2>A faire</h2>

            <input type="text" id="task-text">
            <button type="submit" value="btn-task" id="btn-task">Ajouter une tache</button>

        </div>

        <div class="list">
            <h2>En cours</h2>

        </div>

        <div class="list">
            <h2>Finie</h2>

        </div>

    </div>

</div>

<!-- Modal box -->
<div id="modalBox" class="modal">

    <!-- Modal content -->
    <div class="modal-content">

        <span class="close">&times;</span>

        <p>Description :</p>
        <textarea name="descr" id="descr"></textarea>

        <div>
            <button type="submit" value="btn-add" id="btn-add">Ajouter</button>
            <button type="submit" value="btn-change" id="btn-change">Modifier</button>
        </div>

    </div>

</div>

<script src="assets/js/script.js"></script>

<?php
$content = ob_get_clean();
require('view/template.php');
?>