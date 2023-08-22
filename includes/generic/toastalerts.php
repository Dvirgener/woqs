<?php

class toastalerts
{

    // Alert Function
    public function errormessage($header, $mess, $color)
    {
?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <!-- <img src="..." class="rounded me-2" alt="..."> -->
                    <strong class="me-auto"><?php echo ($header); ?></strong>
                    <small></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" style="color:<?php echo ($color); ?>">
                    <?php echo ($mess) ?>
                </div>
            </div>
        </div>

        <script>
            window.onload = (event) => {
                let myAlert = document.querySelector('.toast');
                let bsAlert = new bootstrap.Toast(myAlert);
                bsAlert.show();
                sleep(2000);
                bsAlert.hide();
            }
        </script>
<?php
    }
    // Alert Function


}
