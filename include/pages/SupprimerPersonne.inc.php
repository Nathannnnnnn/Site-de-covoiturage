<?php
$personneManager = new PersonneManager($db);
if (empty($_GET["per_num"])) {?>
    <h1>Supprimer des personnes enregistrées</h1>
    <?php echo "Qui voulez-vous supprimer ?"; ?>
    <table>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr>
        <?php
        foreach ($personneManager->getAllPerson() as $person) {
            ?>
            <tr>
                <td>
                    <a href="index.php?page=4&per_num=<?php echo $person->getPerNum() ?>"><?php echo $person->getPerNum() ?></a>
                </td>
                <td><?php echo $person->getPerNom() ?></td>
                <td><?php echo $person->getPerPrenom() ?></td>
            </tr>
         <?php
        }?>
        </table>
    <?php
}
else {
        $per_num = $_GET["per_num"];
        $salarieManager = new SalarieManager($db);
        $etudiantManager = new EtudiantManager($db);
        $proposeManager = new ProposeManager($db);

        if ($personneManager->isEtudiant($per_num)) {
            $retour = $personneManager->supPersonne($per_num, 1);
        } else {
            $retour = $personneManager->supPersonne($per_num, 2);
        }

        if ($retour) {
            echo "Personne supprimée, il ne vous embetera plus!";
            ?>
            <img src="image/valid.png" alt="valid"><?php
        } else {
            echo "Echec de la suppression !";?>
            <img src="image/erreur.png" alt="valid"><?php
        }
    }
?>
