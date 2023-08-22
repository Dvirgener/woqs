<?php
include "/xampp/htdocs/dlwoqs/classes/connection-class/dbconnect-class.php";
$connection = new connectiontodb();

// add Work Queue
if (isset($_POST['editworksubject'])) {
    editwork($connection);
}
// add Work Queue
// echo header("..//main/home.php?addwork=success");



function editwork($connection)
{
    $uploaddirectory = "../../pictures/workqueueuploads/";

    $users = $_POST['allusers'];
    $users = serialize($users);
    $editworksubject = $_POST['editworksubject'];
    $editworktype = $_POST['editworktype'];
    $editworktargetdate = $_POST['editworktargetdate'];
    $editworkintremarks = $_POST['editworkintremarks'];
    $editid = $_POST['editid'];

    if (empty($_FILES['workfiles']['tmp_name'][0])) {

        $sql2 = "UPDATE work_queue SET
            work_user = '$users',
            work_subject = '$editworksubject',
            work_targetdate = '$editworktargetdate',
            work_type = '$editworktype',
            work_remarks = '$editworkintremarks' WHERE work_id = '$editid'";

        $signupuser_query = mysqli_query($connection->connect(), $sql2);
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

        $sql2 = "UPDATE work_queue SET
            work_user = '$users',
            work_subject = '$editworksubject',
            work_targetdate = '$editworktargetdate',
            work_type = '$editworktype',
            work_remarks = '$editworkintremarks',
            work_filereference = '$filetosave' WHERE work_id = '$editid'";

        $signupuser_query = mysqli_query($connection->connect(), $sql2);
    }
}
