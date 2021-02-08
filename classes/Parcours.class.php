<?php
class Parcours{
	//A COMPLETER

		private $par_num;
		private $villeDepart;
		private $villeArrive;
		private $nbKil;


	public function __construct ($data = array()) {
        if(!empty($data)) {
            $this->affect($data);
        }
	}

	public function affect($data = array()) {
		foreach ($data as $key => $value) {
			switch ($key) {
				case "vil_num1":
					// code...
					$this->villeDepart=$value;
					break;

				case "vil_num2":
					// code...
					$this->villeArrive=$value;
					break;

					case "par_km":
						// code...
						$this->nbKil=$value;
						break;

					case "par_num":
						// code...
						$this->par_num=$value;
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
    public function getParNum()
    {
        return $this->par_num;
    }

    /**
     * @param mixed $par_num
     */
    public function setParNum($par_num)
    {
        $this->par_num = $par_num;
    }

    /**
     * @return mixed
     */
    public function getVilleDepart()
    {
        return $this->villeDepart;
    }

    /**
     * @param mixed $villeDepart
     */
    public function setVilleDepart($villeDepart)
    {
        $this->villeDepart = $villeDepart;
    }

    /**
     * @return mixed
     */
    public function getVilleArrive()
    {
        return $this->villeArrive;
    }

    /**
     * @param mixed $villeArrive
     */
    public function setVilleArrive($villeArrive)
    {
        $this->villeArrive = $villeArrive;
    }

    /**
     * @return mixed
     */
    public function getNbKil()
    {
        return $this->nbKil;
    }

    /**
     * @param mixed $nbKil
     */
    public function setNbKil($nbKil)
    {
        $this->nbKil = $nbKil;
    }



}
