<?php
class Etudiant{
	//A COMPLETER

    private $per_num;
    private $dep_num;
    private $div_num;

    public function __construct ($data = array()) {
        if(!empty($data)) {
            $this->affect($data);
        }
    }

    public function affect($data = array()) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "per_num":
                    // code...
                    $this -> per_num = $value;
                    break;
                case "dep_num":
                    // code...
                    $this -> dep_num = $value;
                    break;
                case "div_num":
                    // code...
                    $this -> div_num = $value;
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getPerNum() {
        return $this -> per_num;
    }

    /**
     * @param mixed $per_num
     */
    public function setPerNum($per_num): void {
        $this -> per_num = $per_num;
    }

    /**
     * @return mixed
     */
    public function getDepNum() {
        return $this -> dep_num;
    }

    /**
     * @param mixed $dep_num
     */
    public function setDepNum($dep_num): void {
        $this -> dep_num = $dep_num;
    }

    /**
     * @return mixed
     */
    public function getDivNum() {
        return $this -> div_num;
    }

    /**
     * @param mixed $div_num
     */
    public function setDivNum($div_num): void {
        $this -> div_num = $div_num;
    }


	
}