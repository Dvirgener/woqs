<?php

class oneworkdetail
{

    function personalworkload_pc($logged_user_id, $addedworkfrom)
    {
        $global_allworkids = new fetchallworkqueue;
        $user = new fetchoneworkqueue;
        $workqueuearray = $global_allworkids->fetchallworkqueue();
        if ($workqueuearray == "0") {
            return $workqueuearray;
            exit();
        } else {
            foreach ($workqueuearray as $eachworkid) {
                $eachworkid = $user->fetchoneworkqueue($eachworkid);
                if ($user->work_status == "Uncomplied") {
                    $work_counter = 1;
                    $work_user = $user->work_user;
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($logged_user_id, $work_user, true);
                    if ($work_user[$work_userindex] == $logged_user_id) {
                        if ($user->work_addedfrom == "$addedworkfrom") {
                            if ($user->work_targetdate != "0000-00-00") {
                                $dateadded = $user->work_targetdate;
                                $datetoday = date('Y-m-d');
                                $dateadded = strtotime($dateadded);
                                $datetoday = strtotime($datetoday);
                                $interval = $dateadded - $datetoday;
                                $daysinterval = floor($interval / (60 * 60 * 24));
                                if ($daysinterval <= 1) {
                                    $deadline = "block";
                                } else {
                                    $deadline = "none";
                                }
                            } else {
                                $deadline = "none";
                            }
                            $dateadded = $user->work_dateupdated;
                            $datetoday = date('Y-m-d');
                            $dateadded = strtotime($dateadded);
                            $datetoday = strtotime($datetoday);
                            $interval = $datetoday - $dateadded;
                            $daysinterval = floor($interval / (60 * 60 * 24));
                            if ($daysinterval >= 1) {
                                $needupdate = "block";
                            } else {
                                $needupdate = "none";
                            }
?>
                            <button class="btn mb-2 buttonzoom clickwork pe-3 ps-1 border-bottom viewworkdetail " type="button" value=<?= $user->work_id ?> style="height:auto">
                                <input type="hidden" id="logged_id" value="<?= $logged_user_id ?>">
                                <div class="row text-dark text-center d-flex justify-content-around">
                                    <div class="col-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                        </svg>
                                    </div>
                                    <div class="col-10">
                                        <span class="text-center">
                                            <?= $user->work_subject ?>
                                        </span>
                                    </div>



                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 rounded p-0 m-0 me-1" style="background-color: green; height:auto; width:auto; display:<?= $needupdate ?>">
                                        <span class="p-0 text-light mx-1" style="font-size: x-small;"> Update!</span>
                                    </div>
                                    <div class="col-3 rounded p-0 m-0" style="background-color: red; height:auto; width:auto; display:<?= $deadline ?>">
                                        <span class="p-0 text-light mx-1" style="font-size: x-small;">Deadline!</span>
                                    </div>
                                </div>
                            </button>
                        <?php
                        }
                    }
                }
                // * end of if work is uncomplied
            }
            // * end of foreach statement
        }
        // * end of else statement
    }

    function addedworkqueue($logged_user_id, $addedworkfrom)
    {
        $global_allworkids = new fetchallworkqueue;
        $user = new fetchoneworkqueue;
        $workqueuearray = $global_allworkids->fetchallworkqueue();
        if ($workqueuearray == "0") {
            return $workqueuearray;
            exit();
        } else {
            foreach ($workqueuearray as $eachworkid) {
                $eachworkid = $user->fetchoneworkqueue($eachworkid);
                if ($user->work_status == "Uncomplied") {
                    $work_counter = 1;
                    $work_user = $user->work_user;
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($logged_user_id, $work_user, true);
                    if ($user->work_added == $logged_user_id) {
                        if ($user->work_addedfrom == "$addedworkfrom") {
                            if ($user->work_targetdate != "0000-00-00") {
                                $dateadded = $user->work_targetdate;
                                $datetoday = date('Y-m-d');
                                $dateadded = strtotime($dateadded);
                                $datetoday = strtotime($datetoday);
                                $interval = $dateadded - $datetoday;
                                $daysinterval = floor($interval / (60 * 60 * 24));
                                if ($daysinterval <= 1) {
                                    $deadline = "block";
                                } else {
                                    $deadline = "none";
                                }
                            } else {
                                $deadline = "none";
                            }
                            $dateadded = $user->work_dateupdated;
                            $datetoday = date('Y-m-d');
                            $dateadded = strtotime($dateadded);
                            $datetoday = strtotime($datetoday);
                            $interval = $datetoday - $dateadded;
                            $daysinterval = floor($interval / (60 * 60 * 24));
                            if ($daysinterval >= 1) {
                                $needupdate = "block";
                            } else {
                                $needupdate = "none";
                            }
                        ?>
                            <button class="btn mb-2 buttonzoom clickwork px-3 border-bottom viewaddedworkdetail" type="button" value=<?= $user->work_id ?> style="height:auto">
                                <input type="hidden" id="logged_id" value="<?= $logged_user_id ?>">
                                <div class="row text-dark text-center">
                                    <span class="text-center">
                                        <?= $user->work_subject ?>
                                    </span>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-3 rounded p-0 m-0 me-1" style="background-color: green; height:auto; width:auto; display:<?= $needupdate ?>">
                                        <span class="p-0 text-light mx-1" style="font-size: x-small;"> Update!</span>
                                    </div>
                                    <div class="col-3 rounded p-0 m-0" style="background-color: red; height:auto; width:auto; display:<?= $deadline ?>">
                                        <span class="p-0 text-light mx-1" style="font-size: x-small;">Deadline!</span>
                                    </div>
                                </div>
                            </button>
                        <?php
                        }
                    }
                }
                // * end of if work is uncomplied
            }
            // * end of foreach statement
        }
        // * end of else statement
    }
    function myworkhistory($logged_user_id, $addedworkfrom)
    {
        $global_allworkids = new fetchallworkqueue;
        $user = new fetchoneworkqueue;
        $workqueuearray = $global_allworkids->fetchallworkqueue();
        if ($workqueuearray == "0") {
            return $workqueuearray;
            exit();
        } else {
            foreach ($workqueuearray as $eachworkid) {
                $eachworkid = $user->fetchoneworkqueue($eachworkid);
                if ($user->work_status == "Complied") {
                    $work_counter = 1;
                    $work_user = $user->work_user;
                    $work_user = unserialize($work_user);
                    $work_userindex = array_search($logged_user_id, $work_user, true);
                    if ($user->work_compliedby == $logged_user_id) {
                        if ($user->work_addedfrom == "$addedworkfrom") {
                            if ($user->work_targetdate != "0000-00-00") {
                                $dateadded = $user->work_targetdate;
                                $datetoday = date('Y-m-d');
                                $dateadded = strtotime($dateadded);
                                $datetoday = strtotime($datetoday);
                                $interval = $dateadded - $datetoday;
                                $daysinterval = floor($interval / (60 * 60 * 24));
                                if ($daysinterval <= 1) {
                                    $deadline = "block";
                                } else {
                                    $deadline = "none";
                                }
                            } else {
                                $deadline = "none";
                            }
                            $dateadded = $user->work_dateupdated;
                            $datetoday = date('Y-m-d');
                            $dateadded = strtotime($dateadded);
                            $datetoday = strtotime($datetoday);
                            $interval = $datetoday - $dateadded;
                            $daysinterval = floor($interval / (60 * 60 * 24));
                            if ($daysinterval >= 1) {
                                $needupdate = "block";
                            } else {
                                $needupdate = "none";
                            }
                        ?>
                            <button class="btn mb-2 buttonzoom clickwork px-3 border-bottom viewworkhistory" type="button" value=<?= $user->work_id ?> style="height:auto">
                                <input type="hidden" id="logged_id" value="<?= $logged_user_id ?>">
                                <div class="row text-dark text-center">
                                    <span class="text-center">
                                        <?= $user->work_subject ?>
                                    </span>
                                </div>

                            </button>
<?php
                        }
                    }
                }
                // * end of if work is uncomplied
            }
            // * end of foreach statement
        }
        // * end of else statement
    }
}
