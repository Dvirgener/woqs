<!-- Update my Work Modal -->
<div class="modal fade" id="updateworkmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog boxborders">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Remarks:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- /dlwoqs/main/modals/aw.php -->
            <form name="updateonework" id="updateonework" action="" method="POST" class="logforms" enctype="multipart/form-data">
                <div class="modal-body canaddupdatefile" id="canaddupdatefile">
                    <textarea class="form-control g-1" name="updateworkremarks" id="updateworkremarks" cols="10" rows="5"></textarea>
                    <input type="hidden" id="updatebyid" name="updatebyid" value="<?= $logged_id ?>">
                    <input type="hidden" id="workidtoupdate" name="workidtoupdate" value="">

                    <label class="form-label mt-2">Upload Files:</label>
                    <input class="form-control text-center" type="file" name="updatefiles[]" accept=".jpg,.jpeg,.png" id="updatefile" value="" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary" id="addmoreuploadfile">Add More Files</button> -->
                    <button type="submit" name="updateoneworkbut" id="updateoneworkbut" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update my Work Modal -->