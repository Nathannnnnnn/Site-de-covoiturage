
<h1>Rechercher un trajet</h1>
<?php
$db = new MyPdo();
$proposeManager = new ProposeManager($db);
$parcoursManager = new ParcoursManager($db);
$villeManager=new VilleManager($db);
$listeVilleDepart = $proposeManager->getAllVilleDeDepart();

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
       $listeVilleArrive = $proposeManager->getAllVilleArrivee($_POST['vil_num1']);
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
                   <label>Précision :
                     <select name="pro_date_liste" id="pro_date_liste">
                             <option value="0">Ce jour</option>
                             <option value="1">+/- 1 jour</option>
                             <option value="2">+/- 2 jours</option>
                             <option value="3">+/- 3 jours</option>
                         </select>
                   </label>
                   <br>
                   <label>A partir de  :
                     <select name="pro_time" id="pro_time">
                             <option value="0">0h</option>
                             <option value="1">1h</option>
                             <option value="2">2h</option>
                             <option value="3">3h</option>
                             <option value="4">4h</option>
                             <option value="5">5h</option>
                             <option value="6">6h</option>
                             <option value="7">7h</option>
                             <option value="8">8h</option>
                             <option value="9">9h</option>
                             <option value="10">10h</option>
                             <option value="11">11h</option>
                             <option value="12">12h</option>
                             <option value="13">13h</option>
                             <option value="14">14h</option>
                             <option value="15">15h</option>
                             <option value="16">16h</option>
                             <option value="17">17h</option>
                             <option value="18">18h</option>
                             <option value="19">19h</option>
                             <option value="20">20h</option>
                             <option value="21">21h</option>
                             <option value="22">22h</option>
                             <option value="23">23h</option>
                         </select>
                   </label>
                   <br>
                  <input type="submit" value="Valider">

     <?php
   }
    } else {
       $villeManager = new VilleManager($db);
       $parcoursManager = new ParcoursManager($db);
       $personneManager = new PersonneManager($db);
       $proposeManager= new ProposeManager($db);
       $dateMax = addJours($_POST['pro_date'], $_POST['pro_date_liste']);
       $listepropose = $proposeManager->getAllProposePar($_SESSION['vil_num1'], $_POST['vil_num2'], $_POST['pro_date'], $dateMax , $_POST['pro_time']);

   if (COUNT($listepropose) == 0) {
       ?>
       <p>Aucun trajet ne correspond à votre recherche.</p>
       <?php
   } else {


       ?>
       <table>
           <tr>
               <th>Ville départ</th>
               <th>Ville arrivée</th>
               <th>Date départ</th>
               <th>Heure départ</th>
               <th>Nombre de place(s)</th>
               <th>Nom du covoitureur</th>
           </tr>
          <?php
          foreach ($listepropose as $propose) {
    
              // code...
            $parcours = $parcoursManager-> getParcours($propose->getParNum());
            $villeDepart = $villeManager->getVilleNom($parcours->getVilleDepart());
            $villeArrivee = $villeManager->getVilleNom($parcours->getVilleArrive());
            $personne = $personneManager->trouver($propose->getPerNum());
            ?>
            <tr>
                <td><?php echo $villeDepart ?></td>
                <td><?php echo $villeArrivee ?></td>
                <td><?php echo $propose->getProDate() ?></td>
                <td><?php echo $propose->getProTime() ?></td>
                <td><?php echo $propose->getProPlace() ?></td>
                <td><abbr title="  Dernier avis : <?php echo $personneManager->getAvis($personne->getPerNum())?>   Moyenne des avis : <?php echo $personneManager->getMoyNote($personne->getPerNum())?> "><?php echo $personne->getPerPrenom() . " " . $personne->getPerNom() ?></abbr></td>
            </tr>
            <?php
            }
        ?>
       </table>
       <?php
     }


   }
