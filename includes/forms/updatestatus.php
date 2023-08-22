<?php

include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
$connection = new connectiontodb;

// Updating Work Status
if (isset($_POST['status_personnel'])) {
    $userstatus = $_POST['status_update'];
    $userid = $_POST['status_personnel'];
    $userremarks = $_POST['statusremarks'];
    if ($userstatus == "") {
        $res = [
            'status' => 422,
            'message' => "Cannot be Empty"
        ];
        echo json_encode($res);
        return false;
    }
    $squlquery = "UPDATE logistics_users SET user_status = '$userstatus', user_statusremarks = '$userremarks' WHERE user_id = '$userid'";
    $signupuser_query = mysqli_query($connection->connect(), $squlquery);
}
// Updating Work Status