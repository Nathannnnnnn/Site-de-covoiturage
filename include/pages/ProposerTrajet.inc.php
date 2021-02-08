
<h1>Proposer un trajet</h1>
<?php

$db = new MyPdo();
$proposeManager = new ProposeManager($db);
$parcoursManager = new ParcoursManager($db);
$villeManager=new VilleManager($db);
$listeVilleDepart = $villeManager->getAllVilleDeDepartPar();

if (empty($_POST['vil_num2'])) {
  if (empty($_POST['vil_num1'])){
    ?> <form method="post" action="#">
      <label>Ville de départ :
          <select name="vil_num1">
            <option value="">Choisissez</option>
              <?php
              foreach ($listeVilleDepart as $value) { ?>
                  <option value="<?php echo $value->getNum() ?>"><?php echo $value->getNom() ?></option>
              <?php  }
               ?>
             </select>
           </label>
               <input type="submit" value="Valider">
         </form>
         <?php
       } else {
         $listeVilleArrive = $villeManager->getAllVilleArriveePar($_POST['vil_num1']);
         $_SESSION['vil_num1'] = $_POST['vil_num1'];

           ?> <form method="post" action="#">
                  <label>Ville de départ :
                  <?php echo $villeManager->getVilleNom($_SESSION['vil_num1']) ?>
                  </label>
                  <label> Ville d'arrivée :
                    <select name="vil_num2">
                      <option value="">Choisissez</option>
                        <?php
                        foreach ($listeVilleArrive as $value) { ?>
                            <option value="<?php echo $value->getNum() ?>"><?php echo $value->getNom() ?></option>
                        <?php  }
                         ?>
                       </select>
                     </label>
                  <br>
                  <label>Date de départ :
                    <input type="date" name="pro_date" id=pro_date value="<?php echo date("d-m-Y"); ?>" placeholder="DateDeDepart">
                  </label>
                     <label>Heure de départ :
                     <input type="text" name="pro_time" id=pro_time value="<?php echo date("H:i:s") ?>"  placeholder="HeureDeDepart"> <br />
                     </label>
                     <br>
                     <label>Nombres de places :
                       <input type="text" required name="pro_place" placeholder="nombre de place">
                     </label>
                     <br>
                    <input type="submit" value="Valider">

       <?php }
     } else {

       $personneManager = new PersonneManager($db);
       $parcours = $parcoursManager->parcoursExistePar($_SESSION['vil_num1'], $_POST['vil_num2']);

       $villeManager = new VilleManager($db);
       $num = $personneManager-> trouverNumParlog($_SESSION['nom_user']);
    if ($villeManager->getVilleNum($parcours->getVilleDepart()) == $_SESSION['vil_num1']){
        $sens = 0;
    }else{
        $sens = 1;
      }
    $propose = new Propose(
        array(
            'per_num' => $num,
            'pro_date' => $_POST['pro_date'],
            'pro_time' => $_POST['pro_time'],
            'pro_place' => $_POST['pro_place'],
            'pro_sens' => $sens,
        )
    );

    $propose->setParNum($parcours->getParNum());

    $essai = $proposeManager->addPropose($propose);
    if ($essai){
      ?>
   <p> <img src="image/valid.png"> Le parcours a bien été ajouté. </p>
      <?php
    }else{
      echo "erreur";
    }


}
