<?php
class SalarieManager{
	//A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addSalarie($salarie){
        $req=$this->db->prepare('insert into salarie(per_num, sal_telprof, fon_num) 
        values (:per_num, :sal_telprof, :fon_num)');

        $req->bindvalue (':per_num', $salarie->getPerNum());
        $req->bindvalue (':sal_telprof', $salarie->getSalTelprof());
        $req->bindvalue (':fon_num', $salarie->getFonNum());
        $req->execute();
    }
    public function getAllSalarie(){

        $sql = 'select * FROM salarie';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($salarie = $requete->fetch()) {
            $listesalarie[] = new Salarie($salarie);
        }

        $requete->closeCursor();

        return $listesalarie;
    }

    public function supSalarie($salarie)
    {

        $num_sal_del = $salarie;
        $sql = 'DELETE FROM salarie WHERE per_num = :per_num';
        $requete = $this->db->prepare($sql);

        $requete->bindValue(':per_num', $num_sal_del);

        $requete->execute();
        $requete->closeCursor();

        return $num_sal_del;
    }

    public function getSalarie($id){
        $req = $this->db->prepare(
            'SELECT per_num, sal_telprof, fon_num FROM salarie WHERE per_num = :per_num'
        );
        $req->bindValue(':per_num', $id);
        $req->execute();
        if ($salarie = $req->fetch(PDO::FETCH_OBJ))
        {
            $lsalarie = new Salarie($salarie);
        }
        else {
            $lsalarie = NULL;
        }
        $req->closeCursor();
        return $lsalarie;
    }
	
}