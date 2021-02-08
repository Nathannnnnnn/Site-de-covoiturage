<?php //A COMPLETER
class DepartementManager{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addDepartement($departement){
        $req=$this->db->prepare('insert into departement(dep_num, dep_nom, vil_num) 
        values (:dep_num, :dep_nom, :vil_num)');

        $req->bindvalue (':dep_num', $departement->getDepNum());
        $req->bindvalue (':dep_nom', $departement->getDepNom());
        $req->bindvalue (':vil_num', $departement->getVilNum());

        $req->execute();
    }

    /**
     * @return array
     */
    public function getAllDepartement(){
        $listedepartement= array();

        $sql = 'select * FROM departement';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($departement = $requete->fetch())
            $listedepartement[] = new Departement($departement);

        $requete->closeCursor();
        return $listedepartement;
    }


    public function getDepartement($dep_num) {
        $req=$this->db->prepare
        ('SELECT dep_num, dep_nom, vil_num FROM departement where dep_num='.$dep_num);

        $req->execute();

        if ($dep = $req->fetch(PDO::FETCH_OBJ))
        {
            $ldep = new Departement($dep);
        }
        else {
            $ldep = NULL;
        }
        $req->closeCursor();
        return $ldep;
    }
}