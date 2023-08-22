<?php

class view_workdetails
{
    public $logged_id;
    public $viewfrom;



    public function view_workdetails($viewfrom, $logged_id, $work_id)
    {
        $this->logged_id = $logged_id;
        $this->viewfrom = $viewfrom;
        $onework = new fetchoneworkqueue($work_id);
        $workusers = $onework->work_user;
        $workusers = unserialize($workusers);
        if ($onework->work_added == 0) {
            $adder = $onework->work_addedfrom;
            $this->workdetails_htmltags($viewfrom, $work_id, $adder);
        } else {
            $adder = new fetchuser($onework->work_added);
            $this->workdetails_htmltags($viewfrom, $work_id, $adder->completelastname());
        }
?>
    <?php
    }
    // * This function is for the update or comply buttons
    public function workaction_update_comply($work_id)
    {
    ?>
        <div class="col-6 mb-2 px-3">
            <div class="row">
                <button class="btn btn-primary buttonzoom" id="updateworks" type="button" value="<?= $work_id ?>">Update</button>
            </div>
        </div>
        <div class="col-6 mb-2 px-3">
            <div class="row">
                <button class="btn btn-primary buttonzoom" id="complyworks" type="button" value="<?= $work_id ?>">Comply</button>
            </div>
        </div>
    <?php
    }
    // * This function is for the update or comply buttons


    // * This function is for the edit or delete buttons
    public function workaction_edit_delete($work_id)
    {
    ?>
        <div class="col-6 mb-2 px-3">
            <div class="row">
                <button class="btn btn-primary buttonzoom editbutton" id="editworks" type="button" value="<?= $work_id ?>">Edit</button>
            </div>
        </div>
        <div class="col-6 mb-2 px-3">
            <div class="row">
                <button class="btn btn-primary buttonzoom deleteworkbutton" id="deleteworkbutton" type="button" value="<?= $work_id ?>">Delete</button>
            </div>
        </div>

    <?php
    }
    // * This function is for the edit or delete buttons


    public function workdetails_htmltags($viewfrom, $work_id, $work_adder)
    {
        // * Fetch work details of a specific work ID
        $workdetail = new fetchoneworkqueue($work_id);
        // *store added users array
        $work_addedarray = unserialize($workdetail->work_user);
    ?>
        <div class="row-fluid">
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Subject:
                </div>
                <div class="col-8">
                    <?= $workdetail->work_subject ?>
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Added by:
                </div>
                <div class="col-8">
                    <?= $work_adder ?>
                </div>
            </div>
            <div class="row">
                <span class="fw-bold mb-2">Added to:</span>
            </div>
            <div class="row mb-2 overflow-auto">
                <?php
                foreach ($work_addedarray as $users) {
                    $addeduserdetail = new fetchuser($users);
                ?>
                    <div class="col-4">
                        <span><?= $addeduserdetail->completelastname() ?></span>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="row mb-2">
                <span class="fw-bold">Remarks:</span>
            </div>
            <div class="row ps-2 mb-2">
                <textarea class="form-control " name="" id="" style="height:150px" readonly><?= $workdetail->work_remarks; ?></textarea>
            </div>
            <div class="row mb-4">
                <div class="col-5 fw-bold">
                    Work Type:
                </div>
                <div class="col-7">
                    <?= $workdetail->work_type ?>
                </div>
            </div>

            <div class="row d-flex justfiy-content-center mb-2">
                <?php
                switch ($viewfrom) {
                    case "myworkqueue":
                        $this->workaction_update_comply($work_id);
                        break;
                    case "addedworkqueue":
                        $this->workaction_edit_delete($work_id);
                        break;
                    case "viewonly":
                        break;
                    case "myworkhistory":
                        $workcomplier = new fetchuser($workdetail->work_compliedby);
                ?>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">
                                Complied by:
                            </div>
                            <div class="col-7">
                                <?= $workcomplier->completelastname() ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5 fw-bold">
                                Timeliness:
                            </div>
                            <div class="col-7">
                                <?= $workdetail->work_timeliness ?>
                            </div>
                        </div>
                <?php
                        break;
                }
                ?>
            </div>
            <div class="row">
                <div class="col-6 fw-bold">
                    Date Added:
                </div>
                <div class="col-6">
                    <?= $workdetail->work_dateadded ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6 fw-bold">
                    Date Updated:
                </div>
                <div class="col-6">
                    <?= $workdetail->work_dateupdated ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6 fw-bold">
                    Date Deadline:
                </div>
                <div class="col-6">
                    <?= $workdetail->work_targetdate ?>
                </div>
            </div>
        <?php
        $filereferencearray = unserialize($workdetail->work_filereference);
        $this->file_listing($filereferencearray);
        $this->updates_record($work_id);
    }

    public function file_listing($filereferencearray)
    {
        $filebuttonclass = "viewfilereference";
        if ($this->viewfrom == "viewonly") {
            $filebuttonclass = "dashboard-viewfilereference";
        }

        ?>
            <div class="row mb-2">
                <div class="col-6 fw-bold mb-2">
                    File reference:
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <?php
                if (isset($filereferencearray[0])) {
                    $referencecounter = 1;
                    foreach ($filereferencearray as $individualfile) {
                ?>
                        <div class="col-6 mb-2 px-3 ">
                            <div class="row">
                                <button class="btn btn-secondary <?= $filebuttonclass ?> buttonzoom" type="button" id="<?= $filebuttonclass ?>" value="<?= $individualfile ?>">View (<?= $referencecounter ?>) </button>
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
            <div class="row" id="viewfilemodalrow">
            </div>
        <?php
    }

    public function updates_record($work_id)
    {
        ?>
            <div class="row fw-bold mb-2">
                <span>Update Record:</span>
            </div>
            <div class="row overflow-y-scroll px-2" style="height:250px ;padding-left:0px">
                <?php
                $updates = new fetchallupdates();
                $allupdateids = $updates->fetchallupdateid($work_id);
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
                        $oneupdate->fetchoneworkupdate($update, $work_id);
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
                    <div class="row-fluid mb-3 mt-1 rounded" style=" box-shadow:0px 0px 3px 1px gray; background-color:white;">
                        <div class="row ps-4 border-bottom">
                            <div class="row">
                                <div class="col-5 fw-bold">
                                    By:
                                </div>
                                <div class="col-7 mb-2">
                                    <?= $updatedbyarray[$i]; ?>
                                </div>
                                <div class="col-5 fw-bold">
                                    Date:
                                </div>
                                <div class="col-7 mb-2">
                                    <?= $updateddate[$i]; ?>
                                </div>
                            </div>
                            <div class="row fw-bold mb-2">
                                <span>Remarks:</span>
                            </div>
                            <div class="row mb-3 border-bottom">
                                <span><?= $updatedremarks[$i]; ?></span>
                            </div>
                            <div class="row fw-bold mb-2">
                                <span>Files:</span>
                            </div>
                            <div class="row mb-4">
                                <?php
                                $filebuttonclass = "viewfileupdate";
                                if ($this->viewfrom == "viewonly") {
                                    $filebuttonclass = "awviewrecently_updated";
                                }
                                $updatefileviewer = unserialize($updatefile[$i]);
                                if (isset($updatefileviewer[0])) {
                                    $filecounter = 1;
                                    foreach ($updatefileviewer as $individualupdatefile) {
                                ?>
                                        <div class="col-6 mb-2 px-3 ">
                                            <div class="row">
                                                <button class="btn btn-secondary <?= $filebuttonclass ?> buttonzoom" type="button" id="<?= $filebuttonclass ?>" value="<?= $individualupdatefile ?>">View (<?= $filecounter ?>)</button>
                                            </div>
                                        </div>
                                    <?php
                                        $filecounter += 1;
                                    }
                                } else {
                                    ?>
                                    <div class="col-8 mb-2 px-3 ">
                                        <div class="row">
                                            <span>No File uploaded</span>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
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
}
