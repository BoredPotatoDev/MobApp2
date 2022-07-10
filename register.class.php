<?php

class RegisterUser{
    private $FN;
    private $SN;
    private $DoB;
    public $error;
    public $success;
    private $storage = "login.json";
    private $stored_users;
    private $new_user;

    public function __construct($FN, $SN, $DoB){
        $this->FN = trim($this->FN);
        $this->username = filter_var($FN, FILTER_SANITIZED_STRING);

        $this->SN = trim($this->FN);
        $this->STDNTnumber = filter_var($SN, FILTER_SANITIZED_STRING);

        $this->DoB = trim($this->FN);
        $this->date = filter_var($DoB, FILTER_SANITIZED_STRING);

        $this->stored_users = json_decode(file_get_contents($this->storage),true);

        $this->new_user = [
            "username" => $this->FN,
            "STDNTnumber" => $this->SN,
            "date" => $this->DoB,
        ];

        if($this->checkFieldValues()){
            $this->insertUser();
        }
    }

    private function checkFieldValues(){
        if(empty($this->username) || empty($this->STDNTnumber) || empty($this->date)){
            $this->error = "ALL FIELDS ARE REQUIRED";
            return false;
        }else{
            return true;
        }
    }

    private function usernameExist(){
        foreach($this->stored_users as $user){
            if($this->username == $user['username']){
                $this->error = "You Already Have an Account!";
                return true;
            }
        }
        return false;
    }

    private function insertUser(){
        if($this->udernameExist() == FALSE){
            array_push($this->stored_users, $this->new_user);
            if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
                return $this->success = "You have been added to the database";
            }else
                return $this->success = "Something went wrong";
        }
    }
}