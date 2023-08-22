<?php

class fetchuser extends connectiontodb
{
    public $user_id;
    public $user_firstname;
    public $user_lastname;
    public $user_username;
    public $user_serialnumber;
    public $user_rank;
    public $user_actualrank;
    public $user_type;
    public $user_dateadded;
    public $user_gender;
    public $user_status;
    public $user_statusremarks;
    public $user_class;
    public $user_position;
    public $user_picture;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->checkdb($user_id);
    }

    public function checkdb($user_id)
    {
        $checkuseriddetails = "SELECT * FROM logistics_users WHERE user_id = '$user_id'";
        $checkusername = mysqli_query($this->connect(), $checkuseriddetails);
        $userdetails = $checkusername->fetch_assoc();

        $this->user_id = $userdetails['user_id'];
        $this->user_firstname = $userdetails['user_firstname'];
        $this->user_lastname = $userdetails['user_lastname'];
        $this->user_username = $userdetails['user_username'];
        $this->user_serialnumber = $userdetails['user_serialnumber'];
        $this->user_rank = $userdetails['user_rank'];
        $this->user_actualrank = $userdetails['user_actualrank'];
        $this->user_type = $userdetails['user_type'];
        $this->user_dateadded = $userdetails['user_dateadded'];
        $this->user_gender = $userdetails['user_gender'];
        $this->user_status = $userdetails['user_status'];
        $this->user_statusremarks = $userdetails['user_statusremarks'];
        $this->user_class = $userdetails['user_class'];
        $this->user_position = $userdetails['user_position'];
        $this->user_picture = $userdetails['user_picture'];
    }

    public function completename()
    {
        $complete_name = $this->user_actualrank . " " . $this->user_firstname . " " . $this->user_lastname . " PAF";
        return $complete_name;
    }

    public function completenameSN()
    {
        $complete_name = $this->user_actualrank . " " . $this->user_firstname . " " . $this->user_lastname . " " . $this->user_serialnumber . " PAF";
        return $complete_name;
    }

    public function completelastname()
    {
        $complete_name = $this->user_actualrank . " " .  $this->user_lastname . " " . " PAF";
        return $complete_name;
    }
}
