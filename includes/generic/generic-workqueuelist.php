<?php

class view_worklist
{
    // * Function to view work
    public function work_window($viewquery, $logged_position, $logged_id)
    {
        $this->worklist_windows_htmltags($viewquery, $logged_id, "directed");
        $this->worklist_windows_htmltags($viewquery, $logged_id, "admin");

        foreach ($logged_position as $position) {
            if ($position != "ADMIN") {
                $this->worklist_windows_htmltags($viewquery, $logged_id, $position);
            }
        }
    }
    // * Function to view work

    // * Function to view work for one Section
    public function work_window_section($viewquery, $logged_id, $position)
    {
        $this->worklist_windows_htmltags($viewquery, $logged_id, $position);
    }
    // * Function to view work for one Section


    // * Function to view all work queues for all sections
    public function worklist_windows_htmltags($viewquery, $logged_user_id, $addedworkfrom)
    {
?>
        <div class="row fw-bold mb-2">
            <?php
            if ($viewquery != "section") {
                switch ($addedworkfrom) {
                    case "directed":
                        echo "Directed:";
                        break;
                    case "admin":
                        echo "Admin:";
                        break;
                    case "DPP":
                        echo "Section (Financial):";
                        break;
                    case "DBFEE":
                        echo "Section (Equipment):";
                        break;
                    case "DMS":
                        echo "Section (POL and ICIE):";
                        break;
                    case "DMA":
                        echo "Section (Armaments):";
                        break;
                }
                $height = 250;
            } else {
                $height = 300;
            }

            ?>
        </div>
        <div class="row overflow-y-scroll overflow-x-hidden" style="height: <?= $height . "px" ?>">
            <div class="col">
                <div class="row">
                    <?php
                    $this->main_worklist($viewquery, $logged_user_id, $addedworkfrom)
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    // * Function to view all work queues for all sections

    // * main function to view worklist
    public function main_worklist($viewquery, $logged_user_id, $addedworkfrom)
    {
        $allworkids = new fetchallworkqueue; // * Fetch All Work Ids
        // * Fetch details of one work ID
        $allworkqueue_id_array = $allworkids->fetchallworkqueue(); // * Pass all IDs to an array
        // * question if there are work IDs in DB
        if ($allworkqueue_id_array == "0") {
            return $allworkqueue_id_array; //* return an array whether it has value or none
        } else {
            //* for each work id
            foreach ($allworkqueue_id_array as $one_workid) {
                $oneworkqueue = new fetchoneworkqueue($one_workid);

                switch ($viewquery) {
                        // * Case for invoking user work queue
                    case "myworkqueue":
                        $checkif_uncomplied = $this->workcompliance($oneworkqueue->work_status);
                        if ($checkif_uncomplied == false) {
                            break;
                        }
                        $sectioncheck = $this->whereisworkqueue($oneworkqueue->work_addedfrom, $addedworkfrom);
                        if ($sectioncheck == false) {
                            break;
                        }
                        $checker = $this->myworkqueue($oneworkqueue->work_user, $logged_user_id);
                        if ($checker == false) {
                            break;
                        }
                        $is_deadline = $this->check_deadline($oneworkqueue->work_targetdate);
                        $is_update = $this->check_update($oneworkqueue->work_dateupdated);
                        $this->viewworkload_htmltags($oneworkqueue->work_status, $oneworkqueue->work_id, $oneworkqueue->work_subject, $is_update, $is_deadline, "viewworkdetail");
                        break;
                        // * Case for invoking user added work queue
                    case "addedworkqueue":
                        $checkif_uncomplied = $this->workcompliance($oneworkqueue->work_status);
                        if ($checkif_uncomplied == false) {
                            break;
                        }
                        $sectioncheck = $this->whereisworkqueue($oneworkqueue->work_addedfrom, $addedworkfrom);
                        if ($sectioncheck == false) {
                            break;
                        }
                        $checker = $this->addedworkqueue($oneworkqueue->work_added, $logged_user_id);
                        if ($checker == false) {
                            break;
                        }
                        $is_deadline = $this->check_deadline($oneworkqueue->work_targetdate);
                        $is_update = $this->check_update($oneworkqueue->work_dateupdated);
                        $this->viewworkload_htmltags($oneworkqueue->work_status, $oneworkqueue->work_id, $oneworkqueue->work_subject, $is_update, $is_deadline, "viewaddedworkdetail");
                        break;
                        // * Case for invoking user work queue history
                    case "myworkhistory":
                        $checkif_uncomplied = $this->workcompliance($oneworkqueue->work_status);
                        if ($checkif_uncomplied == true) {
                            break;
                        }
                        $sectioncheck = $this->whereisworkqueue($oneworkqueue->work_addedfrom, $addedworkfrom);
                        if ($sectioncheck == false) {
                            break;
                        }
                        $checker = $this->addedworkqueue($oneworkqueue->work_compliedby, $logged_user_id);
                        if ($checker == false) {
                            break;
                        }
                        $is_deadline = "";
                        $is_update = "";
                        $this->viewworkload_htmltags($oneworkqueue->work_status, $oneworkqueue->work_id, $oneworkqueue->work_subject, $is_update, $is_deadline, "viewworkhistory");
                        break;
                        // * Case for invoking Section work viewing
                    case "section":
                        $checkif_uncomplied = $this->workcompliance($oneworkqueue->work_status);
                        if ($checkif_uncomplied == false) {
                            break;
                        }
                        $sectioncheck = $this->whereisworkqueue($oneworkqueue->work_addedfrom, $addedworkfrom);
                        if ($sectioncheck == false) {
                            break;
                        }
                        $is_deadline = $this->check_deadline($oneworkqueue->work_targetdate);
                        $is_update = $this->check_update($oneworkqueue->work_dateupdated);
                        $this->viewworkload_htmltags($oneworkqueue->work_status, $oneworkqueue->work_id, $oneworkqueue->work_subject, $is_update, $is_deadline, "viewaddedworkdetail");
                        break;
                }
            }
            //* for each work id
        }
        // * question if there is are work IDs in DB
    }
    // * main function to view worklist

    // * this is the function for the view work BUTTON html tags
    public function viewworkload_htmltags($compliance, $work_id, $work_subject, $needupdate, $needcomply, $viewworkbutton)
    {
    ?>
        <button class="btn mb-2 buttonzoom clickwork pe-3 ps-1 border-bottom <?= $viewworkbutton ?> " type="button" value=<?= $work_id ?>>
            <div class="row text-dark text-center d-flex justify-content-around">
                <div class="col-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                </div>
                <div class="col-10">
                    <span class="text-center">
                        <?= $work_subject ?>
                    </span>
                </div>
            </div>
            <?php
            if ($compliance == "Complied") {
            } else {
            ?>
                <div class="row mb-1 ps-4">
                    <div class="col-3 rounded p-0 m-0 me-1" style="background-color: green; height:auto; width:auto; display:<?= $needupdate ?>">
                        <span class="p-0 text-light mx-1" style="font-size: x-small;"> Update!</span>
                    </div>
                    <div class="col-3 rounded p-0 m-0" style="background-color: red; height:auto; width:auto; display:<?= $needcomply ?>">
                        <span class="p-0 text-light mx-1" style="font-size: x-small;">Deadline!</span>
                    </div>
                </div>
            <?php
            }
            ?>


        </button>
<?php
    }
    // * this is the function for the view work BUTTON html tags

    // * this is the function for checking if work is near deadline
    public function check_deadline($targetdate)
    {
        if ($targetdate != "0000-00-00") {
            $dateadded = $targetdate;
            $datetoday = date('Y-m-d');
            $dateadded = strtotime($dateadded);
            $datetoday = strtotime($datetoday);
            $interval = $dateadded - $datetoday;
            $daysinterval = floor($interval / (60 * 60 * 24));
            if ($daysinterval <= 1) {
                $deadline = "block";
            } else {
                $deadline = "none";
            }
        } else {
            $deadline = "none";
        }
        return $deadline;
    }
    // * this is the function for checking if work is near deadline

    // * this is the function for checking if work is updated or not
    public function check_update($update)
    {
        $dateupdated = $update;
        $datetoday = date('Y-m-d');
        $dateupdated = strtotime($dateupdated);
        $datetoday = strtotime($datetoday);
        $interval = $datetoday - $dateupdated;
        $daysinterval = floor($interval / (60 * 60 * 24));
        if ($daysinterval >= 1) {
            $needupdate = "block";
        } else {
            $needupdate = "none";
        }
        return $needupdate;
    }
    // * this is the function for checking if work is updated or not

    // * this is the function to check if loggedusers is one of users in the workqueue
    public function myworkqueue($work_userids, $logged_id)
    {
        // * fetch work users array
        $work_user = $work_userids;
        $work_user = unserialize($work_user);
        // * search if the logged user ID is in the array
        $work_userindex = array_search($logged_id, $work_user, true);
        // *if logged user is in the userarray
        if ($work_user[$work_userindex] == $logged_id) {
            $result = true;
        } else {
            $result = false;
        }
        // *if logged user is in the userarray
        return $result;
    }
    // * this is the function to check if loggedusers is one of users in the workqueue

    // * this is the function to check if loggedusers is one of users in the workqueue
    public function addedworkqueue($work_adder, $logged_id)
    {
        if ($work_adder == $logged_id) {
            $result = true;
        } else {
            $result = false;
        }
        // *if logged user is in the userarray
        return $result;
    }
    // * this is the function to check if loggedusers is one of users in the workqueue

    // * filter where to view the worklist
    public function whereisworkqueue($db_addedfrom, $addedworkfrom)
    {

        if ($db_addedfrom == "$addedworkfrom") {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    // * filter where to view the worklist

    // * Filter Complied or uncomplied work
    public function workcompliance($workstatus)
    {
        if ($workstatus == "Uncomplied") {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    // * Filter Complied or uncomplied work

}
