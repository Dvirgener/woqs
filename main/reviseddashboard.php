<?php

$where = "workhistory";

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../classes/connection-class/dbconnect-class.php";
    include "../classes/users-class/selectoneuser-class.php";
    include "../classes/users-class/selectalluser-class.php";
    include "../classes/work-class/alltotalnrofwork-include.php";
    include "../classes/work-class/allworkids.php";
    include "../classes/work-class/oneworkdetail-class.php";
    include "../classes/work-class/allworkupdates-class.php";
    include "../classes/work-class/worknumbers-class.php";
    include "../classes/work-class/view-worklist-class.php";
    include "../classes/routine-class/routine-frequency-class.php";
    include "../classes/routine-class/routine-allids-class.php";

    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}


// *INVOKING A ROUTINE WORK QUEUE
$invoker = new fetchallroutineid();
$invokerarray = $invoker->routineids();
if (!empty($invokerarray)) {
    foreach ($invokerarray as $routineid) {
        $invoke = new invokeroutine($routineid);
        $invokework = $invoke->invokeworkroutine($routineid);
    }
}



$alltotalwork = new allfetchnrofwork();
?>

<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>
<script src="../jsfiles/viewworkdetails.js"></script>
<script src="../jsfiles/dashboardmodals.js"></script>
<header>
    <header>

    </header>
</header>

<body class=" font overflow-y-scroll">

    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        include "../includes/modals/generic-viewfilemodal.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">DASHBOARD</span>
        </div>
        <div class="row ">
            <!-- Personnel Work Queue Panel -->
            <div class="col-12 col-md-4  bg-light mb-2" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <div class="row  text-center fw-bold mb-3">
                    <span>INDIVIDUAL WORK QUEUE</span>
                </div>
                <div class="row overflow-y-scroll" style="height:650px">

                    <?php
                    $allusers = new selectalluser();
                    $allusersid = $allusers->fetchallusers();
                    foreach ($allusersid as $userid) {
                        $oneuser = new fetchuser($userid);
                        $oneuser_firstandlastname = $oneuser->user_actualrank . " " . $oneuser->user_firstname . " " . $oneuser->user_lastname . " PAF";
                        $fetchuserworkqueue = new fetchnrofwork($oneuser->user_id);
                        $totalactivework = $fetchuserworkqueue->UsertotalactiveWorkload($oneuser->user_id);
                        $needsupdate = $fetchuserworkqueue->UsertotalunupdatedWorkload($oneuser->user_id);
                        $neardeadline = $fetchuserworkqueue->UsertotaldeadlineWorkload($oneuser->user_id);
                        if ($oneuser->user_class != "OFFICER") {
                    ?>

                            <div class="row mb-2">
                                <div class="col-4">
                                    <button type="button" class="clicktoviewwork" style="background-color: white; border-style: none;" value="<?= $oneuser->user_id ?>">
                                        <img class="border buttonzoom view_personnel_work " type="button" id="view_personnel_work" src="../pictures/profilepic/<?php echo $oneuser->user_picture  ?>" onerror="this.src='../pictures/generic/imageplaceholder.png';" alt="" style=" height:100px; width: 100px; border-radius:10px">
                                    </button>

                                </div>
                                <div class="col-8 ps-3">
                                    <div class="row mb-1 fw-bold" style="font-size: small;">
                                        <span><?= $oneuser_firstandlastname ?></span>
                                    </div>
                                    <div class="row">
                                        <div class="col-9" style="font-size: smaller;">Active Work Queue:</div>
                                        <div class="col-3" style="font-size: smaller;"><?= $totalactivework ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9" style="font-size: smaller;">For Follow up:</div>
                                        <div class="col-3" style="font-size: smaller; color: green"><?= $needsupdate ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9" style="font-size: smaller;">Deadline:</div>
                                        <div class="col-3" style="font-size: smaller; color:red"><?= $neardeadline ?></div>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Personnel Work Queue Panel -->

            <!-- Office Work Queue, Accomplished, Upcoming and Duty status Panel -->
            <div class="col-12 col-md-4 ps-md-4 mb-2">

                <!-- Total Office Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>OFFICE WORKLOAD</span>
                        </div>
                        <div class="row">
                            <div class="col-6 ms-5" style="font-size: smaller;">Active Work Queue:</div>
                            <div class="col-3 text-center" style="font-size: smaller;"><?= $alltotalwork->allUsertotalactiveWorkload(); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-6 ms-5" style="font-size: smaller;">For Follow up:</div>
                            <div class="col-3 text-center" style="font-size: smaller; color: green"><?= $alltotalwork->allUsertotalunupdatedWorkload() ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 ms-5" style="font-size: smaller;">Deadline:</div>
                            <div class="col-3 text-center" style="font-size: smaller; color:red"><?= $alltotalwork->allUsertotaldeadlineWorkload() ?></div>
                        </div>
                    </div>
                </div>
                <!-- Total Office Work Queue -->

                <!-- Total Accomplished Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>ACCOMPLISHED WORK</span>
                        </div>
                        <div class="row text-center">
                            <span class="fs-1" style="color:blue"><a href="workhistory.php"><?= $alltotalwork->allcompliedworkadded() ?></a> of <?= $alltotalwork->allworkadded() ?></span>
                        </div>
                    </div>
                </div>
                <!-- Total Accomplished Work Queue -->

                <!-- Upcoming Office Activities -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>UPCOMING ACTIVITIES</span>
                        </div>
                        <div class="row text-center">
                            <span class="fs-1" style="color:blue">Under Construcion</span>
                        </div>
                    </div>
                </div>
                <!-- Upcoming Office Activities -->

                <!-- Status of Personnel -->
                <div class="row ">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold mb-2">
                            <span>DUTY STATUS OF PERSONNEL</span>
                        </div>
                        <div class="row overflow-y-scroll" style="height:375px">

                            <?php
                            $allusers = new selectalluser();
                            $allids = $allusers->fetchallusers();
                            foreach ($allids as $id) {
                                $one_user = new fetchuser($id);
                                $one_user_firstandlastname = $one_user->user_actualrank . " " . $one_user->user_firstname . " " . $one_user->user_lastname . " PAF";
                            ?>
                                <div class="row mb-2 border-bottom">
                                    <div class="col-md-8">
                                        <span class="fw-bold"><?= $one_user_firstandlastname ?></span>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <?php
                                        if ($one_user->user_status == "ON DUTY") {
                                            $color = "green";
                                            $remarksdisplay = "none";
                                        }
                                        if ($one_user->user_status == "OFF DUTY") {
                                            $color = "red";
                                            $remarksdisplay = "block";
                                        }
                                        ?>
                                        <span class="fw-bold" style="color: <?= $color ?>"><?= $one_user->user_status ?></span>
                                    </div>
                                    <div class="col-md-12" style="display: <?= $remarksdisplay ?>">
                                        Remarks : <span class=""><?= $one_user->user_statusremarks ?></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Status of Personnel -->

            </div>
            <!-- Office Work Queue, Accomplished, Upcoming and Duty status Panel -->

            <!-- Recently Updated and Added Work Panel Panel -->
            <div class="col-12 col-md-4 ps-md-4">

                <!-- Recently Added Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; height:340px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row mb-2 text-center fw-bold">
                            <span>RECENTLY ADDED WORK QUEUE</span>
                        </div>
                        <div class="row overflow-y-scroll ps-4" style="height:300px">
                            <div class="col">
                                <div class="row">
                                    <?php
                                    $allworkids = new fetchallworkqueue();
                                    $workidswithlimit = $allworkids->fetchallworkqueuewithlimit();
                                    if (empty($allworkids->fetchallworkqueuewithlimit())) {
                                        $workidswithlimit = array();
                                    }
                                    foreach ($workidswithlimit as $workid) {
                                        $workdetail = new fetchoneworkqueue($workid);
                                        if ($workdetail->work_added == 0) {
                                            $adderfirstandlast = $workdetail->work_addedfrom;
                                        } else {
                                            $workadder = $workdetail->work_added;
                                            $workadder_detail = new fetchuser($workadder);
                                            $adderfirstandlast = $workadder_detail->user_actualrank . " " . $workadder_detail->user_lastname;
                                        }
                                        if ($workdetail->work_status == "Uncomplied") {
                                    ?>
                                            <?= $workdetail->work_dateadded ?>
                                            <div class="row mb-3" style="background-color: white;">
                                                <button class="btn btn-light rounded buttonzoom p-0 d-flex justify-content-center dashboard-viewworkadded " type="button" value="<?= $workdetail->work_id ?>">
                                                    <div class="row-fluid m-0 p-0" style="width:100%">
                                                        <div class="row mb-2 border-bottom">
                                                            <p class="p-0 m-0"><?= $workdetail->work_subject ?></p>
                                                        </div>
                                                        <div class="row d-flex justify-content-between">
                                                            <div class="col-8 ps-4 text-start">
                                                                <span class="" style="font-size: 12px;">Added by: <?= $adderfirstandlast ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recently Added Work Queue -->

                <!-- Recently Updated Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; height:340px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row mb-2 text-center fw-bold">
                            <span>RECENTLY UPDATED / COMPLIED WORK QUEUE</span>
                        </div>
                        <div class="row overflow-y-scroll ps-4" style="height:300px">
                            <div class="col">
                                <div class="row">
                                    <?php
                                    // * Fetchallupdates with limit to 20
                                    $updates = new fetchallupdates();
                                    $latestupdates = $updates->fetchallupdatedes();
                                    if ($latestupdates == "no Work updates!") {
                                        $latestupdates = array();
                                    }
                                    foreach ($latestupdates as $updateid) {

                                        $updates->fetchoneidupdate($updateid);
                                        $workdetail = new fetchoneworkqueue($updates->update_workid);

                                        $datetoday = date('Y-m-d');
                                        $dateupdated = $updates->update_date;
                                        $datetoday = strtotime($datetoday);
                                        $dateupdated = strtotime($dateupdated);
                                        $interval = $datetoday - $dateupdated;
                                        $daysinterval = floor($interval / (60 * 60 * 24));
                                        $user = new fetchuser($updates->update_by);
                                        $username = $user->user_actualrank . " " . $user->user_lastname . " PAF";
                                        if ($daysinterval <= 2) {

                                            if ($updates->update_status == "Complied") {
                                                $backgroundcolor = "btn-success";
                                                $title = "Complied by:";
                                                $filepath = "../pictures/complyuploads/";
                                            } else {
                                                $backgroundcolor = "btn-info";
                                                $title = "Updated by:";
                                                $filepath = "../pictures/updateuploads/";
                                            }
                                    ?>
                                            <div class="row mb-3" style="background-color: white;">
                                                <?= $updates->update_date ?>
                                                <button class="btn <?= $backgroundcolor ?> rounded buttonzoom p-0 d-flex justify-content-center dashboard_viewupdates " type="button" value="<?= $updates->update_id ?>">
                                                    <div class="row-fluid m-0 p-0" style="width:100%">
                                                        <div class="row mb-2">
                                                            <p class="p-0 m-0"><?= $workdetail->work_subject ?></p>
                                                        </div>
                                                        <div class="row d-flex justify-content-between">
                                                            <div class="col-8 ps-4 text-start">
                                                                <span class="" style="font-size: smaller;"><?= $title ?> <?= $username ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Recently Updated Work Queue -->

            </div>
            <!-- Recently Updated and Added Work Panel Panel -->
        </div>
        <div class="row " id="viewfilemodalrow">

        </div>

        <?php
        include "../includes/modals/dashboard-view_recent_work_modal.php";
        include "../includes/modals/dashboard-view_recent_update_modal.php";
        include "../includes/modals/dashboard-update_file_uploaded_modal.php";
        include "../includes/modals/dashboard-update_file_uploaded_inwork_modal.php";
        include "../includes/modals/dashboard-view_personnel_worklist_modal.php";
        include "../includes/modals/dashboard-view_onework_modal.php";
        ?>
    </div> <!-- Container -->

</body>

</html>