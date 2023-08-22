// function on view work button (owner)
$(document).on('click', '.viewworkdetail', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();

    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=viewmywork&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#viewmyworkdetail").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

// function on view work button (owner)
$(document).on('click', '.viewaddedworkdetail', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();

    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=viewaddedwork&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#viewmyworkdetail").html(response);
        }
        // response code
    })
    // ajax code
});
// function on view work button (owner).

// function on view work button (owner)
$(document).on('click', '.viewworkhistory', function () {
    var work_id = $(this).val();
    var logged_id = $("#logged_id").val();

    //ajax code    
    $.ajax({
        type: "GET",
        url: "../classes/work-class/view-workfromworklist-class.php?platform=viewworkhistory&workid=" + work_id + "&loggedid=" + logged_id,
        // response code
        success: function (response) {
                $("#viewmyworkdetail").html(response);
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

$(document).on('click', '.viewcompliancefilereference', function () {
    var filename = $(this).val();
    var filepath = "../pictures/complyuploads/";
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


$(document).on('click', '#complyworks', function () {
    var workid = $(this).val();

    $('#workidtocomply').val(workid);
    $('#complyworkmodal').modal('show');
    $("body").removeAttr("style");
})

$(document).on('click', '#updateworks', function () {
    var workid = $(this).val();
    $('#workidtoupdate').val(workid);
    $('#updateworkmodal').modal('show');
    $("body").removeAttr("style");
})


$(document).on('submit', '#updateonework', function (f) {

    f.preventDefault();
    var data = new FormData(this);
    $('#updateworkmodal').modal('hide');
    //ajax code    
    $.ajax({
        type: "POST",
        url: "../classes/work-class/updatework.php",
        data: data,
        processData: false,
        contentType: false,
        // response code
        success: function () {

            document.getElementById("updateonework").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            lodicakes("Work Updated!");

        }
        // response code
    })
    // ajax code
})

$(document).on('submit', '#complyonework', function (f) {

    f.preventDefault();
    var data = new FormData(this);
    $('#complyworkmodal').modal('hide');
    //ajax code    
    $.ajax({
        type: "POST",
        url: "../classes/work-class/complywork.php",
        data: data,
        processData: false,
        contentType: false,
        // response code
        success: function () {
            document.getElementById("complyonework").reset();
            $("#profilediv").load(location.href + " #profilediv>*", ""); 
            lodicakes("Work Complied!");
        }
        // response code
    })
    // ajax code
})


$(document).on('click', '.clicked', function () {
    var workpanel = $(this).val();
    var logged_id = $('#logged_id').val();
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../main/selectpanel.php?panel=" + workpanel+"&logged_id="+logged_id,
        // response code
        success: function (response) {
            $("#workpaneldiv").html(response);

        }
        // response code
    })
    // ajax code

})




$(document).on('click', '.editbutton', function () {
    let worksid = $(this).val();

        $.ajax({
        type: "GET",
        url: "../includes/forms/editworkmodaldetails.php?workidtoedit="+worksid+"&editfrom=directededitwork",
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