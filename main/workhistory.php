<?php

$where = "workhistory";

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../classes/connection-class/dbconnect-class.php";
    include "../classes/users-class/selectoneuser-class.php";
    include "../classes/work-class/allworkids.php";
    include "../classes/work-class/oneworkdetail-class.php";
    include "../classes/work-class/view-worklist-class.php";
    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
include "../includes/generic/headtags.php";
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>


<script src="../jsfiles/viewworkdetails.js"></script>

<body class=" overflow-y-scroll">
    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">OFFICE WORK HISTORY</span>
        </div>
        <div class="row">
            <!-- body / work queues -->
            <div class="row mx-0 mt-3 mb-3" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <div class="col">
                    <div class="row p-3">
                        <div class="row mt-5 d-flex justify-content-center overflow-auto" style="height:500px">
                            <div class="col overflow-auto">
                                <table id="historytable" class="boxborders table  table-striped  align-middle table-hover " style="width: 100%;">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center" style="width:300px">SUBJECT</th>
                                            <th class="text-center">DATE ADDED</th>
                                            <Th class="text-center">DATE COMPLIED</Th>
                                            <Th class="text-center" style="width:300px">REMARKS</Th>
                                            <Th class="text-center">COMPLIED BY</Th>
                                            <Th class="text-center">DETAILS</Th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $allworkqueues = new fetchallworkqueue();
                                        $allworkarray = $allworkqueues->fetchallworkqueue();
                                        $counter = 1;
                                        if ($allworkarray == "no Work Queue!") {
                                            exit();
                                        }
                                        foreach ($allworkarray as $eachworkid) {
                                            $workdetail = new fetchoneworkqueue();
                                            $workdetail->fetchoneworkqueue($eachworkid);
                                            if ($workdetail->work_status == "Complied") {
                                                $usercomplier = new fetchuser($workdetail->work_compliedby);
                                        ?>
                                                <tr class="tablerow">
                                                    <td><?= $workdetail->work_subject ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        echo ($workdetail->work_dateadded);
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?= $workdetail->work_dateupdated ?></td>
                                                    <td><?= $workdetail->work_finalremarks ?></td>
                                                    <td class="text-center"><?= $usercomplier->user_actualrank . " " . $usercomplier->user_lastname ?></td>
                                                    <td class="text-center"><button value="<?= $workdetail->work_id ?>" type="button" class="btn btn-outline-primary viewworkdetails">View</button></td>
                                                </tr>
                                        <?php
                                                $counter += 1;
                                            } else {
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- body / work queues -->
            </div>
        </div>
    </div>
    <div class="container mt-3 font">





</body>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Work Details:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body viewoneworkhistory" id="viewoneworkhistory">

    </div>
</div>

<?php

?>

</html>

<script>
    $(document).ready(function() {
        $('#historytable').DataTable({
            order: [
                [2, 'desc']
            ],
            scrollCollapse: false,
            scrollY: '350px',
        });
    });
</script>