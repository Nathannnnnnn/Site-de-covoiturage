<?php
$personneManager=new PersonneManager($db);
$listePersonne = $personneManager->getAllPerson();
if (empty($_GET["per_num"])) {?>
    <h1>Liste des personnes enregistrées</h1>
    <p>Actuellement <?php echo count($listePersonne) ?> enregistrées.</p>
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
                    <a href="index.php?page=2&per_num=<?php echo $person->getPerNum() ?>"><?php echo $person->getPerNum() ?></a>
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
    $role= new PersonneManager($db);
    $etudiantManager=new EtudiantManager($db);
    $getEtu=$etudiantManager->getEtudiant($per_num);
    $etud=$role->isEtudiant ($getEtu);
     $res=$role->trouver ($per_num);

    if($etud){
        $departementManager=new DepartementManager($db);
        $villeManager= new VilleManager($db);

    ?>
        <h1>Détail sur l'étudiant Duchemin</h1>

        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Département</th>
                <th>Ville</th>
            </tr>
            <tr>
                <?php
                echo "<td>".$res->getPerPrenom()."</td>";
                echo "<td>".$res->getPerMail()."</td>";
                echo "<td>".$res->getPerTel()."</td>";
                echo "<td>".$departementManager->getDepartement($getEtu->getDepNum())->getDepNom();
                echo "<td>".$villeManager->getVille($departementManager->getDepartement($getEtu->getDepNum())->getVilNum())->getNom ()."</td>";
                ?>
            </tr>
        </table>
        <?php }

    else{
        $salarieManager= new SalarieManager($db);
        $fonctionManager= new FonctionManager($db);
        ?>
    <h1>Détail sur le salarié Adam</h1>

        <table>
            <tr>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Tel</th>
                <th>Tel pro</th>
                <th>fonction</th>
            </tr>

            <tr>
                <?php
                echo "<td>".$res->getPerPrenom()."</td>";
                echo "<td>".$res->getPerMail()."</td>";
                echo "<td>".$res->getPerTel()."</td>";
                echo "<td>".$salarieManager->getSalarie($per_num)->getSalTelprof()."</td>";
                echo "<td>".$fonctionManager->getFonction($salarieManager->getSalarie($per_num)->getFonNum())->getFonLibelle()."</td>";
                ?>
            </tr>


        </table>
<?php
    }
}?>