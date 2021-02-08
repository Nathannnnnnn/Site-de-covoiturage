<?php $villeManager=new VilleManager($db);
$nbr=$villeManager->compteurVille() ?>

<h1>Liste des villes</h1>

<p>Il y a <?php echo $nbr ?> villes.</p>

<table>
  <tr>
    <th>Numéro</th>
    <th>Nom</th>
  </tr>


<?php $villes = $villeManager -> getAllVille();

foreach ($villes as $value) {
  // code...
  echo "<tr>";
  echo "<td>".$value->getNum()."</td>";
  echo "<td>".$value->getNom()."</td>";
  echo "</tr>";
}
?>

</table>
