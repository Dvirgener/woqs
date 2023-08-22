<div class="modal fade" id="updatestatusmodal" tabindex="-1" aria-labelledby="updatestatusmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5 " id="updatestatusmodalLabel">Update Status</h1>
            </div>
            <div class="modal-body">
                <form action="" method="POST" name="updatestatusform" id="updatestatusform">
                    <div class="row mb-3">
                        <div class="col form-floating">
                            <select class="form-select" aria-label="Default select example" name="status_personnel" id="status_personnel">
                                <?php
                                $allusers = new selectalluser();
                                $alluserid = $allusers->fetchallusers();
                                foreach ($alluserid as $userid) {
                                    $userdetail = new fetchuser($userid);
                                    $firstandlast = $userdetail->user_actualrank . " " . $userdetail->user_firstname . " " . $userdetail->user_lastname . " PAF";
                                ?>
                                    <option value="<?= $userdetail->user_id ?>"><?= $firstandlast ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label class=" ps-4" for="status_personnel">Select User</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col form-floating">
                            <select class="form-select" aria-label="Default select example" name="status_update" id="status_update">
                                <option value="ON DUTY">ON DUTY</option>
                                <option value="OFF DUTY">OFF DUTY</option>
                            </select>
                            <label class=" ps-4" for="status_update">Duty Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-floating">
                            <textarea class="form-control" name="statusremarks" id="statusremarks" style="height:120px"></textarea>
                            <label class="ps-4" for=" statusremarks">Remarks:</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="updatestatussubmit" name="updatestatussubmit">Update Status</button>
            </div>
            </form>
        </div>
    </div>
</div>