<?php

class RegisterUser{
    private $FamilyName;
    private $StudentNumber;
    private $DateofBirth;
    public $error;
    public $success;
    private $storage = "login.json";
    private $stored_users;
    private $new_user;

	public function __construct($FamilyName, $StudentNumber, $DateofBirth){

		$this->FamilyName = trim($this->FamilyName);
		$this->FamilyName = filter_var($FamilyName, FILTER_SANITIZE_STRING);

		$this->StudentNumber = trim($this->StudentNumber);
        $this->StudentNumber = filter_var($StudentNumber, FILTER_SANITIZE_STRING);

        $this->DateofBirth = trim($this->DateofBirth);
		$this->DateofBirth = filter_var($DateofBirth, FILTER_SANITIZE_STRING);

		$this->stored_users = json_decode(file_get_contents($this->storage), true);

		$this->new_user = [
			"Family Name" => $this->FamilyName,
			"Student Number" => $this->StudentNumber,
            "Date of Birth" => $this->DateofBirth,
		];

		if($this->checkFieldValues()){
			$this->insertUser();
		}
	}

    private function checkFieldValues(){
        if(empty($this->FamilyName) || empty($this->StudentNumber) || empty($this->DateofBirth)){
            $this->error = "ALL FIELDS ARE REQUIRED";
            return false;
        }else{
            return true;
        }
    }

    private function usernameExists(){
        foreach($this->stored_users as $user){
            if($this->FamilyName == $user['Family Name']){
                $this->error = "You Already Have an Account!";
                return true;
            }
        }
        return false;
    }

    private function insertUser(){
        if($this->usernameExists() == FALSE){
            array_push($this->stored_users, $this->new_user);
            if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
                return $this->success = "You have been added to the database";
            }else
                return $this->success = "Something went wrong";
        }
    }
}