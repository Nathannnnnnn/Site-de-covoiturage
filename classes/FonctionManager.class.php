<?php
class FonctionManager{
	//A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addFonction($fonction){
        $req=$this->db->prepare('insert into fonction(fon_num, fon_libelle) 
        values (:fon_num, :fon_libelle)');

        $req->bindvalue (':fon_num', $fonction->getFonNum());
        $req->bindvalue (':fon_libelle', $fonction->getFonLibelle());

        $req->execute();
    }

    public function getAllFonction(){
        $listefonction= array();

        $sql = 'select * FROM fonction';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($fonction = $requete->fetch()) {
            $listefonction[] = new Fonction($fonction);
        }

        $requete->closeCursor();
        return $listefonction;
    }

    public function getFonction($id){
        $req = $this->db->prepare(
            'SELECT fon_num, fon_libelle FROM fonction WHERE fon_num = :fon_num'
        );
        $req->bindValue(':fon_num', $id);
        $req->execute();
        if ($fonction = $req->fetch(PDO::FETCH_OBJ))
        {
            $lfonction = new Fonction($fonction);
        }
        else {
            $lfonction = NULL;
        }
        $req->closeCursor();
        return $lfonction;
    }
}