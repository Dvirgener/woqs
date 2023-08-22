// function on view work button (owner)
$(document).on('click', '.viewworkbut', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();
    $("#usersrower").empty();
    $("#accordionFlushExample").empty();
    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=pc&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#viewworkwindow").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

// function on view work button (owner)
$(document).on('click', '.viewworkbutcp', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();
    $("#usersrower").empty();
    $("#accordionFlushExample").empty();
    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=cp&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#launchcpdetails").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

// function on view work button (owner)
$(document).on('click', '.viewaddedworkbut', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();
    $("#usersrower").empty();
    $("#accordionFlushExample").empty();
    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?viewplatform=pc&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#viewworkwindow").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

// function on view work button (owner)
$(document).on('click', '.viewaddedworkbutcp', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();
    $("#usersrower").empty();
    $("#accordionFlushExample").empty();
    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?viewplatform=cp&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#launchcpdetails").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).


$(document).on('click', '.editbutton', function () {
    let worksid = $(this).val();
    $('#editworkmodal').modal('show');
        $.ajax({
        type: "GET",
        url: "../includes/forms/editworkmodaldetails.php?workidtoedit="+worksid,
        success: function (response) {
            $("#editworkmodaldetails").html(response);
        }
    });
})

// * Close Add Work Modal
$(document).on('click', '#editworkcancel', function () {
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
    $('#editworkmodal').modal('hide');
    var users = [];
    var numofusers = $("#numberofusers").val();
    for (i = 1; i < numofusers; i++) {
        if ($('#allusers' + i).prop('checked')) {
            users.push($("#allusers" + i).val());
        }
    }
    var editworksubject = $("#editworksubject").val();
    var editworktype = $("#editworktype").val();
    var editworktargetdate = $("#editworktargetdate").val();
    var editworkintremarks = $("#editworkintremarks").val();
    var editid = $("#editid").val();
    $(users).serializeArray()
    var editwork = true;
    //ajax code    
    $.ajax({
        type: "POST",
        url: "../includes/forms/editworkqueue.php",
        data: {
            editwork: editwork,
            users: users,
            editworksubject: editworksubject,
            editworktype: editworktype,
            editworktargetdate: editworktargetdate,
            editworkintremarks: editworkintremarks,
            editid: editid
        },
        // response code
        success: function (response) {
            $("#profilerow").load(location.href + " #profilerow>*", "");
            $("#myaddedworkqueuediv").load(location.href + " #myaddedworkqueuediv>*", "");      
            document.getElementById("editworkform").reset();
                
            lodicakes("work Edited!");
        } 
        // response code
    })
    // ajax code
})
// Function on Submit Add Work For


// Delete Work Function
$(document).on('click', '.deleteworks', function () {

    var workidtodelete = $(this).val();
    $.ajax({
        type: "GET",
        url: "../includes/forms/deleteworks.php?workidtodelete="+workidtodelete,
        success: function () {
            $("#profilerow").load(location.href + " #profilerow>*", "");
            $("#myaddedworkqueuediv").load(location.href + " #myaddedworkqueuediv>*", "");
            lodicakes("work Deleted!");
        }
    });
})

$(document).on('click', '.viewworkdetails', function () {

    var workidtoview = $(this).val();
        $('#offcanvasRight').offcanvas('show');

    $.ajax({
        type: "GET",
        url: "../includes/forms/compliedwork.php?workidtoview="+workidtoview,
        success: function (response) {
            $("#viewoneworkhistory").html(response);
        }
    });
})

$(document).on('click', '#viewupdatefile', function () {
    $(".modal-backdrop").remove();
})


// * Check all boxes
$(document).on('click', '.clickmeviewwork', function () {
    let idclicked = $(this).val();
    $.ajax({
        type: "POST",
        url: "../includes/generic/dashboard-personalwork-include.php?userid="+idclicked,

        success: function (response) {
            // $("#dashboardpersonalworkload").load(location.href + " #dashboardpersonalworkload>*", "");
            $("#dashboardviewonework").load(location.href + " #dashboardviewonework>*", "");
            $('#dashboardpersonalworkload').html(response);
            
        }

    })
    
})


// * Check all boxes
$(document).on('click', '.dashboardviewworkbut', function () {
    let workidclicked = $(this).val();
    $.ajax({
        type: "POST",
        url: "../includes/generic/dashboard-viewonework-include.php?userid="+workidclicked,

        success: function (response) {

            $('#dashboardviewonework').html(response);
            
        }

    })
    
})


$