<h1>Liste des Associations</h1>
<?php

foreach($data['assos'] as $asso) {
?>
    <div id=assos>
        <h2><a href="index.php?page=asso&id=<?= $asso->getId() ?>"><?= $asso->getNom() ?></a></h2>
    </div>
<?php
}
?>