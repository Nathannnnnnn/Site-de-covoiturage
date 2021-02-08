<h1> Ajouter un parcours</h1>

<?php

if (empty($_POST['vil_num1']) && empty($_POST['vil_num2'])) {?>
    <form method="post" action="#">
        <label>Ville 1 :</label>
        <select name="vil_num1">
            <?php
            $villeManager = new VilleManager($db);
            $listeVille = $villeManager->getAllVille();
            foreach ($listeVille as $value) { ?>
                <option value="<?php echo $value->getNum() ?>"><?php echo $value->getNom() ?></option>
            <?php  }
            ?>
        </select>

        <label>Ville 2 :</label>
        <select name="vil_num2">
            <?php
            $villeManager = new VilleManager($db);
            $listeVille = $villeManager->getAllVille();
            foreach ($listeVille as $value) { ?>
                <option value="<?php echo $value->getNum() ?>"><?php echo $value->getNom() ?></option>
            <?php  }
            ?>
        </select>

        <label> Nombre de kilomètre(s)</label>
            <input required type="number" min="0" name="nbKil" value="0">

        <input type="submit" value="Valider"/>
    </form> <?php
}
else{
    $parcours = new Parcours(array(
        'vil_num1' => $_POST['vil_num1'],
        'vil_num2' => $_POST['vil_num2'],
        'par_km' => $_POST['nbKil']
    ));

    $parcoursManager = new ParcoursManager($db);

    if ($parcours->getVilleDepart() != $parcours->getVilleArrive()){
        if (!$parcoursManager->parcoursExiste($parcours)) {
            $parcoursManager->addParcours($parcours);
            ?> <p> <img src="image/valid.png"> Le parcours a bien été ajouté. </p>
            <?php
        }
        else {
            $_POST=array();

            echo "Le parcours éxiste deja, <a href=''>réessayer</a>.";
        }
    }
    else {
        $_POST=array();
        echo "Les deux villes doivent être différentes, <a href=''>réessayer</a>.";
    }
}
?>
