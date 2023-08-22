<?php


// ! This file will only pass data to signup class for verification

// //* Include classes files
include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
include "../../classes/signup-class/signup-connecttodb-class.php"; //* Include Connection process class
include "../../classes/signup-class/signupprocess-class.php"; //* Include Connection process class


//*Passing data from the form
if (isset($_POST['signupbut'])) {
    $user_rank = $_POST['user_rank'];
    $user_serialnumber = $_POST['user_serialnumber'];
    $user_type = $_POST['user_type'];
    $user_gender = $_POST['user_gender'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_confpassword = $_POST['user_confpassword'];
}
//*Passing data from the form

//* Pass data from this file to signupprocess-class.php
$passto_signup_process_class = new signupentry(
    $user_rank,
    $user_serialnumber,
    $user_type,
    $user_gender,
    $user_firstname,
    $user_lastname,
    $user_username,
    $user_password,
    $user_confpassword
);

//* This is to instantiate method for all error handlers (Pass or fail0)
$passto_signup_process_class->signupentry_signupcheckerrors();
