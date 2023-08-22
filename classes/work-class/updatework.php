<?php
include "../connection-class/dbconnect-class.php";  //* Include Connection to db class

$connection = new connectiontodb;


// function for update one work modal
if (isset($_POST['updatebyid'])) {
    $updatebyid = $_POST['updatebyid'];
    $workidtoupdate = $_POST['workidtoupdate'];
    $updateworkremarks = $_POST['updateworkremarks'];
    $datetoday = date('Y-m-d');
    $uploaddirectory = "../../pictures/updateuploads/";


    if (empty($_FILES['updatefiles']['tmp_name'][0])) {

        $datetoday = date('Y-m-d');
        $sqlinsert = "INSERT INTO `work_updates`(`update_workid`,`update_by`,`update_remarks`,`update_date`,`update_status`) VALUES ('$workidtoupdate','$updatebyid','$updateworkremarks','$datetoday','Update')";

        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);

        $sql2 = "UPDATE work_queue SET work_dateupdated = '$datetoday', work_updateremarks = '$updateworkremarks' WHERE work_id = '$workidtoupdate'";
        $signupuser_query = mysqli_query($connection->connect(), $sql2);
    } else {

        if (isset($_FILES['updatefiles'])) {
            $names = $_FILES['updatefiles']['name'];
            $tmp_name = $_FILES['updatefiles']['tmp_name'];
            $files_array = array_combine($tmp_name, $names);
            $filenamearray = array();
            foreach ($files_array as $tmp_folder => $file_name) {
                $filename2 = rand(100, 100000) . "-" . $file_name;
                move_uploaded_file($tmp_folder, $uploaddirectory . $filename2);
                array_push($filenamearray, $filename2);
            }
            $filetosave = serialize($filenamearray);
        }

        $datetoday = date('Y-m-d');
        $sqlinsert = "INSERT INTO `work_updates`(`update_workid`,`update_by`,`update_remarks`,`update_date`,`update_file`,`update_status`) VALUES ('$workidtoupdate','$updatebyid','$updateworkremarks','$datetoday','$filetosave','Update')";

        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);

        $sql2 = "UPDATE work_queue SET work_dateupdated = '$datetoday', work_updateremarks = '$updateworkremarks' WHERE work_id = '$workidtoupdate'";
        $signupuser_query = mysqli_query($connection->connect(), $sql2);
    }
}
// function for update one work modal