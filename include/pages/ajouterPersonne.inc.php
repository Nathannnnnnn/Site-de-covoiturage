<?php
//On rentre quand rien n'est rempli, donc quand on souhaite créer une personne
if (empty($_POST['per_nom']) &&empty($_POST['dep'])&&empty($_POST['div'])&&empty($_POST['fonc']) && empty($_POST['tel'])) {?>
    <h1>Ajouter une personne</h1>

    <form method="post" action="#">
        <label>Nom :</label>
            <input type="text" required name="per_nom" placeholder="nom"/>

        <label>Prenom :</label>
            <input type="text" required name="per_prenom" placeholder="Prenom"/>
        <br>

        <label>Téléphone :</label>
            <input type="tel" required name="per_tel" placeholder="Telephone"/>

        <label>Mail :</label>
            <input type="email" required name="per_mail" placeholder="Adresse mail..."/>
        <br>

        <label>Login :</label>
            <input type="text" required name="per_login" placeholder="Login"/>

        <label>Mot de passe :</label>
            <input type="password" required name="per_pwd" placeholder="mot de passe..."/>
        <br>

        <div>
            <label>Catégorie :</label>
            <input type="radio" name="fonction" value="etudiant" checked/>
            <label>Etudiant</label>
            <input type="radio" name="fonction" value="personnel"/>
            <label>Personnel</label>
        </div>
        <br>

        <input type="submit" value="Valider"/>
    </form>
<?php
}

//On rentre quand la personne à était saise, donc on veut la créer
if (!empty($_POST['per_nom']) &&empty($_POST['dep'])&&empty($_POST['div'])&&empty($_POST['fonc'])) {
    $password=$_POST['per_pwd'];
    $_SESSION=$password;
    $salt="48@!asld";
    $password_crypte=sha1(sha1($password).$salt);
    $person = new Personne(array(
        'per_nom' => $_POST['per_nom'],
        'per_prenom' => $_POST['per_prenom'],
        'per_tel' => $_POST['per_tel'],
        'per_mail' => $_POST['per_mail'],
        'per_login' => $_POST['per_login'],
        'per_pwd' => $password_crypte
    ));

    $personManager = new PersonneManager($db);

    $_SESSION = [$personManager -> trouverNum ($person)];


        $num=$personManager->addPerson($person);

        $_SESSION["num"] = $num;

}

if (!empty($_POST['fonction'])) {

    //On rentre quand la fonction indiqué pour cette personne stipule que c'est un étudiant
    if ($_POST['fonction']=='etudiant'){
        ?>
        <h1>Ajouter un étudiant</h1>
        <form method="post" action="#">
            <label>
                Année:
                <select name="div">
                    <?php
                    $divManager = new DivisionManager($db);
                    $listeDiv = $divManager->getAllDivision();
                    foreach ($listeDiv as $value) { ?>
                        <option value="<?php echo $value->getDivNum() ?>" name="division"><?php echo $value->getDivNom() ?></option>
                    <?php  } ?>
                </select>
            </label>
            <label>
                Département:
                <select name="dep">
                    <?php
                    $depManager = new DepartementManager($db);
                    $listeDep = $depManager->getAllDepartement();
                    foreach ($listeDep as $value) { ?>
                        <option value="<?php echo $value->getDepNum()?>" name="depart"><?php echo $value->getDepNom() ?></option>
                    <?php  } ?>
                </select>
            </label>
            <input type="hidden" name="num" value="<?php echo $num ?>>">
            <br>
            <br>

            <button type="submit" value="Valider">Valider</button>
        </form>
        <?php
    }

    // on rentre si la personne créer est du personnel, on veut le créer
    if ($_POST["fonction"]=="personnel") {
        ?>
        <h1>Ajouter un salarié</h1>

        <form method="post" action="#">
            <label>
                Téléphone personnel:
                <input type="tel" name="tel" placeholder="Numéro de téléphone...">
            </label>
            <br>
            <label>
                Fonction:
                <?php
                $fonctionManager = new FonctionManager($db);
                $listeFonction = $fonctionManager->getAllFonction();
                ?>
                <select name="fonc">
                    <?php
                    foreach ($listeFonction as $value) { ?>
                        <option value="<?php echo $value->getFonNum()?>" name="fonct"><?php echo $value->getFonLibelle() ?></option>
                    <?php  } ?>
                </select>
            </label>
            <br>
            <br>

            <button type="submit" value="Valider">Valider</button>
        </form>
        <?php
    }
}

    //on rentre quand les information sur l'étudiant sont saisis, on veut le créer
    if (!empty($_POST['div'])&&!empty($_POST['dep'])) {
        $etudiant = new Etudiant(array(
            'per_num'=> $_SESSION["num"],
            'dep_num' => $_POST['dep'],
            'div_num' => $_POST['div']
        ));

        $etudiantManager = new EtudiantManager($db);


        $etudiantManager->addEtudiant($etudiant);
         ?> <p> <img src="image/valid.png"> L'étudiant a bien été ajouté. </p> <?php
    }

    //on rentre quand les information sur l'étudiant sont saiis, on veut le créer
    if (!empty($_POST['fonc'])&&!empty($_POST['tel'])) {
        $salarie = new Salarie(array(
            'per_num'=> $_SESSION["num"],
            'sal_telprof' => $_POST['tel'],
            'fon_num' => $_POST['fonc']
        ));

        $salarieManager = new SalarieManager($db);



        $salarieManager->addSalarie($salarie);
         ?> <p> <img src="image/valid.png"> Le salarié a bien été ajouté. </p> <?php
    }
?>
