<?php

include "../../classes/connection-class/dbconnect-class.php";
include "../../classes/routine-class/routine-details-class.php";

if (isset($_GET['workid'])) {
    $a = new routinework_view();
    $a->details($_GET['workid']);
}




class routinework_view
{
    public function details($routineid)
    {

        $r = new fetchoneroutine($routineid);
        $month_name = date("F", mktime(0, 0, 0, $r->routine_month, 10));



?>
        <div class="row-fluid">
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Subject:
                </div>
                <div class="col-8">
                    <?= $r->routine_subject ?>
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Date added:
                </div>
                <div class="col-8">
                    <?= $r->routine_dateadded ?>
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Frequency:
                </div>
                <div class="col-8">
                    <?= $r->routine_frequency ?>
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Start Target date:
                </div>
                <div class="col-8">
                    <?= $month_name . " " . $r->routine_date ?>
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Trigger day:
                </div>
                <div class="col-8">
                    <?= $r->routine_nrofdaysbefore ?> days before target date
                </div>
            </div>
            <div class="row d-flex justify-content-around mb-3">
                <div class="col-4 fw-bold">
                    Days to Comply:
                </div>
                <div class="col-8">
                    <?= $r->routine_nrofdaystocomply ?> Days
                </div>
            </div>
            <div class="row mb-2">
                <span class="fw-bold">Remarks:</span>
            </div>
            <div class="row ps-2 mb-3">
                <textarea class="form-control " name="" id="" style="height:150px" readonly></textarea>
            </div>
            <div class="row">
                <div class="col-6 mb-2 px-3">
                    <div class="row">
                        <button class="btn btn-primary buttonzoom editbutton" id="editworks" type="button" value="">Edit</button>
                    </div>
                </div>
                <div class="col-6 mb-2 px-3">
                    <div class="row">
                        <button class="btn btn-primary buttonzoom deleteworkbutton" id="deleteworkbutton" type="button" value="">Delete</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $filereferencearray = array();
                $this->file_listing($filereferencearray);
                ?>
            </div>

        <?php
    }

    public function file_listing($filereferencearray)
    {
        $filebuttonclass = "viewfilereference";

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
}
