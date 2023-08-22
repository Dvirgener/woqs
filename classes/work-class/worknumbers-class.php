<?php

class fetchnrofwork extends connectiontodb
{
    public function UsertotalactiveWorkload($id)
    {
        $sqlviewwork = "SELECT * FROM work_queue";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        $numberofwork = 0;
        // if work is not empty
        if (!empty($eachwork)) {
            do {
                if ($eachwork['work_status'] == "Uncomplied") {
                    $work_user = $eachwork['work_user'];
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($id, $work_user, true);
                    if ($work_user[$work_userindex] == $id) {
                        $numberofwork = $numberofwork + 1;
                    } else {
                    }
                }
            } while ($eachwork = $workQueue->fetch_assoc());
        }
        // if work is not empty
        return $numberofwork;
    }
    // user total active workload

    // user non updated workload
    public function UsertotalunupdatedWorkload($id)
    {
        $sqlviewwork = "SELECT * FROM work_queue";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        $numberofunupdatedwork = 0;
        // if work is not empty
        if (!empty($eachwork)) {
            do {
                // uncomplied Work
                if ($eachwork['work_status'] == "Uncomplied") {
                    $work_user = $eachwork['work_user'];
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($id, $work_user, true);
                    if ($work_user[$work_userindex] == $id) {
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
                }
                // uncomplied Work
            } while ($eachwork = $workQueue->fetch_assoc());
        }
        // if work is not empty
        return $numberofunupdatedwork;
    }
    // user non updated workload

    // user Near or on deadline workload
    public function UsertotaldeadlineWorkload($id)
    {
        $sqlviewwork = "SELECT * FROM work_queue";
        $workQueue = $this->connect()->query($sqlviewwork) or die($this->connect()->error);
        $eachwork = $workQueue->fetch_assoc();
        $numberofdeadlinedwork = 0;
        // if work is not empty
        if (!empty($eachwork)) {
            do {
                // uncomplied Work
                if ($eachwork['work_status'] == "Uncomplied") {
                    $work_user = $eachwork['work_user'];
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($id, $work_user, true);
                    if ($work_user[$work_userindex] == $id) {
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
                }
                // uncomplied Work
            } while ($eachwork = $workQueue->fetch_assoc());
        }
        // if work is not empty
        return $numberofdeadlinedwork;
    }
    // user Near or on deadline workload


}
