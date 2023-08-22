<?php


if (isset($_GET['filepath'])) {
    $filepath = $_GET['filepath'];
    $filename = $_GET['filename'];
    $fileviewer = new viewupdatefile($filepath, $filename);
    $fileviewer->viewfilemodal($fileviewer->filepath, $fileviewer->filename);
}

class viewupdatefile
{
    public $filepath;
    public $filename;

    function  __construct($filepath, $filename)
    {
        $this->filepath = $filepath;
        $this->filename = $filename;
    }
    public function viewfilemodal($filepath, $filename)
    {

?>
        <div class="modal fade" id="viewupdatedworkfilemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewupdatedworkfilemodal_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  bg-primary text-light">
                        <h1 class="modal-title fs-5" id="viewupdatedworkfilemodal_label">File</h1>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="row-fluid">
                            <img class="border img-fluid" src="<?= $filepath . $filename ?> " alt="" style="height: auto; width: auto; border-radius:10px">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary updateworkbackbutton" data-bs-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>

<?php

    }
}
