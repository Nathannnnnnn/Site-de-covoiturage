<?php
class Personne{
	//A COMPLETER

    private $per_num;
    private $per_nom;
    private $per_prenom;
    private $per_tel;
    private $per_mail;
    private $per_login;
    private $per_pwd;

    public function __construct (array $data) {
        if(!empty($data)) {
            $this->affect($data);
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
    public function getPerNom() {
        return $this->per_nom;
    }

    /**
     * @param mixed $per_nom
     */
    public function setPerNom($per_nom): void {
        $this->per_nom = $per_nom;
    }

    /**
     * @return mixed
     */
    public function getPerPrenom() {
        return $this->per_prenom;
    }

    /**
     * @param mixed $per_prenom
     */
    public function setPerPrenom($per_prenom): void {
        $this->per_prenom = $per_prenom;
    }

    /**
     * @return mixed
     */
    public function getPerTel() {
        return $this->per_tel;
    }

    /**
     * @param mixed $per_tel
     */
    public function setPerTel($per_tel): void {
        $this->per_tel = $per_tel;
    }

    /**
     * @return mixed
     */
    public function getPerMail() {
        return $this->per_mail;
    }

    /**
     * @param mixed $per_mail
     */
    public function setPerMail($per_mail): void {
        $this->per_mail = $per_mail;
    }

    /**
     * @return mixed
     */
    public function getPerLogin() {
        return $this->per_login;
    }

    /**
     * @param mixed $per_login
     */
    public function setPerLogin($per_login): void {
        $this->per_login = $per_login;
    }

    /**
     * @return mixed
     */
    public function getPerPwd() {
        return $this->per_pwd;
    }

    /**
     * @param mixed $per_pwd
     */
    public function setPerPwd($per_pwd): void {
        $this->per_pwd = $per_pwd;
    }

    public function affect(array $data) {
        foreach ($data as $key => $value) {
            switch ($key) {
                case "per_num":
                    // code...
                    $this->per_num=$value;
                    break;
                case "per_nom":
                    // code...
                    $this->per_nom=$value;
                    break;
                case "per_prenom":
                    // code...
                    $this->per_prenom=$value;
                    break;
                case "per_tel":
                    // code...
                    $this->per_tel=$value;
                    break;
                case "per_mail":
                    // code...
                    $this->per_mail=$value;
                    break;
                case "per_login":
                    // code...
                    $this->per_login=$value;
                    break;
                case "per_pwd":
                    // code...
                    $this->per_pwd=$value;
                    break;

                default:
                    // code...
                    break;
            }
        }
    }
}