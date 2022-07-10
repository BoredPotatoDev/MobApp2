<?php

class LoginUser{
    // class properties
    private $FamilyName;
    private $StudentNumber;
    public $error;
    public $success;
    private $storage = "login.json";
    private $stored_users;


    // class methods
    public function __construct($FamilyName, $StudentNumber){
        $this->FamilyName = $FamilyName;
        $this->password = $StudentNumber;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->login();
    }

    private function login(){
        foreach($this->stored_users as $user) {
            if($user['FamilyName'] == $this->FamilyName){
                if(password_verify($this->StudentNumber, $user['password'])){
                    session_start();
                    $_SESSION['user'] = $this->FamilyName;
                    header("location: account.php"); exit();
                }
            }
        }
        return $this->error = "Incorrect username or password. Double check your information.";
    }
}