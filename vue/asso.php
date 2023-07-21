<div id=asso>
    <h1><?= $data['asso']->getNom() ?></h1>
    <img src="<?= $data['asso']->getImageUrl() ?>" />
    <p><?= $data['asso']->getDescription() ?></p>
    <p><?= $data['asso']->getMail() ?></p>
    <p><?= $data['asso']->getTelephone() ?></p>
    <p><?= $data['asso']->getAdresse() ?></p>
</div>