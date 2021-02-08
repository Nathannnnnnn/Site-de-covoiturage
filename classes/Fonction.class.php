<?php
class Fonction{
	//A COMPLETER

    private $fon_num;
    private $fon_libelle;

    public function __construct ($data = array()) {
        if(!empty($data)) {
            $this->affect($data);
        }
    }

    public function affect($data = array()) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "fon_num":
                    // code...
                    $this->fon_num=$value;
                    break;

                case "fon_libelle":
                    // code...
                    $this->fon_libelle=$value;
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
    public function getFonNum() {
        return $this->fon_num;
    }

    /**
     * @param mixed $fon_num
     */
    public function setFonNum($fon_num): void {
        $this->fon_num = $fon_num;
    }

    /**
     * @return mixed
     */
    public function getFonLibelle() {
        return $this->fon_libelle;
    }

    /**
     * @param mixed $fon_libelle
     */
    public function setFonLibelle($fon_libelle): void {
        $this->fon_libelle = $fon_libelle;
    }

}