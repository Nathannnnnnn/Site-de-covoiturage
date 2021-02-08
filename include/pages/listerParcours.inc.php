<?php $personnemanager=new ParcoursManager($db);
$villeManager = new VilleManager($db);

$listeParcours = $personnemanager->getAllParcours();
?>

<h1>Liste des parcours proposés</h1>

<p>Il y a <?php echo count($listeParcours)+1 ?> parcours.</p>

<table>
    <tr>
        <th>Numéro</th>
        <th>Nom ville</th>
        <th>Nom ville</th>
        <th>Nombre de Km</th>
    </tr>
   <?php
    foreach ($listeParcours as $value) {
      ?>

        <tr>
         <td><?php echo $value->getParNum(); ?></td>
         <td><?php echo $villeManager->getVilleNom($value->getVilleDepart()); ?></td>
         <td><?php echo $villeManager->getVilleNom($value->getVilleArrive()); ?></td>
         <td><?php echo $value->getNbKil(); ?></td>
      </tr>
      <?php
    }
    ?>

</table>
