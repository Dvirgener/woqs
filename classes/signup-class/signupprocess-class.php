<?php

// ! THIS FILE WILL RECIEVE DATA FROM THE SIGNUPPROCESS-INCLUDE.PHP FILE AND WILL CHECK FOR ERRORS IN INSERTING DATA


// * Signup process class - this class will check all requirements needed before going to the signuppassedclass and connect to db
class signupentry extends signuppassed
{
    // * Set properties for this class
    private $user_rank;
    private $user_serialnumber;
    private $user_type;
    private $user_gender;
    private $user_firstname;
    private $user_lastname;
    private $user_username;
    private $user_password;
    private $user_confpassword;
    public function __construct(
        //* Construct values to this class from the include file
        $user_rank,
        $user_serialnumber,
        $user_type,
        $user_gender,
        $user_firstname,
        $user_lastname,
        $user_username,
        $user_password,
        $user_confpassword
    ) {
        //* assign values to this class from the construct Variables
        $this->user_rank = $user_rank;
        $this->user_serialnumber = $user_serialnumber;
        $this->user_type = $user_type;
        $this->user_gender = $user_gender;
        $this->user_firstname = $user_firstname;
        $this->user_lastname = $user_lastname;
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->user_confpassword = $user_confpassword;
    }
    //* This method will check for any errors prior to sign up
    public function signupentry_signupcheckerrors()
    {
        if ($this->signupentry_check_user_exist() == true) {
            header("location: ../../main/signup.php?user=usertaken&rank=" . $this->user_rank . "&serialnumber=" . $this->user_serialnumber . "&type=" . $this->user_type . "&gender=" . $this->user_gender . "&fname=" . $this->user_firstname . "&lname=" . $this->user_lastname);
            exit();
        }
        if ($this->signupentry_check_password() == true) {
            header("location: ../../main/signup.php?user=passnotmatch&rank=" . $this->user_rank . "&serialnumber=" . $this->user_serialnumber . "&type=" . $this->user_type . "&gender=" . $this->user_gender . "&fname=" . $this->user_firstname . "&lname=" . $this->user_lastname . "&uname=" . $this->user_username);
            exit();
        }
        $this->signuppassed_signupuser(
            //* Pass values to signupuser method in the signuppassed class
            $this->user_firstname,
            $this->user_lastname,
            $this->user_serialnumber,
            $this->user_rank,
            $this->user_type,
            $this->user_gender,
            $this->user_username,
            $this->user_password
        );
        header("location: ../main/signup.php?success=success");
        exit();
    }
    //* This method will check for any errors prior to sign up
    // * this is to check if username entered already exist
    private function signupentry_check_user_exist()
    {
        $usernamechecker = $this->signuppassed_check_username($this->user_username);
        if ($usernamechecker == true) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    // * this is to check if username entered already exist
    // * this is to check if password and confpass match
    private function signupentry_check_password()
    {
        if ($this->user_password == $this->user_confpassword) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    // * this is to check if password and confpass match
}
// * Signup process class - this class will check all requirements needed before going to the signuppassedclass and connect to db
