<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $logged_id = $_SESSION['user_id'];
} else {
    echo header("location:signin.php");
}

include "../classes/connection-class/dbconnect-class.php";
include "../classes/users-class/selectoneuser-class.php";

// * This is just an Alert Function (TOAST)
include "../includes/generic/toastalerts.php";
$alert = new toastalerts();

if (isset($_GET['pictureupdated'])) {
    $alert->errormessage("Settings Message", "Profile Picture Updated!", "green");
}
if (isset($_GET['positionupdated'])) {
    $alert->errormessage("Settings Message", "Office Position Updated!", "green");
}
if (isset($_GET['profileupdated'])) {
    $alert->errormessage("Settings Message", "User Profile Updated!", "green");
}
if (isset($_GET['profileandpassupdated'])) {
    $alert->errormessage("Settings Message", "User Profile and Password Updated!", "green");
}
if (isset($_GET['passwordnotmatch'])) {
    $alert->errormessage("Settings Message", "Updated password not match!", "red");
}

$loggeduser = new fetchuser($logged_id);

$logged_id = $loggeduser->user_id;
$logged_firstname = $loggeduser->user_firstname;
$logged_lastname = $loggeduser->user_lastname;
$logged_username = $loggeduser->user_username;
$logged_rank = $loggeduser->user_rank;
$logged_gender = $loggeduser->user_gender;
$logged_wordactualrank = $loggeduser->user_actualrank;
$logged_serialnumber = $loggeduser->user_serialnumber;
$logged_type = $loggeduser->user_type;

switch ($logged_rank) {
    case 1:
        $logged_actualrank = "E-1";
        break;
    case 2:
        $logged_actualrank = "E-2";
        break;
    case 3:
        $logged_actualrank = "E-3";
        break;
    case 4:
        $logged_actualrank = "E-4";
        break;
    case 5:
        $logged_actualrank = "E-5";
        break;
    case 6:
        $logged_actualrank = "E-6";
        break;
    case 7:
        $logged_actualrank = "E-7";
        break;
    case 8:
        $logged_actualrank = "O-1";
        break;
    case 9:
        $logged_actualrank = "O-2";
        break;
    case 10:
        $logged_actualrank = "O-3";
        break;
    case 11:
        $logged_actualrank = "O-4";
        break;
    case 12:
        $logged_actualrank = "O-5";
        break;
    case 13:
        $logged_actualrank = "O-6";
        break;
}



?>

<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>

<body class=" font overflow-y-scroll">

    <!-- Modal -->
    <div class="modal fade" id="positionmodal" tabindex="-1" aria-labelledby="positionmodallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="positionmodallabel">Assign Office Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../includes/forms/settings-bridgetodb.php" name="positionform" method="POST">
                        <input type="hidden" name="user_id" id="user_id" value="<?= $logged_id ?>">
                        <div class="col-12">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DPP" value="DPP">
                            <label class="form-check-label" for="DPP">DPP - Financial Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DBFEE" value="DBFEE">
                            <label class="form-check-label" for="DBFEE">DBFEE - Equipment and Vehicle Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DMS" value="DMS">
                            <label class="form-check-label" for="DMS">DMS - POL and ICIE Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DMA" value="DMA">
                            <label class="form-check-label" for="DMA">DMA - Armaments Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DAMM" value="DAMM">
                            <label class="form-check-label" for="DAMM">DAMM - AGE Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="ADMIN" value="ADMIN">
                            <label class="form-check-label" for="ADMIN">ADMIN - Admin Section</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="DL" value="DL">
                            <label class="form-check-label" for="DL">DL - Director for Logistics</label>
                        </div>
                        <div class="col-12 mt-2">
                            <input class="form-check-input" type="checkbox" name="position[]" id="ADL" value="ADL">
                            <label class="form-check-label" for="ADL">ADL - Assistant Director for Logistics</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitposition" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">USER SETTINGS</span>
        </div>
        <div class="  row d-flex justify-content-center ">
            <div class=" col-12 col-md-5 mb-3 pb-3 bg-light rounded" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">

                <form action="../includes/forms/settings-bridgetodb.php" method="POST" class="" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $logged_id ?>">
                    <div class="row mt-3">
                        <div class="col-12 form-floating">
                            <input class="form-control" type="text" name="user_firstname" id="user_firstname" value="<?= $logged_firstname ?>">
                            <label class="ms-2" for="user_firstname">First Name</label>
                        </div>
                        <div class="col-12 form-floating mt-2">
                            <input class="form-control" type="text" name="user_lastname" id="user_lastname" value="<?= $logged_lastname ?>">
                            <label class="ms-2" for="user_lastname">Last Name</label>
                        </div>
                        <div class="col-12 col-md-4 mt-2 form-floating">

                            <select class="form-select" aria-label="Default select example" name="user_gender" id="user_gender" required>
                                <option selected value="<?= $logged_gender ?>"><?= $logged_gender ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female </option>
                            </select>
                            <label class="ms-2" for="user_gender">Gender</label>
                        </div>
                        <div class="col-12 col-md-4 mt-2 form-floating">
                            <select class="form-select" aria-label="Default select example" name="user_rank" id="user_rank">
                                <option selected value="<?= $logged_rank ?>"><?= $logged_actualrank ?></option>
                                <option value=1>E-1</option>
                                <option value=2>E-2 </option>
                                <option value=3>E-3</option>
                                <option value=4>E-4</option>
                                <option value=5>E-5</option>
                                <option value=6>E-6</option>
                                <option value=7>E-7</option>
                                <option value=8>O-1</option>
                                <option value=9>O-2 </option>
                                <option value=10>O-3</option>
                                <option value=11>O-4</option>
                                <option value=12>O-5</option>
                                <option value=13>O-6</option>
                            </select>
                            <label class="ms-2" for="user_rank">Rank</label>
                        </div>
                        <div class="col-12 col-md-4 mt-2 form-floating">
                            <input class="form-control" type="text" name="user_serialnumber" id="user_serialnumber" value="<?= $logged_serialnumber ?>">
                            <label class="ms-2" for="user_serialnumber">Serial Number</label>
                        </div>
                        <div class="col-12 my-3">
                            <label class="form-label " for="user_firstname">Position (Section Assignment)</label>
                            <button type="button" class="btn btn-primary buttonzoom" data-bs-toggle="modal" data-bs-target="#positionmodal">
                                Assign
                            </button>

                        </div>
                        <div class="col-12 col-md-6 mt-2 form-floating">
                            <select class="form-select" aria-label="Default select example" name="user_type" id="user_type">
                                <option selected value="<?= $logged_type ?>"><?= $logged_type ?></option>
                                <option value="Regular User">Regular User</option>
                                <option value="NCOIC">NCOIC </option>
                                <option value="DL">DL</option>
                                <option value="ASST DL">ASST DL</option>
                            </select>
                            <label class="ms-2">User Type:</label>
                        </div>
                        <div class="col-12 col-md-6 mt-2 form-floating">

                            <input class="form-control text-center" type="file" name="thumbnail" id="thumbnail" accept=".jpg,.jpeg,.png" value="">
                            <label class="ms-2">Profile Picture:</label>
                        </div>
                        <div class="col-12 col-md-12 mt-2 d-flex justify-content-end">
                            <button type="submit" name="uploadimg" id="uploadimg" class=" btn btn-primary mt-2 buttonzoom" disabled>Upload</button>
                        </div>
                        <div class="col-12 mt-2 form-floating">
                            <input class="form-control" type="text" name="user_username" id="user_username" value="<?= $logged_username ?>">
                            <label class="ms-2">Username:</label>
                        </div>
                        <div class="col-12 mt-2 form-floating">
                            <input class="form-control" type="password" name="user_password" id="user_password" value="" placeholder="Password">
                            <label class="ms-2" for="user_password">Password:</label>
                        </div>
                        <div class="col-12 mt-2 form-floating">
                            <input class="form-control" type="password" name="user_confpassword" id="user_confpassword" value="" placeholder="Confirm Password">
                            <label class="ms-2" for="user_confpassword">Repeat Password:</label>
                        </div>
                        <div class="col-12 col-md-6 mt-4 mb-4 d-flex justify-content-center">
                            <button class="btn btn-primary buttonzoom" type="submit" name="submitupdate" id="submitupdate" style="width:100%">UPDATE</button>
                        </div>
                        <div class="col-12 col-md-6 mt-4 mb-4 d-flex justify-content-center">
                            <a href="reviseddashboard.php" class="btn btn-primary buttonzoom" name="cancelupdate" id="cancelupdate" style="width:100%">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>


</html>

<script>
    $('input:file').on("change", function() {
        // $('input:submit').prop('disabled', !$(this).val());
        $('#uploadimg').removeAttr('disabled');
        // alert("aw");
    });

    // $(document).on('submit', '#uploadimg', function() {
    //             $('#uploadimg').attr('disabled');
    //         }
</script>