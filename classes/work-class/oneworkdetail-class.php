<?php

class fetchoneworkqueue extends connectiontodb
{
    public $work_id;
    public $work_user;
    public $work_dateadded;
    public $work_dateupdated;
    public $work_targetdate;
    public $work_subject;
    public $work_type;
    public $work_added;
    public $work_status;
    public $work_addedfrom;
    public $work_remarks;
    public $work_updateremarks;
    public $work_finalremarks;
    public $work_compliedby;
    public $work_compliancefile;
    public $work_filereference;
    public $work_timeliness;

    public function __construct($work_id)
    {
        $this->fetch_workdetails($work_id);
    }

    public function fetch_workdetails($work_id)
    {
        $sql = "SELECT * FROM work_queue WHERE work_id = '$work_id'";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();

        $this->work_id = $workdetails['work_id'];
        $this->work_user = $workdetails['work_user'];
        $this->work_dateadded = $workdetails['work_dateadded'];
        $this->work_dateupdated = $workdetails['work_dateupdated'];
        $this->work_targetdate = $workdetails['work_targetdate'];
        $this->work_subject = $workdetails['work_subject'];
        $this->work_type = $workdetails['work_type'];
        $this->work_added = $workdetails['work_added'];
        $this->work_status = $workdetails['work_status'];
        $this->work_addedfrom = $workdetails['work_addedfrom'];
        $this->work_remarks = $workdetails['work_remarks'];
        $this->work_filereference = $workdetails['work_filereference'];
        $this->work_updateremarks = $workdetails['work_updateremarks'];
        $this->work_finalremarks = $workdetails['work_finalremarks'];
        $this->work_compliedby = $workdetails['work_compliedby'];
        $this->work_compliancefile = $workdetails['work_compliancefile'];
        $this->work_timeliness = $workdetails['work_timeliness'];
    }
}
