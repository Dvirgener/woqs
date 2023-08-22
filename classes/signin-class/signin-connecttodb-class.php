<?php
// * this class will be the one incharge to access the DB
class signinpassed extends connectiontodb
{
    // * This method will check if a username already exist in db and return a true/false value back to signupprocess class
    public function signinpassed_check_username($user_username)
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
    // * This method will check if a password match the usernames in DB
    public function signinpassed_check_password($user_username, $user_password)
    {

        $signinuser = "SELECT * FROM logistics_users WHERE user_username = '$user_username'";
        $checkusername = mysqli_query($this->connect(), $signinuser);
        $userlist = $checkusername->fetch_assoc();

        if (password_verify($user_password, $userlist['user_password'])) {
            session_start();
            $_SESSION['user_id'] = $userlist['user_id'];
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
// * this class will be the one incharge to access the DB
