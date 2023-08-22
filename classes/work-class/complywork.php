<?php

include "../connection-class/dbconnect-class.php";  //* Include Connection to db class
include "oneworkdetail-class.php";  //* Include Connection to db class

$connection = new connectiontodb;

// function for comply one work modal
if (isset($_POST['workidtocomply'])) {
    $workidtocomply = $_POST['workidtocomply'];
    $complybyid = $_POST['complybyid'];
    $complyworkremarks = $_POST['complyworkremarks'];
    $datetoday = date('Y-m-d');
    $datetoday2 = date('Y-m-d');


    $workdetails = new fetchoneworkqueue();
    $workdetails->fetchoneworkqueue($workidtocomply);
    if ($workdetails->work_targetdate != "0000-00-00") {

        $dateadded = $workdetails->work_targetdate;
        $datetoday = date('Y-m-d');
        $dateadded = strtotime($dateadded);
        $datetoday = strtotime($datetoday);
        $interval = $dateadded - $datetoday;
        $daysinterval = floor($interval / (60 * 60 * 24));
        if ($daysinterval >= 2) {
            $timeliness = "Early";
        } else if ($daysinterval >= 0) {
            $timeliness = "On Time";
        } else {
            $timeliness = "Late";
        }
    } else {
        $timeliness = "";
    }




    $uploaddirectory = "../../pictures/complyuploads/";
    if (empty($_FILES['complyfiles']['tmp_name'][0])) {
        $sql2 = "UPDATE work_queue SET work_finalremarks = '$complyworkremarks', work_dateupdated = '$datetoday2', work_compliedby = '$complybyid', work_status = 'Complied', work_timeliness = '$timeliness' WHERE work_id = '$workidtocomply' ";
        $signupuser_query = mysqli_query($connection->connect(), $sql2);

        $sqlinsert = "INSERT INTO `work_updates`(`update_workid`,`update_by`,`update_remarks`,`update_date`,`update_status`) VALUES ('$workidtocomply','$complybyid','$complyworkremarks','$datetoday2','Complied')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    } else {

        if (isset($_FILES['complyfiles'])) {
            $names = $_FILES['complyfiles']['name'];
            $tmp_name = $_FILES['complyfiles']['tmp_name'];
            $files_array = array_combine($tmp_name, $names);
            $filenamearray = array();
            foreach ($files_array as $tmp_folder => $file_name) {
                $filename2 = rand(100, 100000) . "-" . $file_name;
                move_uploaded_file($tmp_folder, $uploaddirectory . $filename2);
                array_push($filenamearray, $filename2);
            }
            $filetosave = serialize($filenamearray);
        }


        $sql2 = "UPDATE work_queue SET work_finalremarks = '$complyworkremarks', work_dateupdated = '$datetoday2', work_compliedby = '$complybyid', work_status = 'Complied',  work_timeliness = '$timeliness', work_compliancefile = '$filetosave' WHERE work_id = '$workidtocomply' ";
        $signupuser_query = mysqli_query($connection->connect(), $sql2);

        $sqlinsert = "INSERT INTO `work_updates`(`update_workid`,`update_by`,`update_remarks`,`update_date`,`update_status`) VALUES ('$workidtocomply','$complybyid','$complyworkremarks','$datetoday2','Complied')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    }
}
// function for comply one work modal
