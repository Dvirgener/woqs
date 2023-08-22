<?php

class selectalluser extends connectiontodb
{
    public $allusers;

    public function fetchallusers()
    {
        $sqlquery = "SELECT * FROM logistics_users";
        $selectallusers = mysqli_query($this->connect(), $sqlquery);
        $userdetails = $selectallusers->fetch_assoc();
        $useridsarray = array();
        do {
            array_push($useridsarray, $userdetails['user_id']);
        } while ($userdetails = $selectallusers->fetch_assoc());

        return $useridsarray;
    }
}
