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

	public function __construct($FN, $SN , $DoB){

		$this->FN = trim($this->FN);
		$this->username = filter_var($FN, FILTER_SANITIZE_STRING);

		$this->SN = trim($this->SN);
		$this->STDNTnumber = filter_var($SN, FILTER_SANITIZE_STRING);

        $this->DoB = trim($this->DoB);
		$this->Date_of_Birth = filter_var($DoB, FILTER_SANITIZE_STRING);

		$this->stored_users = json_decode(file_get_contents($this->storage), true);

		$this->new_user = [
			"username" => $this->FN,
			"STDNTnumber" => $this->SN,
            "Date_of_Birth" => $this->DoB,
		];

		if($this->checkFieldValues()){
			$this->insertUser();
		}
	}

    private function checkFieldValues(){
        if(empty($this->username) || empty($this->STDNTnumber) || empty($this->Date_of_Birth)){
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
		if($this->usernameExists() == FALSE){
			array_push($this->stored_users, $this->new_user);
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				return $this->success = "Your registration was successful";
			}else{
				return $this->error = "Something went wrong, please try again";
			}
		}
	}
}