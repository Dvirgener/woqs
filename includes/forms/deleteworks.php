<?php

include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
$connection = new connectiontodb;

// function for Delete one work modal
if (isset($_POST['workidtodelete_insidemodal'])) {
    $workidtodelete = $_POST['workidtodelete_insidemodal'];
    $sql = "DELETE FROM work_queue WHERE work_id = '$workidtodelete' ";
    $signupuser_query = mysqli_query($connection->connect(), $sql);
    $sql2 = "DELETE FROM work_updates WHERE update_workid = '$workidtodelete' ";
    $signupuser_query = mysqli_query($connection->connect(), $sql2);
}
// function for Delete one work modal

// echo header("location: ../../main/myaddedworkqueue.php");
