<!-- //* THIS IS FOR THE UPDATE STATUS Modal -->
<!-- Update Duty Status Modal  -->
<div class="modal fade" id="updatestatusmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Duty Status</h5>
            </div>
            <form action="" method="POST" id="updatestatusform">
                <div class="modal-body">
                    <label for="userstatus">Duty Status: </label>
                    <br>
                    <select class="form-select" aria-label="Default select example" name="userstatus" id="userstatus">
                        <option value="ON DUTY">ON DUTY</option>
                        <option value="OFF DUTY">OFF DUTY</option>
                    </select>
                    <label class="form-label" for="statusremarks"></label>
                    <textarea class="form-control" name="statusremarks" id="statusremarks" cols="20" rows="5"></textarea>
                    <input type="hidden" name="userid" id="userid" value="<?php echo ($logged_id); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="workstatus" id="workstatus">Update!</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Duty Status Modal  -->