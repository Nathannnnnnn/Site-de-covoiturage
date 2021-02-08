<?php
class Salarie{
	//A COMPLETER

    private $per_num;
    private $sal_telprof;
    private $fon_num;

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
                case "sal_telprof":
                    // code...
                    $this->sal_telprof=$value;
                    break;
                case "fon_num":
                    // code...
                    $this->fon_num=$value;
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
    public function getPerNum() {
        return $this->per_num;
    }

    /**
     * @param mixed $per_num
     */
    public function setPerNum($per_num): void {
        $this->per_num = $per_num;
    }

    /**
     * @return mixed
     */
    public function getSalTelprof() {
        return $this->sal_telprof;
    }

    /**
     * @param mixed $sal_telprof
     */
    public function setSalTelprof($sal_telprof): void {
        $this->sal_telprof = $sal_telprof;
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


}