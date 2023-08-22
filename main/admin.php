<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../classes/connection-class/dbconnect-class.php";

    include "../classes/users-class/selectoneuser-class.php";
    include "../classes/work-class/admin-alltotalnrofwork-include.php";
    include "../classes/work-class/allworkids.php";
    include "../classes/work-class/oneworkdetail-class.php";
    include "../classes/work-class/allworkupdates-class.php";
    +include "../classes/users-class/selectalluser-class.php";
    include "../classes/work-class/worknumbers-class.php";
    include "../classes/work-class/view-worklist-class.php";
    include "../classes/routine-class/routine-allids-class.php";
    include "../classes/routine-class/routine-details-class.php";
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
$alltotalwork = new adminallfetchnrofwork();

?>

<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>
<script src="../jsfiles/adminpanel.js"></script>


<body class=" font overflow-y-scroll">

    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        include "../includes/modals/admin-addworkmodal.php";
        include "../includes/modals/admin-updatedutystatusmodal.php";
        include "../includes/generic/toast.php";
        include "../includes/modals/deleteworkmodal.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">ADMIN</span>
        </div>
        <div class="row" id="profilediv">
            <!-- Personnel Work Queue Panel -->
            <div class="col-12 col-md-4 px-3 bg-light mb-2" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <div class="row text-center">
                    <span class="h5 fw-bold">ADMIN PERSONNEL</span>
                </div>
                <div class="row overflow-y-scroll" style="height:180px">
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
                            $userdesignation = $oneuser->user_position;
                            $userdesignation = unserialize($userdesignation);
                            if (in_array("ADMIN", $userdesignation)) {
                    ?>
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <img class="border buttonzoom view_personnel_work " type="button" id="view_personnel_work" src="../pictures/profilepic/<?php echo $oneuser->user_picture  ?>" onerror="this.src='../pictures/generic/imageplaceholder.png';" alt="" style=" height:100px; width: 100px; border-radius:10px">
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
                    }
                    ?>
                </div>
                <div class="row  text-center fw-bold mt-1 mb-3">
                    <span class="h5 fw-bold">DUTY STATUS</span>
                </div>
                <div class="row ">
                    <div class="col">
                        <div class="row overflow-y-scroll" style="height:250px" id="userstatusdiv">
                            <?php
                            $allusers = new selectalluser();
                            $allids = $allusers->fetchallusers();
                            foreach ($allids as $id) {
                                $one_user = new fetchuser($id);
                                $one_user_firstandlastname = $one_user->user_actualrank . " " . $one_user->user_firstname . " " . $one_user->user_lastname . " PAF";
                            ?>
                                <div class="row mb-2 border-bottom">
                                    <div class="col-md-8">
                                        <span class=""><?= $one_user_firstandlastname ?></span>
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
                <div class="row px-3 mb-2">
                    <button class="btn btn-primary mt-3 buttonzoom" id="updatestatusbutton">
                        Update Duty Status
                    </button>
                </div>
                <div class="row px-3 mb-2">
                    <button class="btn btn-primary mt-2 buttonzoom" id="admin-addworkbutton">
                        Add admin Work
                    </button>
                </div>
                <div class="row px-3 mb-2">
                    <button class="btn btn-primary mt-2 buttonzoom" id="addroutinework">
                        Add Routine Work
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-4 ps-md-4 mb-2">

                <!-- Total Office Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>ADMIN WORKLOAD</span>
                        </div>
                        <div class="row">
                            <div class="col-6 ms-5" style="font-size: smaller;">Active Work Queue:</div>
                            <div class="col-3 text-center" style="font-size: smaller;"><?= $alltotalwork->adminallUsertotalactiveWorkload(); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-6 ms-5" style="font-size: smaller;">For Follow up:</div>
                            <div class="col-3 text-center" style="font-size: smaller; color: green"><?= $alltotalwork->adminallUsertotalunupdatedWorkload() ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 ms-5" style="font-size: smaller;">Deadline:</div>
                            <div class="col-3 text-center" style="font-size: smaller; color:red"><?= $alltotalwork->adminallUsertotaldeadlineWorkload() ?></div>
                        </div>
                    </div>
                </div>
                <!-- Total Office Work Queue -->
                <div class="row mb-2">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>ADMIN ADDED WORK</span>
                        </div>

                        <?php
                        $worklist = new view_worklist();
                        $worklist->work_window_section("section", $logged_id, "admin");
                        ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                        <div class="row text-center fw-bold">
                            <span>ROUTINE WORK</span>
                        </div>
                        <div class="row mb-2 overflow-y-scroll overflow-x-hidden pt-2 justify-content-center" style="height:300px">
                            <div class="row d-inline">
                                <?php

                                $invoker = new fetchallroutineid();
                                $invokerarray = $invoker->routineids();
                                if ($invokerarray == 0) {
                                ?>
                                    <div class="col text-center align-items-center">
                                        <span>No Work Ruotine!</span>
                                    </div>
                                    <?php

                                    $invokerarray = array();
                                }

                                foreach ($invokerarray as $routineid) {
                                    $routine_work_details = new fetchoneroutine($routineid);
                                    if ($routine_work_details->routine_section == "admin") {
                                        $work_counter = 1;
                                    ?>
                                        <button class="btn mb-2 buttonzoom clickwork px-3 border-bottom viewadminroutinedetail" type="button" value=<?= $routine_work_details->routine_id ?> style="height:auto">
                                            <input type="hidden" id="logged_id" value="<?= $logged_user_id ?>">
                                            <div class="row text-dark text-center d-flex justify-content-around">
                                                <div class="col-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                                    </svg>
                                                </div>
                                                <div class="col-10">
                                                    <span class="text-center">
                                                        <?= $routine_work_details->routine_subject ?>
                                                    </span>
                                                </div>
                                        </button>
                                <?php
                                    }
                                    // * end of if work is uncomplied
                                }
                                // * end of foreach statement
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ps-md-4 mb-2">
                <div class="row bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                    <div class="row text-center fw-bold mb-3">
                        <span>WORK DETAILS</span>
                    </div>
                    <div class="row mb-3 ps-4 pe-0 me-0 paddingremover" id="viewadminworkdetail" style="height: 716px">

                    </div>
                </div>
            </div>


        </div> <!-- Container -->

        <div class="modal fade" id="addroutinemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addroutinemodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addroutinemodalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" name="addroutineform" id="addroutineform" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="form-label">Routine Subject:</label>
                                        <input class="form-control" type="text" id="routinesubject" name="routinesubject" value="">
                                        <input class="form-control" type="hidden" id="routinesection" name="routinesection" value="admin">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label for="form-label">Routine Frequency:</label>
                                        <select class="form-select" aria-label="Default select example" name="routineschedule" id="routineschedule" required>
                                            <option value="monthly">Monthly</option>
                                            <option value="quarterly">Quarterly</option>
                                            <option value="semiannual">Semi - Annual</option>
                                            <option value="annual">Annual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2 fw-bold">
                                    <span>Reminder:</span>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="form-label">Nr of Days before target:</label>
                                        <input class="form-control" type="number" id="routine_nrofdaysbefore" name="routine_nrofdaysbefore" min="1" max="31">
                                    </div>
                                    <div class="col-6">
                                        <label for="form-label">Nr of Days to comply:</label>
                                        <input class="form-control" type="number" id="routine_nrofdaystocomply" name="routine_nrofdaystocomply" min="1" max="31">
                                    </div>
                                </div>
                                <div class="row mb-2 fw-bold">
                                    <span>Target Date:</span>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="form-label">Starting Month</label>
                                        <select class="form-select" aria-label="Default select example" name="routinemonth" id="routinemonth" required>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="form-label">Date</label>
                                        <input class="form-control" type="number" id="routinedate" name="routinedate" min="1" max="31">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <label class="form-label p-0 ms-0 mt-2">File Reference:</label>
                                        <input class="form-control text-center" type="file" name="routinefiles[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="form-label">Routine Notes:</label>
                                        <textarea class="form-control" name="routineremarks" id="routineremarks" cols="10" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="addroutinebut" name="addroutinebut">Add Routine</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../includes/modals/deleteworkmodal.php";

        ?>
        <div class="row genericmodal" id="genericmodal">

        </div>
</body>



</html>