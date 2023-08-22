<?php

class fetchallworkqueue extends connectiontodb
{

    public function fetchallworkqueue()
    {
        $sql = "SELECT * FROM work_queue";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();
        if (!empty($workdetails)) {
            $allworkids = array();
            do {
                array_push($allworkids, $workdetails['work_id']);
            } while ($workdetails = $fetchworkqueue->fetch_assoc());
            return $allworkids;
        } else {
            return "0";
        }
    }

    public function fetchallworkqueuewithlimit()
    {
        $sql = "SELECT * FROM work_queue ORDER BY work_id DESC LIMIT 10";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();
        if (!empty($workdetails)) {
            $allworkids = array();
            do {
                array_push($allworkids, $workdetails['work_id']);
            } while ($workdetails = $fetchworkqueue->fetch_assoc());
            return $allworkids;
        } else {
            return "0";
        }
    }
}
