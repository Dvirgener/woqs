<?php
include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
$connection = new connectiontodb();
if (isset($_POST['addworksubject'])) {
    addwork($connection);
}



function addwork($connection)
{
    $uploaddirectory = "../../pictures/workqueueuploads/";

    $users = $_POST['allusers'];
    $users = serialize($users);
    $addworksubject = $_POST['addworksubject'];
    $addworktype = $_POST['addworktype'];
    $addworktargetdate = $_POST['addworktargetdate'];
    $addworkintremarks = $_POST['addworkintremarks'];
    $addedby = $_POST['addedby'];
    $addedfrom = $_POST['addedfrom'];

    if (empty($_FILES['workfiles']['tmp_name'][0])) {

        $sqlinsert = "INSERT INTO `work_queue`(`work_user`,`work_subject`,`work_targetdate`,`work_type`,`work_remarks`, `work_added`,`work_status`,`work_addedfrom`)             
        VALUES ('$users','$addworksubject','$addworktargetdate','$addworktype','$addworkintremarks','$addedby','Uncomplied','$addedfrom')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    } else {

        if (isset($_FILES['workfiles'])) {
            $names = $_FILES['workfiles']['name'];
            $tmp_name = $_FILES['workfiles']['tmp_name'];
            $files_array = array_combine($tmp_name, $names);
            $filenamearray = array();
            foreach ($files_array as $tmp_folder => $file_name) {
                $filename2 = rand(100, 100000) . "-" . $file_name;
                move_uploaded_file($tmp_folder, $uploaddirectory . $filename2);
                array_push($filenamearray, $filename2);
            }
            $filetosave = serialize($filenamearray);
        }

        $sqlinsert = "INSERT INTO `work_queue`(`work_user`,`work_subject`,`work_targetdate`,`work_type`,`work_remarks`, `work_added`,`work_status`,`work_filereference`,`work_addedfrom`)             
    VALUES ('$users','$addworksubject','$addworktargetdate','$addworktype','$addworkintremarks','$addedby','Uncomplied','$filetosave','$addedfrom')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    }
}
