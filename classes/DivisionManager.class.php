<?php //A COMPLETER
class DivisionManager{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addDivision($division){
        $req=$this->db->prepare('insert into division(div_num, div_nom) 
        values (:div_num, :div_nom)');

        $req->bindvalue (':div_num', $division->getDivNum());
        $req->bindvalue (':div_nom', $division->getDivNom());

        $req->execute();
    }

    public function getAllDivision(){
        $listedivision= array();

        $sql = 'select * FROM division';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($division = $requete->fetch())
            $listedivision[] = new Division($division);

        $requete->closeCursor();
        return $listedivision;
    }
	
}