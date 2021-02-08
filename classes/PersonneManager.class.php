<?php
class PersonneManager{
	//A COMPLETER
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function addPerson($person){
        $req=$this->db->prepare
            ('insert into personne(per_nom, per_prenom, per_tel, per_mail, per_login, per_pwd)
            values (:per_nom, :per_prenom, :per_tel, :per_mail, :per_login, :per_pwd)');

        $req->bindvalue (':per_nom', $person->getPerNom());
        $req->bindvalue (':per_prenom', $person->getPerPrenom());
        $req->bindvalue (':per_tel', $person->getPerTel());
        $req->bindvalue (':per_mail', $person->getPerMail());
        $req->bindvalue (':per_login', $person->getPerLogin());
        $req->bindvalue (':per_pwd', $person->getPerPwd());

        $req -> execute ();

        $num=$this->db->lastInsertId();
        return $num;

    }

    public function getAllPerson(){
        $listeperson= array();

        $sql = 'select * FROM personne';

        $requete = $this->db->prepare($sql);
        $requete->execute();

        while ($person = $requete->fetch())
            $listeperson[] = new Personne($person);

        $requete->closeCursor();
        return $listeperson;
    }

    public function trouverNumParlog($per_login){
        $requete=$this->db->query("SELECT per_num FROM PERSONNE where per_login = '$per_login'");
        			$result = $requete->fetch(PDO::FETCH_ASSOC);
        			$num = $result['per_num'];
        			$requete->closeCursor();
        			return $num;
    }

    public function trouverNum($person){
        $requete=$this->db->prepare
        ('SELECT per_num FROM PERSONNE where per_mail = :mail');

        $requete->bindvalue (':mail', $person->getPerMail());

        $requete -> execute ();

        return $requete;
    }

    public function trouver($pernum){
        $requete=$this->db->prepare
        ("SELECT * from personne where per_num=".$pernum);

        //$requete->bindvalue (':per_num', $pernum->getPerNum());

        $requete -> execute ();
        while ($pers = $requete->fetch())
            $personne = new Personne($pers);

        return $personne;
    }


    public function isEtudiant($per_num) {
    			$requete = $this->db->query("SELECT IF(COUNT(per_num) > 0, 'true', 'false') as esEtu FROM etudiant WHERE per_num = '$per_num'");
    			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
    			$requete->closeCursor();
    			return $resultat['esEtu'];
    		}

    public function passwordOk($res, $rand, $rand2){
        $rep=$res-($rand + $rand2);
        if ($rep==0) return true;
        else return false;
    }

    public function trouverParNom($perlogin, $permdp){
        $requete=$this->db->prepare
        ("SELECT * from personne where per_login='".$perlogin."' and per_pwd='".$permdp."'");

        $requete -> execute ();

        return $requete->fetch(PDO::FETCH_ASSOC);
    }

    public function supPersonne($personne, $fonction) {
      if ($fonction == 1) {
            $table = 'etudiant';
        } else {
            $table = 'salarie';
        }

        $requete = $this->db->prepare("delete from $table where per_num = '$personne'");
        $ret = $requete->execute();
        $requete->closeCursor();

        $req = $this->db->prepare("delete from propose where per_num = '$personne'");
        $ret = $req->execute();
        $req->closeCursor();

        $sql = $this->db->prepare("delete from personne where per_num = '$personne'");
        $ret = $sql->execute();
        $sql->closeCursor();

        return $ret;
    }

    public function modifPersonne($personne) {
        //print_r ($personne);

        $per_num = $personne->getPerNum();
        $per_nom= $personne->getPerNom();
        $per_prenom= $personne->getPerPrenom();
        $per_tel= $personne->getPerTel();
        $per_mail= $personne->getPerMail();

        $sql=("UPDATE personne SET per_nom='$per_nom', per_prenom='$per_prenom', per_mail='$per_mail', per_tel='$per_tel' WHERE per_num=$per_num");
        $requete = $this->db->prepare($sql);
        $retour = $requete->execute();

        $requete->closeCursor();
        return $retour;
    }

    public function getAvis($per_num){
        $sql = "select avi_comm from avis where per_num = '$per_num' order by avi_date DESC";
        $requete=$this->db->query($sql);
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return $result['avi_comm'];
    }

    public function getMoyNote($per_num){
        $sql =  "select AVG(avi_note) as moyenne from avis where per_num = '$per_num' group by per_num";
        $requete=$this->db->query($sql);
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        return number_format ( $result['moyenne'], 2  );
    }

}
