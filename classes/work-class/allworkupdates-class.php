<?php

class fetchallupdates extends connectiontodb
{

    public $update_id;
    public $update_workid;
    public $update_by;
    public $update_remarks;
    public $update_date;
    public $update_file;
    public $update_status;

    public function fetchallupdatedworkid()
    {
        $sql = "SELECT * FROM work_updates ";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $updatedetails = $fetchworkqueue->fetch_assoc();
        if (!empty($updatedetails)) {
            $allworkids = array();
            do {
                array_push($allworkids, $updatedetails['update_workid']);
            } while ($updatedetails = $fetchworkqueue->fetch_assoc());
            return $allworkids;
        } else {
            return "no Work updates!";
        }
    }

    public function fetchallupdatedes()
    {
        $sql = "SELECT * FROM work_updates ORDER BY update_id DESC LIMIT 20 ";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $updatedetails = $fetchworkqueue->fetch_assoc();
        if (!empty($updatedetails)) {
            $allupdateids = array();
            do {
                array_push($allupdateids, $updatedetails['update_id']);
            } while ($updatedetails = $fetchworkqueue->fetch_assoc());
            return $allupdateids;
        } else {
            return "no Work updates!";
        }
    }

    public function fetchallupdateid($update_workid)
    {
        $sql = "SELECT * FROM work_updates WHERE update_workid = '$update_workid'";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $updatedetails = $fetchworkqueue->fetch_assoc();
        if (!empty($updatedetails)) {
            $allworkids = array();
            do {
                array_push($allworkids, $updatedetails['update_id']);
            } while ($updatedetails = $fetchworkqueue->fetch_assoc());
            return $allworkids;
        } else {
            return "no Work updates!";
        }
    }

    public function fetchoneworkupdate($update_id, $update_workid)
    {

        $sql = "SELECT * FROM work_updates   WHERE update_id = '$update_id' and update_workid = '$update_workid'";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();

        $this->update_id = $workdetails['update_id'];
        $this->update_workid = $workdetails['update_workid'];
        $this->update_by = $workdetails['update_by'];
        $this->update_remarks = $workdetails['update_remarks'];
        $this->update_date = $workdetails['update_date'];
        $this->update_file = $workdetails['update_file'];
    }

    public function fetchoneidupdate($update_id)
    {

        $sql = "SELECT * FROM work_updates   WHERE update_id = '$update_id'";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();

        $this->update_id = $workdetails['update_id'];
        $this->update_workid = $workdetails['update_workid'];
        $this->update_by = $workdetails['update_by'];
        $this->update_remarks = $workdetails['update_remarks'];
        $this->update_date = $workdetails['update_date'];
        $this->update_file = $workdetails['update_file'];
        $this->update_status = $workdetails['update_status'];
    }
}
