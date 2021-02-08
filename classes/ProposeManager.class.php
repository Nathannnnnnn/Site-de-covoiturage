<?php
class ProposeManager{
    //A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addPropose($fonction){
        $req=$this->db->prepare('insert into propose(par_num, per_num, pro_date, pro_time, pro_place, pro_sens)
        values (:par_num, :per_num, :pro_date, :pro_time, :pro_place, :pro_sens)');

        $req->bindvalue (':par_num', $fonction->getParNum());
        $req->bindvalue (':per_num', $fonction->getPerNum());
        $req->bindvalue (':pro_date', $fonction->getProDate());
        $req->bindvalue (':pro_time', $fonction->getProTime());
        $req->bindvalue (':pro_place', $fonction->getProPlace());
        $req->bindvalue (':pro_sens', $fonction->getProSens());

        $reqExecute=$req->execute();
        return $reqExecute;
    }

    public function getAllProposePar($vil_num1, $vil_num2, $pro_date,$dateMax, $pro_time){
        $listepropose = array();
        $parcoursManager = new ParcoursManager($this->db);
        $parcours = $parcoursManager->parcoursExistePar($vil_num1,$vil_num2);
        $num = $parcours->getParNum();
        $requete=$this->db->query("SELECT * from propose where par_num = '$num' and pro_date between '$pro_date' and '$dateMax' and pro_time >= '$pro_time:00:00'");

        while($ligne = $requete->fetch(PDO::FETCH_OBJ)) {
            $listepropose[] = new Propose($ligne);
        }

        return $listepropose;
    }

    public function getAllPropose(){
        $listepropose= array();

        $sql = 'select * FROM propose';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($propose = $requete->fetch())
            $listepropose[] = new Propose($propose);

        $requete->closeCursor();
        return $listepropose;
    }

    public function getAllVilleDeDepart() {
        $listeVille= array();
        $villeManager= new VilleManager($this->db);

        $sql = "select vil_num1 as 'vil_num', vil_nom from ville v join parcours p on p.vil_num1 = v.vil_num  join propose o on o.par_num = p.par_num where pro_sens = 1
                union
                select vil_num2 as 'vil_num', vil_nom from ville v join parcours p on p.vil_num2 = v.vil_num join  propose o on o.par_num = p.par_num where pro_sens = 0";
        $req = $this->db->query($sql);
        $req->execute();

        while ($ligne = $req->fetch(PDO::FETCH_OBJ)) {
            $listeVilleDepart[] = new Ville($ligne);
        }
        return $listeVilleDepart;
    }

    public function getAllVilleArrivee($departVille_num) {
        $listeVille= array();;
        $villeManager= new VilleManager($this->db);

        $sql = "select vil_num2  as 'vil_num', vil_nom from ville v join parcours p on p.vil_num2 = v.vil_num  join propose o on o.par_num = p.par_num where pro_sens = 1 and vil_num1 = $departVille_num
                union
                select vil_num1  as 'vil_num' , vil_nom from ville v join parcours p on p.vil_num1 = v.vil_num join  propose o on o.par_num = p.par_num where pro_sens = 0 and vil_num2 = $departVille_num";
        $requete = $this->db->query($sql);

        $requete->execute();

        while ($ligne = $requete->fetch(PDO::FETCH_OBJ)) {
            $listeVilleArrive[] = new Ville($ligne);
        }
        return $listeVilleArrive;
    }

    public function trouverPar($pernum){
        $requete=$this->db->prepare
        ("SELECT * from personne where per_num= :per_num");

        //$requete->bindvalue (':per_num', $pernum->getPerNum());
        $requete-> bindValue(':per_num', $pernum);

        $requete -> execute ();

        $personne = new Personne($requete->fetch());

        return $personne;
    }
}
