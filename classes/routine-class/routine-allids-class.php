<?php

class fetchallroutineid extends connectiontodb
{

    public function routineids()
    {
        $sql = "SELECT * FROM routine_work_queue";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();
        if (!empty($workdetails)) {
            $allworkids = array();
            do {
                array_push($allworkids, $workdetails['routine_id']);
            } while ($workdetails = $fetchworkqueue->fetch_assoc());
            return $allworkids;
        } else {
            return "0";
        }
    }
}
