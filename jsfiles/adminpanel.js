    function lodicakes(string) {
    let myAlert = document.querySelector('.toast');
    let bsAlert = new bootstrap.Toast(myAlert);
    $('#toastmessage').text(string);
    bsAlert.show();
    sleep(2000);
    bsAlert.hide();
    
}


$(document).on('click', '#updatestatusbutton', function () {
    $('#updatestatusmodal').modal('show');
    $("body").removeAttr("style");
    })



$(document).on('submit', '#updatestatusform', function (f) {
    f.preventDefault();
    var data = new FormData(this);
    console.log(data);
    $.ajax({
        type: 'POST',
        url: '../includes/forms/updatestatus.php',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#updatestatusmodal').modal('hide');
            document.getElementById("updatestatusform").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            $("#admin-addworkmodal").load(location.href + " #admin-addworkmodal>*", "");  
            lodicakes("Duty Status Updated!");


        }
    })
})


// * Open Add Work Modal
$(document).on('click', '#admin-addworkbutton', function () {
    $('#admin-addworkmodal').modal('show'); 
    $("body").removeAttr("style");
})

// * Close Add Work Modal
$(document).on('click', '#addworkcancel', function () {
    $('#admin-addworkmodal').modal('hide');
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
            $('#admin-addworkmodal').modal('hide');
            document.getElementById("addworkform").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            lodicakes("Work Added!");

        }
    })
})





$(document).on('click', '#addroutinework', function () {
    $('#addroutinemodal').modal('show');
    $("body").removeAttr("style");
})
    

$(document).on('submit', '#addroutineform', function (f) {
    f.preventDefault();
    var data = new FormData(this);
    console.log(data);
    $.ajax({
        type: 'POST',
        url: '../includes/forms/admin-addroutinework.php',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#addroutinemodal').modal('hide');
            document.getElementById("addroutineform").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            lodicakes("Routine Work Added!");

        }
    })
})                                    

// function on view work button (owner)
$(document).on('click', '.viewaddedworkdetail', function () {
    var work_id = $(this).val();

    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=viewaddedwork&workid=" + work_id,
        // response code
        success: function (response) {
                $("#viewadminworkdetail").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

$(document).on('click', '.viewfilereference', function () {
    var filename = $(this).val();
    var filepath = "../pictures/workqueueuploads/";
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/modals/generic-viewfilemodal.php?filepath=" + filepath + "&filename=" + filename,
        // response code
        success: function (response) {
            $("#viewfilemodalrow").html(response);
            $('#viewfile').modal('show');
            $("body").removeAttr("style");
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

$(document).on('click', '.viewfileupdate', function () {
    var filename = $(this).val();
    var filepath = "../pictures/updateuploads/";
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/modals/generic-viewfilemodal.php?filepath=" + filepath + "&filename=" + filename,
        // response code
        success: function (response) {
            $("#viewfilemodalrow").html(response);
            $('#viewfile').modal('show');
            $("body").removeAttr("style");
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).


$(document).on('click', '.editbutton', function () {
    let worksid = $(this).val();

        $.ajax({
        type: "GET",
        url: "../includes/forms/editworkmodaldetails.php?workidtoedit="+worksid+"&editfrom=admineditwork",
        success: function (response) {
            $("#genericmodal").html(response);
            $('#editworkmodal').modal('show');
            $("body").removeAttr("style");
        }
    });
})

// * Close Add Work Modal
$(document).on('click', '#editworkcancel', function (f) {
    f.preventDefault();
    $('#editworkmodal').modal('hide');
});

// * Check all boxes
$(document).on('click', '#checkall', function () {
    $("#editworkform input[type='checkbox'").prop('checked', this.checked);
})

// * Submit Add Work Button
// Function on Submit Add Work Form
$(document).on('submit', '#editworkform', function (f) {
    f.preventDefault();
    
    var data = new FormData(this);
    //ajax code

    $.ajax({
        type: 'POST',
        url: '../includes/forms/editworkqueue.php',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            document.getElementById("editworkform").reset();
            $('#editworkmodal').modal('hide');
            $("#profilediv").load(location.href + " #profilediv>*", "");     
            lodicakes("work Edited!");

        }
    })
})
// Function on Submit Add Work For.



// * Close Add Work Modal
$(document).on('click', '#deleteworkbutton', function () {
    var idtodelete = $(this).val();
    $('#deleteworkmodal').modal('show');
    $("body").removeAttr("style");
    $('#workidtodelete_insidemodal').val(idtodelete)

});

// * Close Add Work Modal
$(document).on('click', '#canceldelete', function (f) {
    f.preventDefault();
    $('#deleteworkmodal').modal('hide');
});

$(document).on('submit', '#deleteworkform', function (f) {
    f.preventDefault();
    
    var data = new FormData(this);
    //ajax code

    $.ajax({
        type: 'POST',
        url: '../includes/forms/deleteworks.php',
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#deleteworkmodal').modal('hide');
            $("#profilediv").load(location.href + " #profilediv>*", "");     
            lodicakes("work Deleted!");

        }
    })
})



// function on view work button (owner)
$(document).on('click', '.viewadminroutinedetail', function () {
    var work_id = $(this).val();

    //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/generic/generic-routineworkview.php?workid="+work_id,
        // response code
        success: function (response) {
                $("#viewadminworkdetail").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).