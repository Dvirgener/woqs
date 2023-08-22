<?php

// * this is the class for edit work modal
class edit_work_details
{
    // * assigning global variable or properties for the class
    public $logged_id;
    public $logged_position;
    public $editfrom;

    // * assigning property values as soon as you create an object from this class
    public function __construct($editfrom, $logged_id, $logged_position)
    {
        $this->logged_id = $logged_id;
        $this->logged_position = $logged_position;
        $this->editfrom = $editfrom;
    }

    // * function for the individual divs
    public function userdiv($user_id, $user_name)
    {
?>
        <div class="col-6 mb-3">
            <input class="form-check-input" type="checkbox" name="allusers[]" value="<?= $user_id ?>" required>
            <label class="form-check-label" for="allusers[]"><?= $user_name ?></label>
        </div>
    <?php
    }

    // * function to filter users that the users should add the work to
    public function usersselect($editfrom, $logged_id)
    {
        $allusers = new selectalluser();
        $allusersarray = $allusers->fetchallusers();
        sort($allusersarray);

        $logged_userdetail = new fetchuser($logged_id);
        switch ($editfrom) {
            case "directededitwork":
                foreach ($allusersarray as $user) {
                    $oneuser = new fetchuser($user);
                    if ($logged_userdetail->user_type == "DL") {
                        if ($logged_id != $oneuser->user_id) {
                            if ($oneuser->user_status != "OFF DUTY") {
                                $this->userdiv($oneuser->user_id, $oneuser->completelastname());
                            }
                        }
                    } else if ($logged_userdetail->user_type == "ASST DL") {
                        if ($logged_userdetail->user_rank > $oneuser->user_rank || $logged_userdetail->user_serialnumber < $oneuser->user_serialnumber) {
                            if ($oneuser->user_status != "OFF DUTY") {
                                $this->userdiv($oneuser->user_id, $oneuser->completelastname());
                            }
                        }
                    } else if ($logged_userdetail->user_type == "NCOIC") {
                        if ($oneuser->user_class == "EP") {
                            if ($oneuser->user_status != "OFF DUTY") {
                                $this->userdiv($oneuser->user_id, $oneuser->completelastname());
                            }
                        }
                    } else if ($logged_userdetail->user_type == "Regular User") {
                        if ($oneuser->user_class == "EP") {
                            if ($logged_userdetail->user_id == $oneuser->user_id || $logged_userdetail->user_rank > $oneuser->user_rank || $logged_userdetail->user_serialnumber < $oneuser->user_serialnumber) {
                                if ($oneuser->user_status != "OFF DUTY") {
                                    $this->userdiv($oneuser->user_id, $oneuser->completelastname());
                                }
                            }
                        }
                    }
                }
                break;
            case "admineditwork":
                foreach ($allusersarray as $user) {
                    $oneuser = new fetchuser($user);
                    if ($oneuser->user_status != "OFF DUTY") {
                        $this->userdiv($oneuser->user_id, $oneuser->completelastname());
                    }
                }
                break;
        }

        // fetch each user ids
    }

    // * Function for the work details
    public function editworkdetails($work_id)
    {
        $workdetails = new fetchoneworkqueue($work_id);
    ?>
        <div class=" row">
            <div class="col-12 col-md-6">
                <div class="row mx-1 mb-3 form-floating">
                    <input class="form-control g-1" type="text" name="editworksubject" id="editworksubject" style="height:100px" value="<?= $workdetails->work_subject ?>" required>
                    <label class="" for="editworksubject">Subject:</label>
                </div>
                <div class="row mx-1 form-floating">
                    <div class="col-6 col-md-6 ps-0 mt-2 form-floating">
                        <select class="form-select" aria-label="Default select example" name="editworktype" id="editworktype" required>
                            <option value="<?= $workdetails->work_type ?>" selected><?= $workdetails->work_type ?></option>
                            <option value="Compliance">Compliance</option>
                            <option value="Errand">Errand</option>
                            <option value="Errand">Financial</option>
                            <option value="Errand">Request</option>
                            <option value="Follow up">Follow up </option>
                        </select>
                        <label class="" for="editworktype">Type:</label>
                    </div>
                    <div class="col-6 col-md-6 p-0 mt-2 form-floating">
                        <input class="form-control g-1" type="date" name="editworktargetdate" id="editworktargetdate" value="">
                        <label class="" for="editworktargetdate">Target Date:</label>
                    </div>
                </div>
                <div class="row mx-1">
                    <label class="form-label p-0 ms-0 mt-2">Upload Files:</label>
                    <input class="form-control text-center" type="file" name="workfiles[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                </div>
                <div class="row mx-1 ">
                    <label class="form-label p-0 mt-2" for="editworkintremarks">Work Instructions / Remarks:</label>
                    <textarea class="form-control" name="editworkintremarks" id="editworkintremarks" rows="5"><?= $workdetails->work_remarks ?></textarea>
                </div>
            </div>
            <div class="col-12 col-md-6  mt-2">
                <div class="row mb-3">
                    <span>Add Work to:</span>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <input class="form-check-input" type="checkbox" id="checkall">
                        <label class="form-check-label" for="checkall">Select All</label>
                    </div>
                </div>
                <div class="row overflow-auto">
                    <?php
                    $this->usersselect($this->editfrom, $this->logged_id)
                    ?>
                    <!-- hidden input for work adder ID -->
                    <input type="hidden" id="editid" name="editid" value="<?= $workdetails->work_id ?>">
                </div>
            </div>
        </div>
    <?php
    }

    // * function for The MODAL itself
    public function editworkmodal($work_id)
    {
    ?>
        <div class="modal modal-lg fade" id="editworkmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog boxborders">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-light">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Work Queuess</h5>
                    </div>
                    <form action="" method="POST" id="editworkform">
                        <div class="modal-body " id="editworkmodaldetails">
                            acwdawcw
                            <?php
                            $this->editworkdetails($work_id);
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" id="editworkcancel">Cancel</button>
                            <button class="btn btn-primary" type="submit" name="editworkbut" id="editworkbut">Update Work</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}





?>