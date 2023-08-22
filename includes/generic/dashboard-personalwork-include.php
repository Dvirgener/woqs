<?php
include "../../classes/connection-class/dbconnect-class.php";
include "../../classes/users-class/selectoneuser-class.php";
include "../../classes/users-class/selectalluser-class.php";
include "../../classes/work-class/allworkids.php";
include "../../classes/work-class/oneworkdetail-class.php";


$user_id = $_GET['userid'];

personalworkload($user_id);


function personalworkload($logged_user_id)
{
    $workuser = new fetchuser($logged_user_id);
?>
    <div class="row text-center ">
        <span>Work Queue of <?= $workuser->user_actualrank . " " . $workuser->user_firstname . " " . $workuser->user_lastname . " PAF" ?></span>
    </div>
    <?php
    $global_allworkids = new fetchallworkqueue;
    $user = new fetchoneworkqueue;
    $workqueuearray = $global_allworkids->fetchallworkqueue();

    if ($workqueuearray == "no Work Queue!") {
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

                    <div class="row m-1 border bg-body-tertiary rounded d-flex justify-content-between boxborders mt-2">
                        <div class="col-12 text-center text-md-start col-md-8 my-2 ">
                            <span class="fs-6"> <?= $user->work_subject ?></span>
                        </div>
                        <div class="col-12 text-center text-md-start col-md-2 px-0 d-flex justify-content-center align-items-center m-1">
                            <button class="dashboardviewworkbut btn btn-outline-primary position-relative" value="<?= $user->work_id ?>" type="button">
                                <!-- This span are for Warnings -->
                                <span class="position-absolute top-0 start-100 translate-middle  bg-danger border border-light  badge rounded-pills" style="display:<?= $deadline ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg><span class="visually-hidden"></span>
                                </span>
                                <span class="position-absolute top-0 start-0 translate-middle  bg-secondary border border-light badge rounded-pills text-bg-primary" style="background-color: brown; display: <?= $needupdate ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-question-diamond-fill" viewBox="0 0 16 16">
                                        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM5.495 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25h-.825zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927z" />
                                    </svg><span class="visually-hidden">New alerts</span>
                                </span>
                                <!-- This span are for Warnings -->
                                View
                            </button>
                            <input type="hidden" id="logged_id" name="logged_id" value="<?= $logged_user_id ?>">
                        </div>
                    </div>
<?php
                }
            }
            // * end of if work is uncomplied
        }
        // * end of foreach statement
    }
    // * end of else statement
}
