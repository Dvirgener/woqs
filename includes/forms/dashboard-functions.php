<?php

include "../../classes/connection-class/dbconnect-class.php";
include "../../classes/users-class/selectoneuser-class.php";
include "../../classes/users-class/selectalluser-class.php";
include "../../classes/work-class/alltotalnrofwork-include.php";
include "../../classes/work-class/allworkids.php";
include "../../classes/work-class/oneworkdetail-class.php";
include "../../classes/work-class/allworkupdates-class.php";
include "../../classes/work-class/worknumbers-class.php";
include "../../classes/work-class/view-worklist-class.php";
include "../../includes/generic/generic-workqueuelist.php";
include "../../includes/generic/generic-workdetails.php";

if (isset($_GET['viewaddedwork'])) {
    $new_addedid = $_GET['viewaddedwork'];
    view_addedwork($new_addedid);
}

if (isset($_GET['viewupdatework'])) {
    $viewupdatework = $_GET['viewupdatework'];
    view_recentupdate($viewupdatework);
}

if (isset($_GET['viewpersonalworklist'])) {
    $viewpersonalworklist = $_GET['viewpersonalworklist'];
    personalworkqueue($viewpersonalworklist);
}

if (isset($_GET['viewpersonalworklist_details'])) {

    $workviewer = new view_workdetails();
    $workviewer->view_workdetails("viewonly", "", $_GET['viewpersonalworklist_details']);
}


function view_addedwork($workid)
{

    $workdetail = new fetchoneworkqueue($workid);
?>
    <div class="row d-flex justify-content-around mb-3">
        <span>
            <span class="fw-bold">Subject:</span> <?= $workdetail->work_subject ?>
        </span>
    </div>
    <div class="row">
        <span class="fw-bold mb-2">Added to:</span>
    </div>
    <div class="row mb-2">
        <?php
        $addedusers = unserialize(($workdetail->work_user));
        foreach ($addedusers as $users) {
            $userdetails = new fetchuser($users);
            $userfirstandlastname = $userdetails->user_actualrank . " " . $userdetails->user_lastname;
        ?>
            <div class="col-4">
                <span><?= $userfirstandlastname ?></span>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="row mb-2">
        <span class="fw-bold">Remarks:</span>
    </div>
    <div class="row px-2 mb-2">
        <textarea class="form-control " name="" id="" style="height:100px" readonly><?= $workdetail->work_remarks ?></textarea>
    </div>
    <div class="row mb-2">
        <span class="fw-bold">File:</span>
    </div>
    <div class="row d-flex justify-content-center">
        <?php
        $filereference = $workdetail->work_filereference;
        $filereference = unserialize($filereference);
        if (isset($filereference[0])) {
            $referencecounter = 1;
            foreach ($filereference as $individualfile) {
        ?>
                <div class="col-6 mb-2 px-3 ">
                    <div class="row">
                        <button class="btn btn-secondary viewrecentlyaddedworkfile buttonzoom" type="button" id="viewrecentlyaddedworkfile" value="<?= $individualfile ?>">View (<?= $referencecounter ?>) </button>
                    </div>
                </div>
            <?php
                $referencecounter += 1;
            }
        } else {
            ?>
            <div class="col-6 mb-2 px-3 ">
                <div class="row">
                    <span>No File uploaded</span>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

<?php
}

function view_recentupdate($updateid)
{

    $updatedetails = new fetchallupdates();
    $updatedetails->fetchoneidupdate($updateid);
    $workdetail = new fetchoneworkqueue($updatedetails->update_workid);
?>
    <div class="row mb-2">
        <span class="fw-bold"> Remarks:</span>
    </div>
    <div class="row px-2 mb-2">
        <textarea class="form-control " name="" id="" style="height:100px" readonly><?= $updatedetails->update_remarks ?></textarea>
    </div>
    <div class="row mb-2">
        <div class="col-2 d-flex align-items-center">
            <span class="fw-bold">File:</span>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <?php
        if ($updatedetails->update_status == "Update") {
            $filereference = $updatedetails->update_file;
            $filereference = unserialize($filereference);
            if (isset($filereference[0])) {
                $referencecounter = 1;
                foreach ($filereference as $individualfile) {
        ?>
                    <div class="col-6 mb-2 px-3 ">
                        <div class="row">
                            <button class="btn btn-secondary viewrecently_updated buttonzoom" type="button" id="viewrecentlyaddedworkfile" value="<?= $individualfile . ",../pictures/updateuploads/" ?>">View (<?= $referencecounter ?>) </button>
                        </div>
                    </div>
                <?php
                    $referencecounter += 1;
                }
            } else {
                ?>
                <div class="col-6 mb-2 px-3 ">
                    <div class="row">
                        <span>No File uploaded</span>
                    </div>
                </div>
                <?php
            }
        } else if ($updatedetails->update_status == "Complied") {

            $filereference = $workdetail->work_compliancefile;
            $filereference = unserialize($filereference);
            if (isset($filereference[0])) {
                $referencecounter = 1;
                foreach ($filereference as $individualfile) {
                ?>
                    <div class="col-6 mb-2 px-3 ">
                        <div class="row">
                            <button class="btn btn-secondary viewrecently_updated buttonzoom" type="button" id="viewrecentlyaddedworkfile" value="<?= $individualfile . ",../pictures/complyuploads/" ?>">View (<?= $referencecounter ?>) </button>
                        </div>
                    </div>
                <?php
                    $referencecounter += 1;
                }
            } else {
                ?>
                <div class="col-6 mb-2 px-3 ">
                    <div class="row">
                        <span>No File uploaded</span>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>

<?php
}


function personalworkqueue($user_id)
{

    $userdetails = new fetchuser($user_id);
    if (!empty($userdetails->user_position)) {
        $positions = unserialize($userdetails->user_position);
    } else {
        $positions = array();
    }


?>
    <div class="modal-header text-center d-flex justify-content-center  bg-primary text-light">
        <h1 class="modal-title fs-5 " id="view_personnel_worklist_label"><?= $userdetails->user_actualrank . " " . $userdetails->user_firstname . " " . $userdetails->user_lastname . " PAF" ?></h1>
    </div>

    <div class="modal-body">
        <div class="row overflow-y-scroll overflow-x-hidden ps-2 pe-3" style="height:530px;" id="dashboard-personalworklist">
            <div class="row-fluid overflow-x-hidden pe-4 mb-2" style=" padding-left:30px; padding-right:30px">
                <?php
                $worklist = new view_worklist();
                $worklist->work_window("myworkqueue", $positions, $user_id);
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

<?php
}
