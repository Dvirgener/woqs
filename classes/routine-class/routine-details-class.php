<?php

class fetchoneroutine extends connectiontodb
{
    public $routine_id;
    public $routine_subject;
    public $routine_dateadded;
    public $routine_section;
    public $routine_frequency;
    public $routine_month;
    public $routine_date;
    public $routine_remarks;
    public $routine_file;
    public $routine_status;
    public $routine_nrofdaysbefore;
    public $routine_nrofdaystocomply;


    public function __construct($routine_id)
    {
        $sql = "SELECT * FROM routine_work_queue WHERE routine_id = '$routine_id'";
        $fetchworkqueue = mysqli_query($this->connect(), $sql);
        $workdetails = $fetchworkqueue->fetch_assoc();

        $this->routine_id = $workdetails['routine_id'];
        $this->routine_subject = $workdetails['routine_subject'];
        $this->routine_dateadded = $workdetails['routine_dateadded'];
        $this->routine_section = $workdetails['routine_section'];
        $this->routine_frequency = $workdetails['routine_frequency'];
        $this->routine_month = $workdetails['routine_month'];
        $this->routine_date = $workdetails['routine_date'];
        $this->routine_remarks = $workdetails['routine_remarks'];
        $this->routine_file = $workdetails['routine_file'];
        $this->routine_status = $workdetails['routine_status'];
        $this->routine_nrofdaysbefore = $workdetails['routine_nrofdaysbefore'];
        $this->routine_nrofdaystocomply = $workdetails['routine_nrofdaystocomply'];
    }
}
