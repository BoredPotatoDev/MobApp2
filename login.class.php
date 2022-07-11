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
            if($user['Family Name'] == $this->FamilyName || $user['Student Number'] == $this->StudentNumber || $user['DateofBirth'] == $this->DateofBirth){
                    session_start();
                    $_SESSION['user'] = $this->FamilyName;
                    header("location: account.php"); exit();
                }
        }
        return $this->error = "One of you Information is Incorrect. Double check your information.";
    }
}