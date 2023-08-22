<?php
include "routine-details-class.php";
class invokeroutine extends connectiontodb
{
    public $routineid;
    public $routine_dateadded;
    public $routine_subject;
    public $routine_remarks;
    public $routine_nrofdaysbefore;
    public $routine_nrofdaystocomply;
    public $routine_date;
    public $routine_month;
    public $routine_section;
    public $routine_status;
    public $routine_frequency;
    public $month_today;
    public $date_today;

    public function __construct($routineid)
    {
        $this->$routineid = $routineid;
        $this->fetchroutinedetails($routineid);
    }

    public function fetchroutinedetails($routineid)
    {
        $details = new fetchoneroutine($routineid);
        $this->routine_subject = $details->routine_subject;
        $this->routine_dateadded = $details->routine_dateadded;
        $this->routine_remarks = $details->routine_remarks;
        $this->routine_nrofdaysbefore = $details->routine_nrofdaysbefore;
        $this->routine_nrofdaystocomply = $details->routine_nrofdaystocomply;
        $this->routine_date = $details->routine_date;
        $this->routine_month = $details->routine_month;
        $this->routine_section = $details->routine_section;
        $this->routine_status = $details->routine_status;
        $this->routine_frequency = $details->routine_frequency;
        $this->month_today = date('n');
        $this->date_today = date('j');
    }

    public function quarterly($month)
    {
        $montharray = array();
        array_push($montharray, $month);
        for ($i = 0; $i < 3; $i++) {
            $month = $month + 3;
            if ($month > 12) {
                $month = $month - 12;
                array_push($montharray, $month);
            } else {
                array_push($montharray, $month);
            }
        }
        return $montharray;
    }

    public function semi_annual($month)
    {
        $montharray = array();
        array_push($montharray, $month);
        for ($i = 0; $i <= 1; $i++) {
            $month = $month + 6;
            if ($month > 12) {
                $month = $month - 12;
                array_push($montharray, $month);
            } else {
                array_push($montharray, $month);
            }
        }
        return $montharray;
    }

    public function insertodb()
    {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $date = date_create($year . "-" . $month . "-" . $day);
        date_add($date, date_interval_create_from_date_string($this->routine_nrofdaystocomply . " days"));
        $allusers = new selectalluser();
        $work_subject = $this->routine_subject;
        $work_type = "Routine";
        $work_remarks = $this->routine_remarks;
        $work_targetdate = date_format($date, "Y-m-d");
        $work_users = $allusers->fetchallusers();
        $work_users = serialize($work_users);
        $work_added = "routine";
        $work_addedfrom = $this->routine_section;

        $sqlinsert = "INSERT INTO `work_queue`(`work_user`,`work_subject`,`work_targetdate`,`work_type`,`work_remarks`, `work_added`,`work_status`,`work_addedfrom`)             
                VALUES ('$work_users','$work_subject','$work_targetdate','$work_type','$work_remarks','$work_added','Uncomplied','$work_addedfrom')";
        $signupuser_query = mysqli_query($this->connect(), $sqlinsert);

        $sql2 = "UPDATE routine_work_queue SET routine_status = 1 WHERE routine_id = '$this->routineid'";
        $signupuser_query2 = mysqli_query($this->connect(), $sql2);
    }

    public function invokeworkroutine()
    {

        if ($this->routine_status == 1) {
            return;
        }

        switch ($this->routine_frequency) {
            case "monthly":
                $reference = $this->routine_date - $this->routine_nrofdaysbefore;
                if ($reference < 0) {
                    $reference = $reference + 30;
                }
                $datetoday = date('j');
                if ($reference == $datetoday) {
                    $this->insertodb();
                }
                break;
            case "quarterly":
                $referencemonth = $this->quarterly($this->routine_month);
                for ($i = 0; $i <= 3; $i++) {
                    $reference = $this->routine_date - $this->routine_nrofdaysbefore;
                    if ($reference <= 0) {
                        $reference = $reference + 30;
                    }
                    if ($referencemonth[$i] == $this->month_today && $reference == $this->date_today) {
                        $this->insertodb();
                        break;
                    }
                }
                break;
            case "semiannual":
                $referencemonth = $this->semi_annual($this->routine_month);
                print_r($referencemonth);
                for ($i = 0; $i < 2; $i++) {
                    $reference = $this->routine_date - $this->routine_nrofdaysbefore;
                    if ($reference <= 0) {
                        $reference = $reference + 30;
                    }
                    if ($referencemonth[$i] == $this->month_today && $reference == $this->date_today) {
                        $this->insertodb();

                        break;
                    }
                }
                break;

            case "annual":
                $reference = $this->routine_date - $this->routine_nrofdaysbefore;
                if ($reference <= 0) {
                    $reference = $reference + 30;
                }
                if ($this->routine_month == $this->month_today && $reference == $this->date_today) {
                    $this->insertodb();
                    break;
                }

                break;
        }
    }
}
