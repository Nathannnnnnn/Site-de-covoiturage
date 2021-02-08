<?php
$personneManager = new PersonneManager($db);
if (empty($_GET["per_num"])) {?>
    <h1>Modifier des informations sur une personne</h1>
    <?php echo "Qui voulez-vous modifier ?"; ?>
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
                    <a href="index.php?page=3&per_num=<?php echo $person->getPerNum() ?>"><?php echo $person->getPerNum() ?></a>
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
    $role= new PersonneManager($db);
    $res= $role->trouver($_GET["per_num"]);
    if(empty($_POST['per_nom']) && empty($_POST['per_prenom'])){


        //print_r ($res);
        ?>
        <h1>Modifier la personne</h1>

        <form method="post" action="#">
            <label>Nom :</label>
            <input type="text" required name="per_nom" placeholder="<?php  echo ($res->getPerNom()); ?>"/>

            <label>Prenom :</label>
            <input type="text" required name="per_prenom" placeholder="<?php echo ($res->getPerPrenom() );?>"/>
            <br>

            <label>Téléphone :</label>
            <input type="tel" required name="per_tel" placeholder="<?php echo($res->getPerTel() );?>"/>

            <label>Mail :</label>
            <input type="email" required name="per_mail" placeholder="<?php echo($res->getPerMail()); ?>"/>
            <br>

            <label>Login :</label>
            <input type="text" required name="per_login" placeholder="<?php echo ($res->getPerLogin() );?>"/>

            <label>Mot de passe :</label>
            <input type="password" required name="per_pwd" placeholder="<?php echo ($res->getPerPwd() );?>"/>
            <br>

            <input type="submit" value="Enregistrer les modifications"/>
        </form>
<?php
    }

    if(!empty($_POST['per_nom']) && !empty($_POST['per_prenom'])){
        $modif= new PersonneManager($db);
        $person= new Personne (array("per_num"=>$res->getPerNum(), "per_nom"=>$_POST['per_nom'], "per_prenom"=>$_POST['per_prenom'],
            "per_tel"=>$_POST['per_tel'], "per_mail"=>$_POST['per_mail'], "per_login"=>$_POST['per_login'], "per_pwd"=>$_POST['per_pwd']));
        $per_modif=$modif->modifPersonne($person);

        //print_r ($per_modif);
        print_r ($person);

        if ($per_modif != null) {
            echo "Personne modifiée, c'est mieux comme ça!";
            ?>
            <img src="image/valid.png" alt="valid"><?php
        } else {
            echo "Echec de la modification !";?>
            <img src="image/erreur.png" alt="valid"><?php
        }
    }
}

?>
