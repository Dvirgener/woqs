<?php

class adminallfetchnrofwork extends connectiontodb
{

    public $user_nrofactiveworkload;
    public $user_nrofneedactiveworkload;
    public $user_nrofdeadlineactiveworkload;
    public $user_allworkadded;
    public $user_allcompliedworkadded;


    public function checkwork()
    {
        $this->user_nrofactiveworkload = $this->adminallUsertotalactiveWorkload();
        $this->user_nrofactiveworkload = $this->adminallUsertotalunupdatedWorkload();
        $this->user_nrofactiveworkload = $this->adminallUsertotaldeadlineWorkload();
        $this->user_allworkadded = $this->allworkadded();
        $this->user_allcompliedworkadded = $this->allcompliedworkadded();
    }


    public function adminallUsertotalactiveWorkload()
    {
        $sqlviewwork = "SELECT * FROM work_queue WHERE work_addedfrom = 'admin'";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        // if work is not empty
        if (!empty($eachwork)) {
            $numberofwork = 0;
            do {
                if ($eachwork['work_status'] == "Uncomplied") {
                    $numberofwork = $numberofwork + 1;
                }
            } while ($eachwork = $workQueue->fetch_assoc());
            return $numberofwork;
        }
        // if work is not empty
    }
    // user total active workload

    // user non updated workload
    public function adminallUsertotalunupdatedWorkload()
    {
        $sqlviewwork = "SELECT * FROM work_queue WHERE work_addedfrom = 'admin'";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        // if work is not empty
        if (!empty($eachwork)) {
            $numberofunupdatedwork = 0;
            do {
                // uncomplied Work
                if ($eachwork['work_status'] == "Uncomplied") {
                    $dateadded = $eachwork['work_dateupdated'];
                    $datetoday = date('Y-m-d');
                    $dateadded = strtotime($dateadded);
                    $datetoday = strtotime($datetoday);
                    $interval = $datetoday - $dateadded;
                    $daysinterval = floor($interval / (60 * 60 * 24));
                    if ($daysinterval >= 1) {
                        $numberofunupdatedwork = $numberofunupdatedwork + 1;
                    } else {
                        $numberofunupdatedwork = $numberofunupdatedwork + 0;
                    }
                }
                // uncomplied Work
            } while ($eachwork = $workQueue->fetch_assoc());
            return $numberofunupdatedwork;
        }
        // if work is not empty
    }
    // user non updated workload

    // user Near or on deadline workload
    public function adminallUsertotaldeadlineWorkload()
    {
        $sqlviewwork = "SELECT * FROM work_queue WHERE work_addedfrom = 'admin'";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        // if work is not empty
        if (!empty($eachwork)) {
            $numberofdeadlinedwork = 0;
            do {
                // uncomplied Work
                if ($eachwork['work_status'] == "Uncomplied") {
                    if ($eachwork['work_targetdate'] != "0000-00-00") {
                        $dateadded = $eachwork['work_targetdate'];
                        $datetoday = date('Y-m-d');
                        $dateadded = strtotime($dateadded);
                        $datetoday = strtotime($datetoday);
                        $interval = $dateadded - $datetoday;
                        $daysinterval = floor($interval / (60 * 60 * 24));
                        if ($daysinterval <= 1) {
                            $numberofdeadlinedwork = $numberofdeadlinedwork + 1;
                        } else {
                            $numberofdeadlinedwork = $numberofdeadlinedwork + 0;
                        }
                    }
                }
                // uncomplied Work
            } while ($eachwork = $workQueue->fetch_assoc());
            return $numberofdeadlinedwork;
        }
        // if work is not empty
    }
    // user Near or on deadline workload

    public function allworkadded()
    {
        $sqlviewwork = "SELECT * FROM work_queue";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        // if work is not empty
        if (!empty($eachwork)) {
            $numberofwork = 0;
            do {
                $numberofwork = $numberofwork + 1;
            } while ($eachwork = $workQueue->fetch_assoc());
            return $numberofwork;
        }
        // if work is not empty
    }
    // user total active workload

    public function allcompliedworkadded()
    {
        $sqlviewwork = "SELECT * FROM work_queue";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        // if work is not empty
        if (!empty($eachwork)) {
            $numberofwork = 0;
            do {
                if ($eachwork['work_status'] == "Complied") {
                    $numberofwork = $numberofwork + 1;
                }
            } while ($eachwork = $workQueue->fetch_assoc());
            return $numberofwork;
        }
        // if work is not empty
    }
    // user total active workload


}
