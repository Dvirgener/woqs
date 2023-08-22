<!-- //* THIS IS FOR THE ADD WORK Modal -->
<!-- Add Work Modal  -->
<div class="modal modal-lg fade " id="addworkmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog boxborders">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Add Work Queue</h5>
            </div>
            <form action="" method="POST" id="addworkform" enctype="multipart/form-data">
                <div class="modal-body ">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row mx-1 mb-3 form-floating">
                                <input class="form-control g-1" type="text" name="addworksubject" id="addworksubject" style="height:100px" required>
                                <label class="" for="addworksubject">Subject:</label>
                            </div>
                            <div class="row mx-1 form-floating">
                                <div class="col-6 col-md-6 ps-0 mt-2 form-floating">
                                    <select class="form-select" aria-label="Default select example" name="addworktype" id="addworktype" required>
                                        <option value="" selected></option>
                                        <option value="Compliance">Compliance</option>
                                        <option value="Errand">Errand</option>
                                        <option value="Errand">Financial</option>
                                        <option value="Errand">Request</option>
                                        <option value="Follow up">Follow up </option>
                                    </select>
                                    <label class="" for="addworktype">Type:</label>
                                </div>
                                <div class="col-6 col-md-6 p-0 mt-2 form-floating">
                                    <input class="form-control g-1" type="date" name="addworktargetdate" id="addworktargetdate" value="">
                                    <label class="" for="addworktargetdate">Target Date:</label>
                                </div>
                            </div>
                            <div class="row mx-1">
                                <label class="form-label p-0 ms-0 mt-2">Upload Files:</label>
                                <input class="form-control text-center" type="file" name="workfiles[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                            </div>
                            <div class="row mx-1 ">
                                <label class="form-label p-0 mt-2" for="addworkintremarks">Work Instructions / Remarks:</label>
                                <textarea class="form-control" name="addworkintremarks" id="addworkintremarks" rows="5"></textarea>
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
                                $allusers = new selectalluser();
                                function userdiv($count, $id, $rank, $lastname)
                                {
                                ?>
                                    <div class="col-6 mb-3">
                                        <input class="form-check-input" type="checkbox" name="allusers[]" id="allusers<?= $count ?>" value="<?= $id ?>" required>
                                        <label class="form-check-label" for="allusers<?= $count ?>"><?= "   " ?><?= $rank ?><span> </span><?= $lastname ?></label>
                                    </div>
                                <?php
                                }
                                // fetch each user ids
                                $allusersarray = $allusers->fetchallusers();
                                sort($allusersarray);
                                $peruser = 1;
                                foreach ($allusersarray as $user) {
                                    $oneuser = new fetchuser($user);
                                    if ($logged_type == "DL") {
                                        if ($logged_id != $oneuser->user_id) {
                                            if ($oneuser->user_status != "OFF DUTY") {
                                                userdiv($peruser, $oneuser->user_id, $oneuser->user_actualrank, $oneuser->user_lastname);
                                                $peruser++;
                                            }
                                        }
                                    } else if (
                                        $logged_type == "ASST DL"
                                    ) {
                                        if ($logged_rank > $oneuser->user_rank || $logged_serialnumber < $oneuser->user_serialnumber) {
                                            if ($oneuser->user_status != "OFF DUTY") {
                                                userdiv($peruser, $oneuser->user_id, $oneuser->user_actualrank, $oneuser->user_lastname);
                                                $peruser++;
                                            }
                                        }
                                    } else if (
                                        $logged_type == "NCOIC"
                                    ) {
                                        if ($oneuser->user_class == "EP") {
                                            if ($oneuser->user_status != "OFF DUTY") {
                                                userdiv($peruser, $oneuser->user_id, $oneuser->user_actualrank, $oneuser->user_lastname);
                                                $peruser++;
                                            }
                                        }
                                    } else if (
                                        $logged_type == "Regular User"
                                    ) {
                                        if ($oneuser->user_class == "EP") {
                                            if ($logged_id == $oneuser->user_id || $logged_rank > $oneuser->user_rank || $logged_serialnumber < $oneuser->user_serialnumber) {
                                                if (
                                                    $oneuser->user_status != "OFF DUTY"
                                                ) {
                                                    userdiv($peruser, $oneuser->user_id, $oneuser->user_actualrank, $oneuser->user_lastname);
                                                    $peruser++;
                                                }
                                            }
                                        }
                                    }
                                }
                                // fetch each user ids
                                ?>
                                <!-- hidden input for work adder ID -->
                                <input type="hidden" id="addedby" name="addedby" value="<?= $logged_id ?>">
                                <input type="hidden" id="numberofusers" name="numberofusers" value="<?= $peruser ?>">
                                <input type="hidden" id="addedfrom" name="addedfrom" value="directed">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="addworkcancel">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="addworkbut" id="addworkbut">Add Work</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Work Modal  -->