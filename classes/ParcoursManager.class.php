<?php
class ParcoursManager{
	//A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addParcours ($parcours) {
        $req=$this->db->prepare
            ('insert into parcours (par_km, vil_num1, vil_num2) values(:par_km, :vil_num1, :vil_num2)');

        $req-> bindValue(':vil_num1', $parcours->getVilleDepart());
        $req-> bindValue(':vil_num2', $parcours->getVilleArrive());
        $req-> bindValue(':par_km', $parcours->getnbKil());

        $req->execute();

    }
    public function parcoursExistePar($villeDepart, $villeArrive) {

        $requete = "SELECT par_num, vil_num1, vil_num2, par_km FROM PARCOURS WHERE (vil_num1 = '$villeDepart' and vil_num2 = '$villeArrive') or (vil_num2 = '$villeDepart' and vil_num1 = '$villeArrive')";
        $req = $this->db->query($requete);
        $parcours = $req->fetch(PDO::FETCH_OBJ);
        $p = new Parcours($parcours);
        $req->closeCursor();
        return $p;

    }
    public function parcoursExiste($parcours) {
        $requete = "SELECT * FROM PARCOURS WHERE (:vil_num1 = vil_num1 and :vil_num2 = vil_num2)
                    or (:vil_num2 = vil_num1 and :vil_num1 = vil_num2)";

        $req = $this->db->prepare ($requete);

        $req-> bindValue(':vil_num1', $parcours->getVilleDepart());
        $req-> bindValue(':vil_num2', $parcours->getVilleArrive());

        $req->execute();

        return $req-> rowCount()!=0;
    }


    public function getAllParcours(){
        $listeParcours= array();

        $sql = 'select * FROM parcours';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($parcours = $requete->fetch())
            $listeParcours[] = new Parcours($parcours);

        $requete->closeCursor();
        return $listeParcours;
    }

    public function getParcours($par_num){
        $requete = "SELECT * FROM PARCOURS WHERE :par_num = par_num";
        $req = $this->db->prepare ($requete);
        $req-> bindValue(':par_num', $par_num);
        $req->execute();
        $parcours = $req->fetch(PDO::FETCH_OBJ);
            $par = new Parcours($parcours);


        $req->closeCursor();

        return $par;

    }


}
