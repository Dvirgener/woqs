<!-- Comply my Work Modal -->
<div class="modal fade" id="complyworkmodal" tabindex="-1" aria-labelledby="viewexampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="viewexampleModalLabel">Compliance Remarks:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="complyonework" id="complyonework" action="" method="POST">
                <div class="modal-body">
                    <textarea class="form-control g-1" name="complyworkremarks" id="complyworkremarks" cols="10" rows="5"></textarea>
                    <input type="hidden" id="complybyid" name="complybyid" value="<?= $logged_id ?>">
                    <input type="hidden" id="workidtocomply" name="workidtocomply" value="">

                    <label class="form-label mt-2">Upload Files:</label>
                    <input class="form-control text-center" type="file" name="complyfiles[]" accept=".jpg,.jpeg,.png" id="updatefile" value="" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="complyoneworkbut" id="complyoneworkbut" class="btn btn-primary">Comply</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Comply my Work Modal -->