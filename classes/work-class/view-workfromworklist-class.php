<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../connection-class/dbconnect-class.php";

    include "../users-class/selectoneuser-class.php";
    include "../work-class/admin-alltotalnrofwork-include.php";
    include "../work-class/allworkids.php";
    include "../work-class/oneworkdetail-class.php";
    include "../work-class/allworkupdates-class.php";
    include "../users-class/selectalluser-class.php";
    include "../work-class/worknumbers-class.php";
    include "../work-class/view-worklist-class.php";
    include "../routine-class/routine-allids-class.php";
    include "../routine-class/routine-details-class.php";
    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}
include "../../includes/modals/generic-viewfilemodal.php";
include "../../includes/generic/generic-workdetails.php";


if (isset($_GET['platform'])) {

    if ($_GET['platform'] == "viewmywork") {
        $workviewer = new view_workdetails();
        $workviewer->view_workdetails("myworkqueue", $logged_id, $_GET['workid']);
    }
    if ($_GET['platform'] == "viewaddedwork") {
        $workviewer = new view_workdetails();
        $workviewer->view_workdetails("addedworkqueue", $logged_id, $_GET['workid']);
    }
    if ($_GET['platform'] == "viewworkhistory") {
        $workviewer = new view_workdetails();
        $workviewer->view_workdetails("myworkhistory", $logged_id, $_GET['workid']);
    }
}
