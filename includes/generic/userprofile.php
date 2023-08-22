<?php
switch ($where) {
    case 'home':
        $profile = "show";
        break;
    case 'myworkqueue':
        $profile = "hide";
        break;
    case 'myaddedworkqueue':
        $profile = "hide";
        break;
    case 'workhistory':
        $profile = "hide";
        break;
}

include "../classes/users-class/selectalluser-class.php";
include "../classes/work-class/worknumbers-class.php";

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
?>

<script src="../jsfiles/userprofile.js"></script>
<div class=" boxborders accordion p-0 " id="profileaccordion" style="width: 100%;">
    <div class="accordion-item boxborders">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button fs-3 fw-bold bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                USER PROFILE
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse <?= $profile ?>" aria-labelledby="flush-headingOne" data-bs-parent="#profileaccordion">
            <div class="accordion-body bg-tertiary">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-4 text-center text-sm-start">
                                    <div class="col-12 col-md-8 text-center text-sm-start">
                                        <span class="fs-3 fw-bold"><?php echo ($logged_actualrank . " " . $logged_firstname . " " . $logged_lastname . " " . $logged_serialnumber . " PAF") ?></span><br>
                                        <span class="fs-4">Accessability: <span>(<?= $logged_type; ?>)</span> <br>
                                            <?php
                                            if (!empty($logged_position)) {
                                                foreach ($logged_position as $position) {
                                                    if ($position == "DPP") {
                                                        echo "<span class='fw-bold'>DPP</span> - Financial Section<br>";
                                                    }
                                                    if ($position == "DBFEE") {
                                                        echo "<span class='fw-bold'>DBFEE</span> - Equipment and Vehicle Section<br>";
                                                    }
                                                    if ($position == "DMS") {
                                                        echo "<span class='fw-bold'>DMS</span> - POL and ICIE Section<br>";
                                                    }
                                                    if ($position == "DMA") {
                                                        echo "<span class='fw-bold'>DMA</span> - Armaments Section<br>";
                                                    }
                                                    if ($position == "DAMM") {
                                                        echo "<span class='fw-bold'>DAMM</span> - AGE Section<br>";
                                                    }
                                                    if ($position == "ADMIN") {
                                                        echo "<span class='fw-bold'>ADMIN</span> - Admin Section<br>";
                                                    }
                                                    if ($position == "DL") {
                                                        echo "<span class='fw-bold'>DL</span> - Director for Logistics<br>";
                                                    }
                                                    if ($position == "ADL") {
                                                        echo "<span class='fw-bold'>ADL</span> - Assistant Director for Logistics<br>";
                                                    }
                                                }
                                            } else {
                                            ?><span style="color:red">Please Enter assigned Section here -> <a href="settings.php">SETTINGS</a></span>
                                            <?php
                                            }
                                            ?>
                                        </span>
                                        <span class="fs-5">Member Since: <?= $logged_dateadded; ?></span>
                                    </div>
                                </div>
                                <div class="row" id="">
                                    <div class="col-xs-12 col-md-3  d-flex d-sm-inline justify-content-center me-5 border-4 ">
                                        <img src="../pictures/profilepic/<?php echo $logged_picture  ?>" onerror="this.src='../pictures/generic/imageplaceholder.png';" alt="" style=" height:230px; width:230px; border:2px solid blue; border-radius: 150px" placeholder>
                                    </div>
                                    <div class="col-xs-12 col-md-6 d-flex text-center text-sm-start d-sm-inline justify-content-center">
                                        <div class="row">
                                            <div class="col">
                                                <!-- color of duty status -->
                                                <?php
                                                if ($logged_status == 'ON DUTY') {
                                                    $status_color = "green";
                                                }
                                                if ($logged_status == 'OFF DUTY') {
                                                    $status_color = "red";
                                                }
                                                ?>
                                                <!-- color of duty status -->
                                                <span class="h6">Duty Status : <span id="currentstatus" style="color: <?= $status_color ?>"> <?= $logged_status; ?></span></span>
                                                <br>
                                                <button class="btn btn-outline-primary mt-3" style="height: 40px" id="editstatus">Update Status</button>
                                                <br>
                                                <div class="row mt-3 text-start">
                                                    <div class="col-10 col-md-5">
                                                        <span>Active Work:</span><br>
                                                        <span>Requires Update:</span><br>
                                                        <span>Deadline:</span>
                                                    </div>
                                                    <div id="profilerow" class="col-2 col-md-3 text-center text-md-start">
                                                        <span><?= $logged_totalactivework ?></span><br>
                                                        <span style="color:red"><?= $logged_needsupdate ?></span><br>
                                                        <span style="color:red"><?= $logged_neardeadline ?></span>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-12 col-md-4" id="addworkcol">
                                                        <?php
                                                        if ($logged_status == "OFF DUTY") {
                                                            $button = "disabled";
                                                        } else {
                                                            $button = "";
                                                        }
                                                        ?>
                                                        <button class="btn btn-outline-primary" style="width:150px; height: 40px" id="addworkbutton" <?= $button ?>>Add Work </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-none d-md-block">
                        <div class="row d-flex justify-content-center mt-3">
                            <div class="col d-flex justify-content-center">
                                <img src="../pictures/generic/towem_logo.png" style="height:250px; width:200px" alt="">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col mt-2">
                                <h5 class="text-center fw-bold fs-5">TACTICAL OPERATIONS WING EASTERN MINDANAO</h5>
                                <h6 class="text-center fw-bold fs-6">Directorate for Logistics</h6>
                                <h6 class="text-center fw-bold fs-6">Work Queue System</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>