<h1>Ajouter une ville</h1>
 <form action="#" method = "post" id = "AjouterVille">
     <?php
     $villeManager=new VilleManager($db);

     if (empty($_POST["vil_nom"])){ ?>
       Nom : <input type="text" id="nomVille" name ="vil_nom"/>
       <input type="submit" id="valider" value="Valider"/>
      <?php } ?>
  </form>
  <?php
  if(!empty ($_POST["vil_nom"])){
     ?> <p> <img src="image/valid.png"> La ville "<b> <?php echo $_POST["vil_nom"] ?> </b>" a bien été ajouté. </p>

     <?php
     $ville=new Ville($_POST);


     $retour= $villeManager->add($ville);
 }
 ?>
