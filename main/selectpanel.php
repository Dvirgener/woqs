<?php

session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
    // * Fetch one user class
    include "../classes/connection-class/dbconnect-class.php";
    include "../classes/users-class/selectoneuser-class.php";
    include "../classes/work-class/alltotalnrofwork-include.php";
    include "../classes/work-class/allworkids.php";
    include "../classes/work-class/oneworkdetail-class.php";
    include "../classes/work-class/allworkupdates-class.php";
    +include "../classes/users-class/selectalluser-class.php";
    include "../classes/work-class/worknumbers-class.php";
    include "../classes/work-class/view-worklist-class.php";
    include "../includes/generic/generic-workqueuelist.php";



    $loggeduser = new fetchuser($logged_id);
    $logged_position = $loggeduser->user_position;
    $logged_position = unserialize($logged_position);
} else {
    echo header("location:signin.php");
}

if (isset($_GET['panel'])) {

    $logged_id = $_GET['logged_id'];

    switch ($_GET['panel']) {
        case 'myworkqueuebut':
            include "myworkqueue.php";
            break;
        case 'myaddworkbut':
            include "myaddedwork.php";
            break;
        case 'myupcomingactivitiesbut':
            include "upcomingactivities.php";
            break;
        case 'myworkhistorybut':
            include "myworkhistory.php";
            break;
        case 'myactivityhistorybut':
            include "myactivityhistory.php";
            break;
    }
}
