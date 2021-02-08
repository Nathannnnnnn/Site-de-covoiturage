<?php
class Departement{
	//A COMPLETER

    private $dep_num;
    private $dep_nom;
    private $vil_num;

    public function __construct ($data = array()) {
        if(!empty($data)) {
            $this->affect($data);
        }
    }

    public function affect($data = array()) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "dep_num":
                    // code...
                    $this->dep_num=$value;
                    break;
                case "dep_nom":
                    // code...
                    $this->dep_nom=$value;
                    break;
                case "vil_num":
                    // code...
                    $this->vil_num=$value;
                    break;

                default:
                    // code...
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getDepNum() {
        return $this->dep_num;
    }

    /**
     * @param mixed $dep_num
     */
    public function setDepNum($dep_num): void {
        $this->dep_num = $dep_num;
    }

    /**
     * @return mixed
     */
    public function getDepNom() {
        return $this->dep_nom;
    }

    /**
     * @param mixed $dep_nom
     */
    public function setDepNom($dep_nom): void {
        $this->dep_nom = $dep_nom;
    }

    /**
     * @return mixed
     */
    public function getVilNum() {
        return $this->vil_num;
    }

    /**
     * @param mixed $vil_num
     */
    public function setVilNum($vil_num): void {
        $this->vil_num = $vil_num;
    }

}