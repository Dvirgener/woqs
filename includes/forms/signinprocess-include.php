<?php


// ! THIS FILE WILL RECIEVE DATA FROM THE SIGNIN.PHP FILE AND PASS IT TO SIGNINPROCESS-CLASS.PHP


//* Include classes files
include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
include "../../classes/signin-class/signin-connecttodb-class.php"; //* Include Connection process class
include "../../classes/signin-class/signinprocess-class.php"; //* Include Connection process class


//*Passing data from the form
if (isset($_POST['signinbut'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
}
//*Passing data from the form

//* Pass data from this file to signinprocess-class.php
$passto_signup_process_class = new signinentry(

    $user_username,
    $user_password
);

//* This is to instantiate method for all error handlers (Pass or fail)
$passto_signup_process_class->signinentry_signincheckerrors();
