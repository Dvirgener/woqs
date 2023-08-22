<?php

include "../../classes/connection-class/dbconnect-class.php";
include "../../classes/users-class/selectoneuser-class.php";
include "../../classes/users-class/selectalluser-class.php";
include "../../classes/work-class/allworkids.php";
include "../../classes/work-class/oneworkdetail-class.php";
include "../../classes/work-class/allworkupdates-class.php";


$work_id = $_GET['userid'];

viewmywork($work_id);


function viewmywork($work_id)
{

    $onework = new fetchoneworkqueue();
    $onework->fetchoneworkqueue($work_id);

    $workusers = $onework->work_user;
    $workusers = unserialize($workusers);

    $firstandlastnamestring = array();
    foreach ($workusers as $users) {
        $eachuser = new fetchuser($users);
        $eachuser_firstlastname = $eachuser->user_actualrank . " " . $eachuser->user_lastname;
        array_push($firstandlastnamestring, $eachuser_firstlastname);
    }


    if ($onework->work_added == 0) {
        $workadder_frst_lastname = $onework->work_addedfrom;
    } else {
        $workadder = $onework->work_added;
        $workadder_detail = new fetchuser($workadder);
        $workadder_frst_lastname = $workadder_detail->user_actualrank . " " . $workadder_detail->user_lastname;
    }

?>
    <div class="row sticky-top titleborder">
        <div class="col fw-bolder text-decoration-underline fs-3 mb-3  ">
            "<?= $onework->work_subject ?>"awcdwcw
        </div>
    </div>
    <div class="row mb-2">
        <div class="col fw-bold">
            Work Added to:
        </div>
    </div>
    <div id="usersrower" class="row mb-3">
        <?php
        foreach ($firstandlastnamestring as $users) {
            echo "<div class='col-4'>" . $users . "</div>";
        }
        ?>
    </div>
    <div class="row">
        <div class="col fw-bold mb-3">
            Added by:
        </div>
        <div class="col mb-3" id="add">
            <?= $workadder_frst_lastname ?>
        </div>
    </div>
    <div class="row">
        <div class="col fw-bold mb-3">
            Work Type:
        </div>
        <div class="col mb-3" id="worktype">
            <?= $onework->work_type ?>
        </div>
    </div>
    <div class="row">
        <div class="col fw-bold mb-2">
            Initial Remarks:
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">

            <textarea class="form-control" name="" id="initremarks" cols="5" rows="5" style="width:100%" readonly><?= $onework->work_remarks; ?></textarea>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col fw-bold">
            Date Added:
        </div>
        <div class="col text-start" id="dateadded">
            <?= $onework->work_dateadded ?>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col fw-bold">
            Target Date:
        </div>
        <div class="col text-start" id="targetdate">
            <?= $onework->work_targetdate ?>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col fw-bold">
            Last Updated:
        </div>
        <div class="col text-start" id="lastupdate">
            <?= $onework->work_dateupdated ?>
        </div>
    </div>
    <div class="row text-center mb-2">
        <span>Updates History</span>
    </div>
    <div class="row d-flex justify-content-center overflow-auto" style="height: 300px;" id="updatingdiv">
        <div class="accordion" id="accordionExample">
            <?php
            $updates = new fetchallupdates();
            $allupdateids = $updates->fetchallupdateid($onework->work_id);
            $updatedbyarray = array();
            $updateddate = array();
            $updatedremarks = array();
            $updatefile = array();
            $nrofupdates = 0;
            if ($allupdateids == "no Work updates!") {
                exit();
            } else {

                foreach ($allupdateids as $update) {
                    $oneupdate = new fetchallupdates();
                    $oneupdate->fetchoneworkupdate($update, $onework->work_id);
                    $updateby = new fetchuser($oneupdate->update_by);
                    $adderfirstandlastname = $updateby->user_actualrank . " " . $updateby->user_lastname;

                    array_push($updatedbyarray, $adderfirstandlastname);
                    array_push($updateddate, $oneupdate->update_date);
                    array_push($updatedremarks, $oneupdate->update_remarks);
                    array_push($updatefile, $oneupdate->update_file);

                    $nrofupdates += 1;
                }
            }

            for ($i = 0; $i < $nrofupdates; $i += 1) {
            ?>
                <div class="accordion-item boxborders mb-2">
                    <h2 class="accordion-header ">
                        <button class="accordion-button collapsed bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2<?= $i; ?>" aria-expanded="false" aria-controls="flush-collapse2<?= $i; ?>">
                            <span class="me-4"><?= $updatedbyarray[$i]; ?></span><span>(<?= $updateddate[$i]; ?>)</span>
                        </button>
                    </h2>
                    <div id="flush-collapse2<?= $i; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample3">
                        <div class="accordion-body">
                            <div class="row mb-2" style="height:100px">
                                <span class="ms-1"><?= $updatedremarks[$i]; ?></span>
                            </div>
                            <?php
                            if ($updatefile[$i] != "updatefile-") {
                            ?>
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#update_filestaticBackdrop<?= $i ?>">
                                    View file
                                </button>

                                <!-- Modal -->
                                <div class="modal modal-lg fade" id="update_filestaticBackdrop<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="update_file_staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="height: 100%; width:100%;">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="update_file_staticBackdropLabel">Update File</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mb-4">
                                                <img src="../pictures/updateuploads/<?= $updatefile[$i]; ?>" alt="" style=" height:100%; width:100%; border:2px solid blue;">

                                            </div>
                                            <div class=" modal-footer mt-5">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                            <div class="row">
                                <div class="col">Date:</div>
                                <div class="col"><?= $updateddate[$i]; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>


<?php
}
