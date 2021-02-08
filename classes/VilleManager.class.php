<?php
class VilleManager{
	private $db;

		public function __construct($db){
			$this->db = $db;
		}

        public function add($ville){
                $requete = $this->db->prepare(
                'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');

                $requete->bindValue(':vil_nom',$ville->getNom());
                $retour=$requete->execute();
                return $retour;
        }

		public function getAllVille(){
						$listeVille= array();

						$sql = 'select vil_num, vil_nom FROM ville';

						$requete = $this->db->prepare($sql);
						$requete->execute();

						while ($ville = $requete->fetch(PDO::FETCH_OBJ))
								$listeVille[] = new Ville($ville);

						$requete->closeCursor();
						return $listeVille;
		}

		public function compteurVille(){
						$sql = 'select COUNT(vil_num) as nombre FROM ville';
						$requete = $this->db->prepare($sql);
						$requete->execute();

						$nbr = $requete->fetch()['nombre'];
						return $nbr;
		}

    public function getVille($dep_num) {
        $req=$this->db->prepare
        ('SELECT vil_num, vil_nom FROM ville where vil_num=:vil_num');

        $req->bindvalue (':vil_num', $dep_num);

        $req->execute();

        if ($ville = $req->fetch(PDO::FETCH_OBJ))
        {
            $lVille = new Ville($ville);
        }
        else {
            $lVille = NULL;
        }
        $req->closeCursor();
        return $lVille;
    }

    public function getVilleNom($num) {
        $sql = "SELECT vil_nom FROM ville WHERE vil_num = :num;";
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':num', $num);

        $requete->execute();

        return $requete->fetch(PDO::FETCH_NUM)[0];
    }

    public function getVilleNum($ville) {
        $req=$this->db->prepare
        ('SELECT vil_num, vil_nom FROM ville where vil_num=:vil_num');

        $req->bindvalue (':vil_num', $ville);

        $req->execute();

        if ($ville = $req->fetch(PDO::FETCH_OBJ))
        {
            $lVille = new Ville($ville);
        }
        else {
            $lVille = NULL;
        }
        $req->closeCursor();
        return $lVille;
    }

		public function getAllVilleDeDepartPar() {
				$listeVille= array();
				$villeManager= new VilleManager($this->db);

				$sql = "select vil_num1 as 'vil_num', vil_nom from ville v join parcours p on p.vil_num1 = v.vil_num
								union
								select vil_num2 as 'vil_num', vil_nom from ville v join parcours p on p.vil_num2 = v.vil_num";
				$req = $this->db->query($sql);
				$req->execute();

				while ($ligne = $req->fetch(PDO::FETCH_OBJ)) {
						$listeVilleDepart[] = new Ville($ligne);
				}
				return $listeVilleDepart;
		}

		public function getAllVilleArriveePar($departVille_num) {
				$listeVille= array();;
				$villeManager= new VilleManager($this->db);

				$sql = "select vil_num2  as 'vil_num', vil_nom from ville v join parcours p on p.vil_num2 = v.vil_num and vil_num1 = $departVille_num
								union
								select vil_num1  as 'vil_num' , vil_nom from ville v join parcours p on p.vil_num1 = v.vil_num  and vil_num2 = $departVille_num";
				$requete = $this->db->query($sql);

				$requete->execute();

				while ($ligne = $requete->fetch(PDO::FETCH_OBJ)) {
						$listeVilleArrive[] = new Ville($ligne);
				}
				return $listeVilleArrive;
		}

}

?>
