<?php

// * this class will be the one incharge to access the DB
class signuppassed extends connectiontodb
{
    // * This method will check if a username already exist in db and return a true/false value back to signupprocess class
    public function signuppassed_check_username($user_username)
    {
        $checkusernamequery_stmt = "SELECT * FROM logistics_users WHERE user_username = '$user_username'";
        $checkusername = mysqli_query($this->connect(), $checkusernamequery_stmt);
        $nr_of_rows = mysqli_num_rows($checkusername);
        $result = "";
        if ($nr_of_rows > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    // * This method will check if a username already exist in db and return a true/false value back to signupprocess class

    // * This method will pass data to db and save it 

    public function signuppassed_signupuser(
        // * this is the list of variables to be passed to this signupuser function
        $user_firstname,
        $user_lastname,
        $user_serialnumber,
        $user_rank,
        $user_type,
        $user_gender,
        $user_username,
        $user_password
    ) {

        // * Assigning Actual Rank to user
        switch ($user_rank) {
            case 1:
                if ($user_gender == "Male") {
                    $user_actualrank = "AM";
                } else {
                    $user_actualrank = "AW";
                }
                break;
            case 2:
                if ($user_gender == "Male") {
                    $user_actualrank = "A2C";
                } else {
                    $user_actualrank = "AW2C";
                }
                break;
            case 3:
                if ($user_gender == "Male") {
                    $user_actualrank = "A1C";
                } else {
                    $user_actualrank = "AW1C";
                }
                break;
            case 4:
                $user_actualrank = "SGT";
                break;
            case 5:
                $user_actualrank = "SSG";
                break;
            case 6:
                $user_actualrank = "TSG";
                break;
            case 7:
                $user_actualrank = "MSG";
                break;
            case 8:
                $user_actualrank = "2LT";
                break;
            case 9:
                $user_actualrank = "1LT";
                break;
            case 10:
                $user_actualrank = "CPT";
                break;
            case 11:
                $user_actualrank = "MAJ";
                break;
            case 12:
                $user_actualrank = "LTC";
                break;
            case 13:
                $user_actualrank = "COL";
                break;
        }
        $user_status = "ON DUTY";
        // * Assigning Actual Rank to user
        // * Assigning Classification to User
        if ($user_rank <= 7) {
            $user_class = "EP";
        } else {
            $user_class = "OFFICER";
        }
        // * Assigning Classification to User

        // * Hash password
        $hashed = password_hash($user_password, PASSWORD_DEFAULT);

        $siupuser_stmt =
            "INSERT INTO `logistics_users`(
            `user_firstname`, 
            `user_lastname`, 
            `user_serialnumber`, 
            `user_rank`, 
            `user_actualrank`, 
            `user_type`, 
            `user_gender`, 
            `user_username`, 
            `user_password`,  
            `user_status`, 
            `user_class`) 
        VALUES (
            '$user_firstname',
            '$user_lastname',
            '$user_serialnumber',
            '$user_rank',
            '$user_actualrank',
            '$user_type',
            '$user_gender',
            '$user_username',
            '$hashed',
            '$user_status',
            '$user_class')";

        $signupuser_query = mysqli_query($this->connect(), $siupuser_stmt);
        $signupsuccess = true;
        return $signupsuccess;
    }
    // * This function will pass data to db and save it 
}
// * this class will be the one incharge to access the DB
