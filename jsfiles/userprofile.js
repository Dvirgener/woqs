
// * ======================================================================= ADD WORK FUNCTION
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

// * Submit Add Work Button
// Function on Submit Add Work Form
// $(document).on('submit', '#addworkform', function (f) {
//     f.preventDefault();
//     $('#addworkmodal').modal('hide');
//     var users = [];
//     var numofusers = $("#numberofusers").val();
//     for (i = 1; i < numofusers; i++) {
//         if ($('#allusers' + i).prop('checked')) {
//             users.push($("#allusers" + i).val());
//         }
//     }
//     var addworksubject = $("#addworksubject").val();
//     var addworktype = $("#addworktype").val();
//     var addworktargetdate = $("#addworktargetdate").val();
//     var addworkintremarks = $("#addworkintremarks").val();
//     var addedby = $("#addedby").val();
//     $(users).serializeArray()
//     var addwork = true;
//     //ajax code    
//     $.ajax({
//         type: "POST",
//         url: "../includes/forms/addworkqueue.php",
//         data: {
//             addwork: addwork,
//             users: users,
//             addworksubject: addworksubject,
//             addworktype: addworktype,
//             addworktargetdate: addworktargetdate,
//             addworkintremarks: addworkintremarks,
//             addedby: addedby
//         },
//         // response code
//         success: function () {
//             $("#profilerow").load(location.href + " #profilerow>*", "");   
//             $("#dashboardcol").load(location.href + " #dashboardcol>*", "");   
//             $("#myworkqueuediv").load(location.href + " #myworkqueuediv>*", "");    
//             $("#myaddedworkqueuediv").load(location.href + " #myaddedworkqueuediv>*", ""); 
//             document.getElementById("addworkform").reset();
                
//             lodicakes("work Added!");
//         }
//         // response code
//     })
//     // ajax code
// })
// Function on Submit Add Work For

// * ======================================================================= EDIT STATUS FUNCTION

// * Open edit Status Modal
$(document).on('click', '#editstatus', function () {
    $('#updatestatusmodal').modal('show');
});


// * Save edit Status Modal
$(document).on('submit', '#updatestatusform', function (e) {
    e.preventDefault();
    var form = new FormData(this)
    form.append("updatestatus", true);
    $('#updatestatusmodal').modal('hide');
    // $('.modal-backdrop').remove();
    //ajax code    
    $.ajax({
        type: "POST",
        url: "../includes/forms/updatestatus.php",
        data: form,
        processData: false,
        contentType: false,
        // response code
        success: function () {
            $('#currentstatus').load(location.href + " #currentstatus");
            $("#addworkcol").load(location.href + " #addworkcol>*", "");
            $("#dashboardcol").load(location.href + " #dashboardcol>*", "");  
            document.getElementById("updatestatusform").reset();

            lodicakes("Status Updated!");
        }
        // response code
    })
    //ajax code
});