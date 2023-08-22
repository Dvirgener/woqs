<!-- Personnel Work Queue Panel -->
<div class="col-12 col-md-12 ps-2 pe-0">
    <div class="row">
        <!-- Office Work Queue, Accomplished, Upcoming and Duty status Panel -->
        <div class="col-12 col-md-6 ps-md-4 mb-2 pe-2">
            <div class="row bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray; ">
                <div class="row text-center fw-bold mb-3">
                    <span>ADDED WORK QUEUE</span>
                </div>
                <div class="row-fluid overflow-y-scroll overflow-x-hidden pe-4 mb-2" style="height:640px; padding-left:30px; padding-right:30px">
                    <?php
                    $worklist = new view_worklist();
                    $worklist->work_window("addedworkqueue", $logged_position, $logged_id);
                    ?>
                </div>
            </div>
        </div>
        <!-- Office Work Queue, Accomplished, Upcoming and Duty status Panel -->

        <!-- Recently Updated and Added Work Panel Panel -->
        <div class="col-12 col-md-6 ps-md-4">
            <div class="row bg-light" style="border-radius: 10px; box-shadow: 0px 0px 5px 1px gray; ">
                <div class="row text-center fw-bold mb-3">
                    <span>WORK DETAILS</span>
                </div>
                <div class="row mb-2 ps-4 pe-0 me-0 paddingremover" id="viewmyworkdetail" style="height:640px;">

                </div>

            </div>
            <!-- Recently Updated and Added Work Panel Panel -->
        </div>
    </div>
</div>