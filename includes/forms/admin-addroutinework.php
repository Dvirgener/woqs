<?php
include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
$connection = new connectiontodb();

if (isset($_POST['routinesubject'])) {
    $routinesubject = $_POST['routinesubject'];
    $routineschedule = $_POST['routineschedule'];
    $routinesection = $_POST['routinesection'];
    $routinemonth = $_POST['routinemonth'];
    $routinedate = $_POST['routinedate'];
    $routineremarks = $_POST['routineremarks'];
    $routine_nrofdaysbefore = $_POST['routine_nrofdaysbefore'];
    echo $routine_nrofdaysbefore;
    $routine_nrofdaystocomply = $_POST['routine_nrofdaystocomply'];

    $uploaddirectory = "../../pictures/routineuploads/";

    if (empty($_FILES['routinefiles']['tmp_name'][0])) {

        $sqlinsert = "INSERT INTO `routine_work_queue`(`routine_subject`,`routine_section`,`routine_frequency`,`routine_month`,`routine_date`,`routine_remarks`,`routine_nrofdaysbefore`,`routine_nrofdaystocomply`)             
        VALUES ('$routinesubject','$routinesection','$routineschedule','$routinemonth','$routinedate','$routineremarks','$routine_nrofdaysbefore','$routine_nrofdaystocomply')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    } else {

        if (isset($_FILES['routinefiles'])) {
            $names = $_FILES['routinefiles']['name'];
            $tmp_name = $_FILES['routinefiles']['tmp_name'];
            $files_array = array_combine($tmp_name, $names);
            $filenamearray = array();
            foreach ($files_array as $tmp_folder => $file_name) {
                $filename2 = rand(100, 100000) . "-" . $file_name;
                move_uploaded_file($tmp_folder, $uploaddirectory . $filename2);
                array_push($filenamearray, $filename2);
            }
            $filetosave = serialize($filenamearray);
        }

        $sqlinsert = "INSERT INTO `routine_work_queue`(`routine_subject`,`routine_section`,`routine_frequency`,`routine_month`,`routine_date`,`routine_remarks`,`routine_file`,`routine_nrofdaysbefore`,`routine_nrofdaystocomply`)             
        VALUES ('$routinesubject','$routinesection','$routineschedule','$routinemonth','$routinedate','$routineremarks','$filetosave','$routine_nrofdaysbefore','$routine_nrofdaystocomply')";
        $signupuser_query = mysqli_query($connection->connect(), $sqlinsert);
    }
}
