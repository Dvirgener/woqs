<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../classes/connection-class/dbconnect-class.php";
    include "../classes/users-class/selectoneuser-class.php";
    include "../classes/work-class/alltotalnrofwork-include.php";
    include "../classes/work-class/allworkids.php";
    include "../classes/work-class/oneworkdetail-class.php";
    include "../classes/work-class/allworkupdates-class.php";
    include "../classes/users-class/selectalluser-class.php";
    include "../classes/work-class/worknumbers-class.php";
    include "../classes/work-class/view-worklist-class.php";
    include "../includes/generic/generic-workqueuelist.php";



    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}

// * Fetch one user class
$loggeduser = new fetchuser($logged_id);
// * Fetch all work from user class
$usernrofwork = new fetchnrofwork($logged_id);
//  * Fetch Logged in details
$logged_id = $loggeduser->user_id;
$logged_firstname = $loggeduser->user_firstname;
$logged_lastname = $loggeduser->user_lastname;
$logged_rank = $loggeduser->user_rank;
$logged_actualrank = $loggeduser->user_actualrank;
$logged_serialnumber = $loggeduser->user_serialnumber;
$logged_type = $loggeduser->user_type;
$logged_dateadded = $loggeduser->user_dateadded;
$logged_status = $loggeduser->user_status;
$logged_class = $loggeduser->user_class;
$logged_picture = $loggeduser->user_picture;
//  * Fetch Logged in workload
$logged_totalactivework = $usernrofwork->UsertotalactiveWorkload($logged_id);
$logged_needsupdate = $usernrofwork->UsertotalunupdatedWorkload($logged_id);
$logged_neardeadline = $usernrofwork->UsertotaldeadlineWorkload($logged_id);

// * Fetch all Work Queue
$alltotalwork = new allfetchnrofwork();

?>

<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>
<script src="../jsfiles/viewworkdetail.js"></script>
<script src="../jsfiles/addwork.js"></script>

<body class=" font overflow-y-scroll">

    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">USER PROFILE</span>
        </div>
        <div class="row" id="profilediv">
            <!-- Personnel Work Queue Panel -->
            <div class="col-12 col-md-4  bg-light mb-2" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <div class="row  text-center fw-bold mt-1 mb-3">
                    <span class="h5 fw-bold"><?= $logged_actualrank . " " . $logged_firstname . " " . $logged_lastname . " PAF"  ?></span>
                </div>
                <div class="row justify-content-center">
                    <div class="row mb-2 align-items-start pb-2">
                        <div class="col-4 text-center">
                            <img class="border view_personnel_work img-fluid " type="button" id="view_personnel_work" src="../pictures/profilepic/<?php echo $logged_picture  ?>" onerror="this.src='../pictures/generic/imageplaceholder.png';" alt="" style=" border-radius:10px">
                        </div>
                        <div class="col-8 ps-3 align-items-center">
                            <div class="row d-flex flex-column">
                                <div class="row mb-1">
                                    <div class="col-9">Active Work:</div>
                                    <div class="col-3"><?= $logged_totalactivework ?></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-9">For Follow up:</div>
                                    <div class="col-3" style=" color: green"><?= $logged_needsupdate ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-9">Deadline:</div>
                                    <div class="col-3" style="color:red"><?= $logged_neardeadline ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-7">Duty Status:</div>
                                    <?php
                                    if ($logged_status == "ON DUTY") {
                                        $stylecolor = "green";
                                    } else {
                                        $stylecolor = "red";
                                    }
                                    ?>
                                    <div class="col-5 px-0" style="color:<?= $stylecolor ?>;"><?= $logged_status ?></div>
                                </div>
                                <div class="row">
                                    <span><a href="settings.php" class="btn btn-primary p-1 buttonzoom" style="font-size: small;">Profile Settings</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <span>
                            <span class="fw-bold">Account Created: </span><?= $logged_dateadded ?>
                        </span>
                    </div>
                    <div class="row fw-bold mb-2">
                        <span>Office Accessability:</span>
                    </div>
                    <div class="row mb-4">
                        <?php
                        if (!empty($logged_position)) {
                            foreach ($logged_position as $position) {
                                if ($position == "DPP") {
                                    echo "<div class='row'><span>DPP - Financial Section</span></div>";
                                }
                                if ($position == "DBFEE") {
                                    echo "<div class='row'><span>DBFEE - Facilities and Equipment</span></div>";
                                }
                                if ($position == "DMS") {
                                    echo "<div class='row'><span>DMS - POL and ICIE Section</span></div>";
                                }
                                if ($position == "DMA") {
                                    echo "<span class='row'><span>DMA - Armaments Section</span>";
                                }
                                if ($position == "DAMM") {
                                    echo "<div class='row'><span>DAMM - AGE Section</span></div>";
                                }
                                if ($position == "ADMIN") {
                                    echo "<div class='row'><span>ADMIN - Admin Section</span></div>";
                                }
                                if ($position == "DL") {
                                    echo "<div class='row'><span>DL - Director for Logistics</span></div>";
                                }
                                if ($position == "ADL") {
                                    echo "<div class='row'><span>ADL - Assistant Director for Logistics</span></div>";
                                }
                            }
                        } else {
                        ?><span style="color:red">Please Enter assigned Section here -> <a href="settings.php">SETTINGS</a></span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <button class="btn btn-primary buttonzoom " id="addworkbutton" style="width:150px; font-size:smaller">Add Work Queue</button>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button class="btn btn-primary buttonzoom" style="width:150px; font-size:smaller">Add Activity</button>
                        </div>
                    </div>
                    <div class="row mb-3 px-4">
                        <button class="btn btn-primary buttonzoom clicked" id="myworkqueuebut" value="myworkqueuebut">My Work Queue</button>
                    </div>
                    <div class="row mb-3 px-4">
                        <button class="btn btn-primary buttonzoom clicked" id="myaddworkbut" value="myaddworkbut">Added Work Queue</button>
                    </div>
                    <div class="row mb-3 px-4">
                        <button class="btn btn-primary buttonzoom clicked" id="myworkhistorybut" value="myworkhistorybut">Work History</button>
                    </div>
                    <div class="row mb-3 px-4">
                        <button class="btn btn-primary buttonzoom clicked" id="myupcomingactivitiesbut" value="myupcomingactivitiesbut">Upcoming Activities</button>
                    </div>
                    <div class="row mb-3 px-4">
                        <button class="btn btn-primary buttonzoom clicked" id="myactivityhistorybut" value="myactivityhistorybut">Activity History</button>
                    </div>
                </div>
            </div>
            <input type="hidden" id="logged_id" value="<?= $logged_id ?>">
            <div class="col-12 col-md-8" id="workpaneldiv">

                <?php
                include "myworkqueue.php";
                ?>
            </div>
            <div class="row" id="genericmodal">

            </div>

        </div> <!-- Container -->

        <?php
        include "../includes/modals/addworkmodal.php";
        include "../includes/generic/toast.php";
        include "../includes/modals/updatemodal.php";
        include "../includes/modals/complymodal.php";
        include "../includes/modals/deleteworkmodal.php";
        ?>

</body>



</html>