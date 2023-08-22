<?php
if (!empty($logged_id)) {
    $loginvisible = "display:none";
    $settingvisibility = "display:block";
} else {
    $loginvisible = "display:block";
    $settingvisibility = "display:none";
}
?>



<nav class="navbar navbar-expand-lg bg-light sticky-top p-0">
    <div class="container-fluid bg-light">
        <a class="navbar-brand" href="#">TOWEASTMIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="col">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="reviseddashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="revisedprofile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="workhistory.php">Work History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Section
                        </a>
                        <ul class="dropdown-menu">

                            <?php

                            if (!empty($logged_position)) {
                                if ($logged_position[0] == "DL" || $logged_position[0] == "ADL") {
                            ?>
                                    <li><a class="dropdown-item" href="financial.php">Financial</a></li>
                                    <li><a class="dropdown-item" href="equipment.php">Equipment</a></li>
                                    <li><a class="dropdown-item" href="materiel.php">Materiel</a></li>
                                    <li><a class="dropdown-item" href="armaments.php">armaments</a></li>
                                    <li><a class="dropdown-item" href="age.php">AGE</a></li>
                                    <li><a class="dropdown-item" href="admin.php">Admin</a></li>
                                    <?php
                                } else {
                                    foreach ($logged_position as $position) {
                                        if ($position == "DPP") {
                                    ?>
                                            <li><a class="dropdown-item" href="financial.php">Financial</a></li>
                                        <?php
                                        }
                                        if ($position == "DBFEE") {
                                        ?>
                                            <li><a class="dropdown-item" href="equipment.php">Equipment</a></li>
                                        <?php
                                        }
                                        if ($position == "DMS") {
                                        ?>
                                            <li><a class="dropdown-item" href="materiel.php">Materiel</a></li>
                                        <?php
                                        }
                                        if ($position == "DMA") {
                                        ?>
                                            <li><a class="dropdown-item" href="armaments.php">armaments</a></li>
                                        <?php
                                        }
                                        if ($position == "DAMM") {
                                        ?>
                                            <li><a class="dropdown-item" href="age.php">AGE</a></li>
                                        <?php
                                        }
                                        if ($position == "ADMIN") {
                                        ?>
                                            <li><a class="dropdown-item" href="admin.php">Admin</a></li>
                                <?php
                                        }
                                    }
                                }
                            } else {
                                ?>
                                <li><a class="dropdown-item" href="#">Unset Directory</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>

                </ul>
            </div>
            <div class="col">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end">
                    <li>
                        <a class="nav-link hidebut" aria-current="page" href="signin.php" style="<?= $loginvisible; ?>">Sign in</a>
                    </li>
                    <li>
                        <a class="nav-link inactive hidebut" aria-current="page" href="signup.php" style="<?= $loginvisible; ?>">Sign up</a>
                    </li>
                    <li>
                        <a class="nav-link inactive hidebut" aria-current="page" href="settings.php" style="<?= $settingvisibility; ?>">Settings</a>
                    </li>
                    <li>
                        <a class=" nav-link inactive" aria-current="page" href="signout.php">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>