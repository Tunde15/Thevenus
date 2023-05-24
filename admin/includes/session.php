<?php

class Session{

    public $id;
    public $signedin = false;

    public function __construct(){
        session_start();
        $this->check_seslogin();    
    }

    public function check_seslogin(){
        if(isset($_SESSION['id'])){
            $this->id = $_SESSION['id'];
            $this->signedin = true;
        }
        else{
            unset($this->id);
            $this->signedin = false;
        }
    }

    public function login($user){
        if($user){
            $this->id = $_SESSION['id'];
            $this->signedin = true;
        }
    }

    public function checksignin(){
        return $this->signedin;
    }
}
//$session = new Session();
?>