<?php
class Propose{
    //A COMPLETER

    private $par_num;
    private $per_num;
    private $pro_date;
    private $pro_time;
    private $pro_place;
    private $pro_sens;

    public function __construct ($data = array()) {
        if(!empty($data)) {
            $this->affect($data);
        }
    }

    public function affect($data = array()) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'par_num':
                    $this->par_num=$value;
                    break;

                case 'per_num':
                    $this->per_num=$value;
                    break;

                case 'pro_date':
                    $this->pro_date=$value;
                    break;

                case 'pro_time':
                    $this->pro_time=$value;
                    break;

                case 'pro_place':
                    $this->pro_place=$value;
                    break;

                case 'pro_sens':
                    $this->pro_sens=$value;
                    break;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getParNum() {
        return $this->par_num;
    }

    /**
     * @param mixed $par_num
     */
    public function setParNum($par_num): void {
        $this->par_num = $par_num;
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
    public function getProDate() {
        return $this->pro_date;
    }

    /**
     * @param mixed $pro_dat
     */
    public function setProDate($pro_date): void {
        $this->pro_date = $pro_date;
    }

    /**
     * @return mixed
     */
    public function getProTime() {
        return $this->pro_time;
    }

    /**
     * @param mixed $pro_time
     */
    public function setProTime($pro_time): void {
        $this->pro_time = $pro_time;
    }

    /**
     * @return mixed
     */
    public function getProPlace() {
        return $this->pro_place;
    }

    /**
     * @param mixed $pro_place
     */
    public function setProPlace($pro_place): void {
        $this->pro_place = $pro_place;
    }

    /**
     * @return mixed
     */
    public function getProSens() {
        return $this->pro_sens;
    }

    /**
     * @param mixed $pro_sens
     */
    public function setProSens($pro_sens): void {
        $this->pro_sens = $pro_sens;
    }

}
