<?php

// ! THIS FILE WILL RECIEVE DATA FROM THE SIGNUPPROCESS-INCLUDE.PHP FILE AND WILL CHECK FOR ERRORS IN INSERTING DATA


// * Signin process class - this class will check all requirements needed before going to the signinpassedclass and connect to db
class signinentry extends signinpassed
{
    // * Set properties for this class
    private $user_username;
    private $user_password;
    public function __construct(
        //* Construct values to this class from the include file
        $user_username,
        $user_password
    ) {
        //* assign values to this class from the construct Variables
        $this->user_username = $user_username;
        $this->user_password = $user_password;
    }
    //* This method will check for any errors prior to sign in
    public function signinentry_signincheckerrors()
    {
        if ($this->signinpassed_check_username($this->user_username) == false) {
            header("location: ../../main/signin.php?user=usernotexist");
            exit();
        }
        if ($this->signinpassed_check_password($this->user_username, $this->user_password) == false) {
            header("location: ../../main/signin.php?user=passinvalid");
            exit();
        }
        header("location: ../../main/reviseddashboard.php");
        exit();
    }
    //* This method will check for any errors prior to sign in
}
// * Signin process class - this class will check all requirements needed before going to the signinpassedclass and connect to db
