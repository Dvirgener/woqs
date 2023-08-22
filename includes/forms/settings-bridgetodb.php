<?php


include "../../classes/connection-class/dbconnect-class.php"; //* Include Connection process class
$connection = new connectiontodb;



//UPLOAD STL FILES ============================================================================>
if (isset($_POST['uploadimg'])) {

    $logged_id = $_POST['user_id'];
    $idreference = $logged_id;

    $file = rand(100, 100000) . "-" . $_FILES['thumbnail']['name'];
    $file_loc = $_FILES['thumbnail']['tmp_name'];
    $file_size = $_FILES['thumbnail']['size'];
    $file_type = $_FILES['thumbnail']['type'];

    $file = strtolower($file);
    $finalfile = str_replace(' ', '-', $file);
    $folder = "C:/xampp/htdocs/woqs/pictures/profilepic/";

    move_uploaded_file($file_loc, $folder . $finalfile);


    $sql = "UPDATE logistics_users SET user_picture = '$finalfile' WHERE user_id = '$idreference'";
    $uploadimg = mysqli_query($connection->connect(), $sql);
    echo header("location: ../../main/settings.php?pictureupdated=true");
    exit();
}

if (isset($_POST['submitposition'])) {
    $logged_id = $_POST['user_id'];
    $user_position = $_POST['position'];
    $user_position = $_POST['position'];
    $user_position = serialize($user_position);

    $sql2 = "UPDATE logistics_users SET user_position = '$user_position' WHERE user_id = '$logged_id'";
    $uploadthis = mysqli_query($connection->connect(), $sql2);

    echo header("location: ../../main/settings.php?positionupdated=true");
    exit();
}

if (isset($_POST['submitupdate'])) {

    $logged_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_gender = $_POST['user_gender'];
    $user_rank = $_POST['user_rank'];

    switch ($user_rank) {
        case 1:
            if ($user_gender == "Male") {
                $user_actualrank = "AM";
            } else {
                $user_actualrank = "AW";
            }
            break;
        case 2:
            if ($user_gender == "Male") {
                $user_actualrank = "A2C";
            } else {
                $user_actualrank = "AW2C";
            }
            break;
        case 3:
            if ($user_gender == "Male") {
                $user_actualrank = "A1C";
            } else {
                $user_actualrank = "AW1C";
            }
            break;
        case 4:
            $user_actualrank = "SGT";
            break;
        case 5:
            $user_actualrank = "SSG";
            break;
        case 6:
            $user_actualrank = "TSG";
            break;
        case 7:
            $user_actualrank = "MSG";
            break;
        case 8:
            $user_actualrank = "2LT";
            break;
        case 9:
            $user_actualrank = "1LT";
            break;
        case 10:
            $user_actualrank = "CPT";
            break;
        case 11:
            $user_actualrank = "MAJ";
            break;
        case 12:
            $user_actualrank = "LTC";
            break;
        case 13:
            $user_actualrank = "COL";
            break;
    }

    $user_serialnumber = $_POST['user_serialnumber'];
    $user_type = $_POST['user_type'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_confpassword = $_POST['user_confpassword'];
    $awd = strlen($user_password);
    echo $awd;

    if ($awd == 0) {

        $sql2 = "UPDATE logistics_users SET
            user_firstname = '$user_firstname',
            user_lastname = '$user_lastname',
            user_gender = '$user_gender',
            user_rank = '$user_rank',
            user_actualrank = '$user_actualrank',
            user_serialnumber = '$user_serialnumber',
            user_type = '$user_type',
            user_username = '$user_username' WHERE user_id = '$logged_id'";

        $uploadimg = mysqli_query($connection->connect(), $sql2);
        header("location: ../../main/settings.php?profileupdated=true");
        exit();
    }
    if ($user_password == $user_confpassword) {

        // * Hash password
        $hashed = password_hash($user_password, PASSWORD_DEFAULT);

        $sql2 = "UPDATE logistics_users SET
            user_firstname = '$user_firstname',
            user_lastname = '$user_lastname',
            user_gender = '$user_gender',
            user_rank = '$user_rank',
            user_actualrank = '$user_actualrank',
            user_serialnumber = '$user_serialnumber',
            user_type = '$user_type',
            user_username = '$user_username',
            user_password = '$hashed' WHERE user_id = '$logged_id'";
        $uploadimg = mysqli_query($connection->connect(), $sql2);
        header("location: ../../main/settings.php?profileandpassupdated=true");
    } else {
        header("location: ../../main/settings.php?passwordnotmatch=true");
    }
}
