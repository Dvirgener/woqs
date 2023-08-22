function lodicakes(string) {
    let myAlert = document.querySelector('.toast');
    let bsAlert = new bootstrap.Toast(myAlert);
    $('#toastmessage').text(string);
    bsAlert.show();
    sleep(2000);
    bsAlert.hide();
    
}


// * Open Add Work Modal
$(document).on('click', '#addworkbutton', function () {

    $('#addworkmodal').modal('show');
    $("body").removeAttr("style");
})

// * Close Add Work Modal
$(document).on('click', '#addworkcancel', function () {
    $('#addworkmodal').modal('hide');
});

// * Check all boxes
$(document).on('click', '#checkall', function () {
    $("#addworkform input[type='checkbox'").prop('checked', this.checked);
})

// * Check to check atleast one checkbox
$(document).on('click', '.form-check-input', function () {
    var checkboxes = $('.form-check-input');
    checkboxes.change(function () {
        if ($('.form-check-input:checked').length > 0) {
            checkboxes.removeAttr('required');
        } else {
            checkboxes.attr('required', 'required');
        }
    });
});



$(document).on('submit', '#addworkform', function (f) {
    f.preventDefault();
    var data = new FormData(this);
    console.log(data);
    $.ajax({
        type: 'POST',
        url: '../includes/forms/addworkqueue.php',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#addworkmodal').modal('hide');
            document.getElementById("addworkform").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            lodicakes("Work Added!");

        }
    })
})