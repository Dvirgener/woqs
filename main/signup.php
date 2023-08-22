<?php




// * This is just an Alert Function (TOAST)
include "../includes/generic/toastalerts.php";
$alert = new toastalerts();

// * if Sign up Succeeded FIRE this message
if (isset($_GET['success'])) {
    $alert->errormessage("Sign Up Message", "Sign Up Succeeded", "green");
}


// * if Sign up failed FIRE this message
if (isset($_GET['user'])) {
    if ($_GET['user'] == "usertaken") {
        $rank = $_GET['rank'];
        $serialnumber = $_GET['serialnumber'];
        $type = $_GET['type'];
        $gender = $_GET['gender'];
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $alert->errormessage("Sign Up Message", "Username Already Taken", "red");
    }
    if ($_GET['user'] == "passnotmatch") {
        $rank = $_GET['rank'];
        $serialnumber = $_GET['serialnumber'];
        $type = $_GET['type'];
        $gender = $_GET['gender'];
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $alert->errormessage("Sign Up Message", "Password Didn't Match", "red");
    }
    switch ($rank) {
        case 1:
            $user_actualrank = "E-1";
            break;
        case 2:
            $user_actualrank = "E-2";
            break;
        case 3:
            $user_actualrank = "E-3";
            break;
        case 4:
            $user_actualrank = "E-4";
            break;
        case 5:
            $user_actualrank = "E-5";
            break;
        case 6:
            $user_actualrank = "E-6";
            break;
        case 7:
            $user_actualrank = "E-7";
            break;
        case 8:
            $user_actualrank = "O-1";
            break;
        case 9:
            $user_actualrank = "O-2";
            break;
        case 10:
            $user_actualrank = "O-3";
            break;
        case 11:
            $user_actualrank = "O-4";
            break;
        case 12:
            $user_actualrank = "O-5";
            break;
        case 13:
            $user_actualrank = "O-6";
            break;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>

<body class="bodybg font">
    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        ?>
    </div>
    <!-- Container div -->
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">SIGN UP</span>
        </div>
        <div class="row d-flex justify-content-center">
            <!-- this row is for the box of sign up form  -->
            <div class="row p-3 mt-5" style="width:900px; border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <!-- this col is for the Unit logo -->
                <div class="col-xs-12 col-md-5 ">
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col d-flex justify-content-center">
                            <img src="../pictures/generic/towem_logo.png" style=" height:300px; width:250px" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mt-2 ">
                            <h5 class="text-center fw-bold">TACTICAL OPERATIONS WING</h5>
                            <h5 class="text-center fw-bold">EASTERN MINDANAO</h5>
                            <h6 class="text-center ">Directorate for Logistics</h6>
                            <h6 class="text-center ">Work Queue System</h6>
                        </div>
                    </div>
                </div>
                <!-- this col is for the Unit logo -->
                <!-- this col is for the sign up form -->
                <div class="col-xs-12 col-md-7 border-start">
                    <form action="../includes/forms/signupprocess-include.php" method="POST" id="signupform" name="signupform">
                        <!-- row for rank and usertype select -->
                        <div class="row mt-4 g-2">
                            <div class="col-xs-12 col-md-6 form-floating">
                                <select class="form-select" aria-label="Default select example" name="user_rank" id="user_rank">
                                    <?php
                                    if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                    ?>
                                        <option selected value="<?= $rank ?>"><?= $user_actualrank ?></option>
                                    <?php
                                    }
                                    ?>
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
                                <label class="" for="user_rank">Rank</label>
                            </div>
                            <div class="col-xs-12 col-md-6 form-floating">
                                <?php
                                if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                ?>
                                    <input class="form-control" type="number" id="user_serialnumber" name="user_serialnumber" placeholder="910325" value="<?= $serialnumber ?>" required>
                                <?php
                                } else {
                                ?>
                                    <input class="form-control" type="number" id="user_serialnumber" name="user_serialnumber" placeholder="910325" required>
                                <?php
                                }
                                ?>
                                <label class="" for="user_serialnumber">Serial Number</label>
                            </div>
                            <div class="col-xs-12 col-md-6 form-floating">
                                <select class="form-select" aria-label="Default select example" name="user_type" id="user_type" required>
                                    <?php
                                    if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                    ?>
                                        <option selected value="<?= $type ?>"><?= $type ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Regular User">Regular User</option>
                                    <option value="NCOIC">NCOIC </option>
                                    <option value="DL">DL</option>
                                    <option value="ASST DL">ASST DL</option>
                                </select>
                                <label class="" for="user_type">User Type</label>
                            </div>
                            <div class="col-xs-12 col-md-6 form-floating">
                                <select class="form-select" aria-label="Default select example" name="user_gender" id="user_gender" required>
                                    <?php
                                    if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                    ?>
                                        <option selected value="<?= $gender ?>"><?= $gender ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female </option>
                                </select>
                                <label class="" for="user_gender">Gender</label>
                            </div>
                        </div>
                        <!-- row for rank and usertype select -->
                        <!-- row for firstname and lastname and username-->
                        <div class="row mt-2 g-2">
                            <div class="col-xs-12 col-md-12 form-floating">
                                <?php
                                if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                ?>
                                    <input class="form-control" type="text" id="user_firstname" name="user_firstname" placeholder="First Name" value="<?= $fname ?>" required>
                                    <label class="" for="user_firstname">First Name</label>
                                <?php
                                } else {
                                ?>
                                    <input class="form-control" type="text" id="user_firstname" name="user_firstname" placeholder="First Name" required>
                                    <label class="" for="user_firstname">First Name</label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-12 col-md-12 form-floating">
                                <?php
                                if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                ?>
                                    <input class="form-control" type="text" id="user_lastname" name="user_lastname" placeholder="Last Name" value="<?= $lname ?>" required>
                                    <label class="" for="user_lastname">Last Name</label>
                                <?php
                                } else {
                                ?>
                                    <input class="form-control" type="text" id="user_lastname" name="user_lastname" placeholder="Last Name" required>
                                    <label class="" for="user_lastname">Last Name</label>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-12 col-md-12 form-floating">
                                <?php
                                if (isset($_GET['user'])) { //*<!-- the function of this script is to get data from users who failed to signup -->
                                ?>
                                    <input class="form-control" type="text" id="user_username" name="user_username" placeholder="User Name" required>
                                    <label class="" for="user_username">Username</label>
                                <?php
                                } else {
                                ?>
                                    <input class="form-control" type="text" id="user_username" name="user_username" placeholder="User Name" required>
                                    <label class="" for="user_username">Username</label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- row for firstname and lastname and username-->
                        <!-- row for Passwords and button -->
                        <div class="row mb-2 mt-2 g-2">
                            <div class="col-xs-12 col-md-6 form-floating">
                                <input class="form-control" type="password" id="user_password" name="user_password" placeholder="Password" required>
                                <label class="" for="user_password">Password</label>
                            </div>
                            <div class="col-xs-12 col-md-6 form-floating">
                                <input class="form-control" type="password" id="user_confpassword" name="user_confpassword" placeholder="Confirm Password" required>
                                <label class="" for="user_confpassword">Password</label>
                            </div>
                            <div class="col-xs-12 col-md-12 mb-2">
                                <div class="col mx-auto my-auto mt-4 pt-1">
                                    <button class="btn btn-outline-primary" style="width:100%" name="signupbut" id="signupbut">Sign Up</button>
                                </div>
                            </div>
                        </div>
                        <!-- row for Passwords and button -->
                    </form>
                </div>
                <!-- this col is for the sign up form -->
            </div>
            <!-- this row is for the box of sign up form  -->
        </div>
    </div>
    <!-- Container div -->



</body>
<?php
include "../includes/generic/footer.php";
?>

</html>