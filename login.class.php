<?php

class LoginUser{
    // class properties
    private $FamilyName;
    private $StudentNumber;
    private $DateofBirth;
    public $error;
    public $success;
    private $storage = "login.json";
    private $stored_users;


    // class methods
    public function __construct($FamilyName, $StudentNumber, $DateofBirth){
        $this->FamilyName = $FamilyName;
        $this->StudentNumber = $StudentNumber;
        $this->DateofBirth = $DateofBirth;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->login();
    }

    private function login(){
        foreach($this->stored_users as $user) {
            if($user['Family Name'] == $this->FamilyName and $user['Student Number'] == $this->StudentNumber and $user['Date of Birth'] == $this->DateofBirth){
                    session_start();
                    $_SESSION['user'] = $this->FamilyName;
                    header("location: account.php"); exit();
                }
        }
        return $this->error = "One of your Information is Incorrect. Double check your information.";
    }
}