<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../../classes/connection-class/dbconnect-class.php";

    include "../../classes/users-class/selectoneuser-class.php";
    include "../../classes/work-class/admin-alltotalnrofwork-include.php";
    include "../../classes/work-class/allworkids.php";
    include "../../classes/work-class/oneworkdetail-class.php";
    include "../../classes/work-class/allworkupdates-class.php";
    +include "../../classes/users-class/selectalluser-class.php";
    include "../../classes/work-class/worknumbers-class.php";
    include "../../classes/work-class/view-worklist-class.php";
    include "../../classes/routine-class/routine-allids-class.php";
    include "../../classes/routine-class/routine-details-class.php";
    include "../generic/generic-workdetails.php";
    include "../generic/generic-editworkmodal.php";
    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}

if (isset($_GET['workidtoedit'])) {
    $work_id = $_GET['workidtoedit'];
    $editfrom = $_GET['editfrom'];
    $worktoedit = new edit_work_details($editfrom, $logged_id, $work_id);
    $worktoedit->editworkmodal($work_id);
}
