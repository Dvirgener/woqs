<?php

// * This is just an Alert Function (TOAST)
include "../includes/generic/toastalerts.php";
$alert = new toastalerts();




if (isset($_GET['user'])) {
    if ($_GET['user'] == "usernotexist") {
        $alert->errormessage("Sign In Message", "Username Does not Exist!", "red");
    }
    if ($_GET['user'] == "passinvalid") {
        $alert->errormessage("Sign In Message", "Invalid Password!", "red");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include "../includes/generic/headtags.php";
?>

<body class=" font">
    <div class="container font p-0">
        <?php
        include "../includes/generic/header.php";
        ?>
    </div>
    <div class="container font mt-3"><!-- Container -->
        <div class="row text-center border-bottom border-3 mb-3">
            <span class="fs-2">SIGN IN</span>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="row p-3 mt-5 " style="width:900px; border-radius: 10px; box-shadow: 0px 0px 5px 1px gray;">
                <!-- this col is for the Unit logo -->
                <div class="col-xs-12 col-md-5 ">
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col d-flex justify-content-center">
                            <img src="../pictures/generic/towem_logo.png" style="height:300px; width:250px" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mt-2">
                            <h5 class="text-center fw-bold">TACTICAL OPERATIONS WING</h5>
                            <h5 class="text-center fw-bold">EASTERN MINDANAO</h5>
                            <h6 class="text-center">Work Queue System</h6>
                        </div>
                    </div>
                </div>
                <!-- this col is for the Unit logo -->
                <!-- this col is for the sign up form -->
                <div class="col-xs-12 col-md-7 border-start d-flex align-items-center">
                    <form action="../includes/forms/signinprocess-include.php" method="POST" id="signinform" name="signinform">
                        <!-- row for Username and Password -->
                        <div class="row mt-4 g-2 form-floating">
                            <div class="col-xs-12 col-md-12 form-floating mb-4">
                                <input class="form-control" type="text" id="user_username" name="user_username" placeholder="Username" required>
                                <label class="" for="user_username">Username</label>
                            </div>
                            <div class="col-xs-12 col-md-12 form-floating">
                                <input class="form-control" type="password" id="user_password" name="user_password" placeholder="Password" required>
                                <label class="" for="user_password">Password</label>
                            </div>
                        </div>
                        <!-- row for Username and Password -->
                        <div class="row mb-2 mt-2 g-2">
                            <div class="col-xs-12 col-md-12 mb-2">
                                <div class="col mx-auto my-auto mt-4 pt-1">
                                    <button class="btn btn-primary buttonzoom" style="width:100%" name="signinbut" id="signinbut">Sign in</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- this col is for the sign up form -->
            </div>
            <!-- this row is for the box of sign up form  -->
        </div>

    </div>


</body>

<?php
include "../includes/generic/footer.php";
?>

</html>