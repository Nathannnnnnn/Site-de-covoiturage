<?php
class EtudiantManager{
	//A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addEtudiant($person){
        $req=$this->db->prepare
        ('insert into etudiant(per_num, dep_num, div_num) 
            values (:per_num, :dep_num, :div_num)');

        $req->bindvalue (':per_num', $person->getPerNum());
        $req->bindvalue (':dep_num', $person->getDepNum());
        $req->bindvalue (':div_num', $person->getDivNum());

        $req -> execute ();
    }
    public function getEtuByNum($per_num){
        $etudiant = array();

        $sql = "SELECT * FROM etudiant WHERE per_num = $per_num";

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($pers = $requete->fetch())
            $etudiant = new Etudiant($pers);

        $requete->closeCursor();
        return $etudiant;
    }

    public function getEtudiant($id){
        $req = $this->db->prepare(
            'SELECT per_num, dep_num, div_num FROM etudiant WHERE per_num = :per_num'
        );
        $req->bindValue(':per_num', $id);
        $req->execute();
        if ($etudiant = $req->fetch(PDO::FETCH_OBJ))
        {
            $lEtudiant = new Etudiant($etudiant);
        }
        else {
            $lEtudiant = NULL;
        }
        $req->closeCursor();
        return $lEtudiant;
    }

    public function supEtudiant($etudiant) {
        $num_etu_del = $etudiant;

        $sql = 'DELETE FROM etudiant WHERE per_num = :per_num';
        $requete = $this->db->prepare($sql);

        $requete->bindValue(':per_num', $num_etu_del);

        $requete->execute();
        $requete->closeCursor();

        return $num_etu_del;
    }
}