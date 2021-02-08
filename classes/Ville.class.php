<?php
class Ville{
	//A COMPLETER

    private $vil_num;
  private $vil_nom;

  function __construct($valeurs = array()){
    if(!empty($valeurs)){
      $this->affecte($valeurs);
    }
  }

  private function affecte($donnees){
    foreach ($donnees as $attribut => $valeur) {
      switch ($attribut) {
        case 'vil_num': $this->vil_num = $valeur; break;
        case 'vil_nom': $this->vil_nom = $valeur; break;
      }
    }
  }

	public function getNom() {
		return $this->vil_nom;
	}

	public function getNum() {
		return $this->vil_num;
	}

	public function setNom($vil_nom) {
		$this->vil_nom = $vil_nom;
	}

	public function setNum($vil_num) {
		$this->vil_num = $vil_num;
	}

}
