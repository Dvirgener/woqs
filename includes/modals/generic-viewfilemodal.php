<?php
if (isset($_GET['filepath'])) {
    $filepath = $_GET['filepath'];
    $filename = $_GET['filename'];
    viewfilemodal($filepath, $filename);
}


function viewfilemodal($filepath, $filename)
{
?>
    <div class="modal fade" id="viewfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewfileuploaded_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewfileuploaded_label">File:</h1>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div class="row-fluid">
                        <img class="border img-fluid" src="<?= $filepath . $filename ?> " alt="" style=" border-radius:10px">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary backbutton" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>

<?php

}













?>