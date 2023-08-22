<!-- //* THIS IS FOR THE ADD WORK Modal -->
<!-- Add Work Modal  -->
<div class="modal fade " id="deleteworkmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog boxborders">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Work Queue</h5>
            </div>
            <form action="" method="POST" id="deleteworkform">
                <div class="modal-body ">
                    <div class="row d-flex justify-content-center align-items-center">
                        <input type="hidden" id="workidtodelete_insidemodal" name="workidtodelete_insidemodal" value="">
                        <div class="col-6 d-flex justify-content-center">
                            <button class="btn btn-primary" type="submit" name="delete" id="delete">Delete</button>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <button class="btn btn-secondary" id="canceldelete">Cancel</button>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Work Modal  -->