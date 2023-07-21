<div id=formulaire>
    <form method="POST">
    <input name="nom" placeholder="Nom" value="<?= $data['asso']->getNom() ?>"/>
    <input name="adresse" placeholder="Adresse"></input>
    <input name="mail" placeholder="Mail"></input>
    <input name="telephone" placeholder="Téléphone"></input>
    <input name="image_url" type="url" placeholder="URL d'une image" />
    <textarea name="description" placeholder="Description du lieu..."></textarea>
    <button name="submit">Envoyer</button>
</form>
</div>