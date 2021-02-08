<?php //A COMPLETER
class Division{
    private $div_num;
    private $div_nom;

    public function __construct (array $data) {
        if(!empty($data)) {
            $this->affect($data);
        }
    }

    public function affect(array $data) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "div_num":
                    // code...
                    $this->div_num=$value;
                    break;
                case "div_nom":
                    // code...
                    $this->div_nom=$value;
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
    public function getDivNum() {
        return $this->div_num;
    }

    /**
     * @param mixed $div_num
     */
    public function setDivNum($div_num): void {
        $this->div_num = $div_num;
    }

    /**
     * @return mixed
     */
    public function getDivNom() {
        return $this->div_nom;
    }

    /**
     * @param mixed $div_nom
     */
    public function setDivNom($div_nom): void {
        $this->div_nom = $div_nom;
    }

	
}