<?php
if (empty($_POST['nom_user'])) {
   ?>

    <h1>Pour vous connecter</h1>

    <form method="post" action="#">
        <label for="nom_user">Nom d'utilisateur</label>
            <input type="text" required name="nom_user" placeholder="Nom d'utilisateur..."/>

        <br>

        <label>
            Mot de passe</label>
            <input type="password" required name="pwd_user" placeholder="Mot de passe..."/>

        <br>

        <label>
            <?php
            $aleatoire = rand(1, 9);
            $aleatoire2 = rand(1, 9);
            $_SESSION['aleatoire']=$aleatoire;
            $_SESSION['aleatoire2']=$aleatoire2;

            echo "<img src='image/nb/". $aleatoire.".jpg' alt='img'>";
    ?>
            +

            <?php
            echo "<img src='image/nb/". $aleatoire2.".jpg' alt='img'>";
            ?>

            =
        </label>
        <input type="number" required name="resultat" placeholder="Résultat"/>

        <br>
        <input type="submit" value="Valider"/>
    </form>
<?php
}

if (!empty($_POST['nom_user'])) {

    $role = new PersonneManager($db);
    $res=$_SESSION['aleatoire']+$_SESSION['aleatoire2'];
    $_SESSION['resultat']=($_POST['resultat']);

    $salt="48@!asld";
    $password_crypte=sha1(sha1($_POST['pwd_user']).$salt);
    $personne= $role->trouverParNom($_POST["nom_user"], $password_crypte);


    if (!$personne) {
        echo "Login ou mot de passe incorrect";
    } else {
        if ($res == $_POST['resultat']) {
            $nom_user = $_POST['nom_user'];

            $_SESSION['nom_user'] = $nom_user;
            header('Location: index.php?page=0');
        } else {
            echo 'Résultat incorrect';
        }
    }
}
?>