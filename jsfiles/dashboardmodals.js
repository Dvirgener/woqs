        // * THIS IS FO VIEWING OF RECENTLY ADDED WORK
    $(document).on('click', '.dashboard-viewworkadded', function() {
        let workidclicked = $(this).val();
        $('#view_recent_workadded').modal('show');
        $("body").removeAttr("style");
        $.ajax({
        type: 'POST',
        url: '../includes/forms/dashboard-functions.php?viewaddedwork='+workidclicked,
        success: function (response) {
        $("#view_recent_work").html(response);
        }
        })
        
    })

$(document).on('click', '.viewrecentlyaddedworkfile', function () {
    var filename = $(this).val();
        var filepath = "../pictures/workqueueuploads/";
        $('#view_recent_workadded').modal('hide');
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/modals/dashboard-addwork_file_uploaded_modal.php?filepath=" + filepath + "&filename=" + filename+"&backbutton=addedwork",
        // response code
        success: function (response) {
            $("#viewfilemodalrow").html(response);
            $('#viewaddedworkfilemodal').modal('show');
            $("body").removeAttr("style");
        }
        // response code
    })
    // ajax code
});


// function on view work button (owner).
    $(document).on('click', '.addworkbackbutton', function() {
        $('#viewaddedworkfilemodal').modal('hide');
        $('#view_recent_workadded').modal('show');
        $("body").removeAttr("style");
    })


// * =========================================================================================================>>

        // * THIS IS FO VIEWING OF RECENTLY ADDED WORK
    $(document).on('click', '.dashboard_viewupdates', function() {
        let workidclicked = $(this).val();
        $('#view_recent_update').modal('show');
        $("body").removeAttr("style");
        $.ajax({
        type: 'POST',
        url: '../includes/forms/dashboard-functions.php?viewupdatework='+workidclicked,
        success: function (response) {
        $("#recent_updatecompliance").html(response);
        }
        })
        
    })

    $(document).on('click', '.viewrecently_updated', function () {
    var filename = $(this).val();
    var filenamearr = filename.split(","); 
    var filename1 = filenamearr[0];
    var filename2 = filenamearr[1];
        $('#view_recent_update').modal('hide');
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/modals/dashboard-update_file_uploaded_modal.php?filepath=" + filename2 + "&filename=" + filename1+"&backbutton=addedwork",
        // response code
        success: function (response) {
            $("#viewfilemodalrow").html(response);
            $('#viewupdatedworkfilemodal').modal('show');
            $("body").removeAttr("style");
        }
        // response code
    })
    // ajax code
    });

    // function on view work button (owner).
    $(document).on('click', '.updateworkbackbutton', function() {
        $('#viewupdatedworkfilemodal').modal('hide');
        $('#view_recent_update').modal('show');
        $("body").removeAttr("style");
    })


// * =========================================================================================================>>

        // * THIS IS FO VIEWING OF RECENTLY ADDED WORK
    $(document).on('click', '.clicktoviewwork', function() {
        let workidclicked = $(this).val();
        $('#view_personnel_worklist').modal('show');
        $("body").removeAttr("style");
        $.ajax({
        type: 'POST',
        url: '../includes/forms/dashboard-functions.php?viewpersonalworklist='+workidclicked,
        success: function (response) {
        $("#dashboard-personalworklist").html(response);
        }
        })
        
    })

            // * THIS IS FO VIEWING OF RECENTLY ADDED WORK
    $(document).on('click', '.viewworkdetail', function() {
        let workidclicked = $(this).val();
        $('#view_personnel_worklist').modal('hide');
        $("body").removeAttr("style");
        $.ajax({
        type: 'POST',
        url: '../includes/forms/dashboard-functions.php?viewpersonalworklist_details='+workidclicked,
        success: function (response) {
        $('#view_onework').modal('show');
            $("#personalwork_detail_modal").html(response);
                    $("body").removeAttr("style");
        }
        })
        
    })


        // function on view work button (owner).
    $(document).on('click', '.backtoworklist', function() {
        $('#view_onework').modal('hide');
        $('#view_personnel_worklist').modal('show');
        $("body").removeAttr("style");
    })


$(document).on('click', '.dashboard-viewfilereference', function () {
    var filename = $(this).val();
        var filepath = "../pictures/workqueueuploads/";
        $('#view_onework').modal('hide');
        //ajax code    
    $.ajax({
        type: "GET",
        url: "../includes/modals/dashboard-update_file_uploaded_inwork_modal.php?filepath=" + filepath + "&filename=" + filename+"&backbutton=addedwork",
        // response code
        success: function (response) {
            $("#viewfilemodalrow").html(response);
            $('#viewaddedworkfilemodal_inwork').modal('show');
            $("body").removeAttr("style");
        }
        // response code
    })
    // ajax code
});

        // function on view work button (owner).
    $(document).on('click', '.addworkbackbutton_inwork', function() {
        $('#viewaddedworkfilemodal_inwork').modal('hide');
        $('#view_onework').modal('show');
        $("body").removeAttr("style");
    })

















































// // * Check all boxes
//     $(document).on('click', '.viewfile', function() {
//         let workidclicked = $(this).val();
//         $('#view_recent_workadded').modal('hide');
//         $('#viewfileuploaded').modal('show');
//         $("body").removeAttr("style");
//     })







//         // * THIS IS FO VIEWING OF RECENTLY ADDED WORK
//     $(document).on('click', '.dashboard_viewupdates', function() {
//         let workidclicked = $(this).val();
//         $('#view_recent_update').modal('show');
//         $("body").removeAttr("style");

//         $.ajax({
//         type: 'POST',
//         url: '../includes/forms/dashboard-functions.php?viewupdatework='+workidclicked,
//         success: function (response) {
//         $("#recent_updatecompliance").html(response);
//         }
//         })
        
//     })


//     // * Check all boxes
//     $(document).on('click', '.viewfile_update', function() {
//         let workidclicked = $(this).val();
//         $('#view_recent_update').modal('hide');
//         $('#viewfileuploaded_update').modal('show');
//         $("body").removeAttr("style");
//     })

//     $(document).on('click', '.backbutton_update', function() {
//         let workidclicked = $(this).val();
//         $('#viewfileuploaded_update').modal('hide');
//         $('#view_recent_update').modal('show');
//         $("body").removeAttr("style");
//     })

//     // * Check all boxes
//     $(document).on('click', '.viewworkupdate', function() {
//         let workidclicked = $(this).val();
//         $('#view_recent_update').modal('show');
//         $("body").removeAttr("style");
//     })

//     // * Check all boxes
//     $(document).on('click', '.view_personnel_work', function() {
//         let workidclicked = $(this).val();
//         $('#view_personnel_worklist').modal('show');
//         $("body").removeAttr("style");
//     })

//     // * Check all boxes
//     $(document).on('click', '.clickwork', function() {
//         let workidclicked = $(this).val();
//         $('#view_personnel_worklist').modal('hide');
//         $('#view_onework').modal('show');
//         $("body").removeAttr("style");
//     })
//     // * Check all boxes
//     $(document).on('click', '.backtoworklist', function() {
//         let workidclicked = $(this).val();
//         $('#view_onework').modal('hide');
//         $('#view_personnel_worklist').modal('show');

//         $("body").removeAttr("style");
//     })

//     // * Check all boxes
//     $(document).on('click', '.viewfile_update_inwork', function() {
//         let workidclicked = $(this).val();
//         $('#view_onework').modal('hide');
//         $('#viewfileuploaded_update_inwork').modal('show');
//         $("body").removeAttr("style");
//     })

//     $(document).on('click', '.backbutton_update_inwork', function() {
//         let workidclicked = $(this).val();
//         $('#viewfileuploaded_update_inwork').modal('hide');
//         $('#view_onework').modal('show');
//         $("body").removeAttr("style");
//     })



//     // * ===========================> VIEW FILE SECTION

//         // * THIS IS FO VIEWING OF RECENTLY ADDED WORK




//     $(document).on('click', '.addworkbackbutton', function() {
//         $('#view_recent_workadded').modal('show');
//         $("body").removeAttr("style");
//     })




// $(document).on('click', '.viewrecently_updated', function () {
            
//     var filename = $(this).val();
//     var filenamearr = filename.split(","); 
//     var filename1 = filenamearr[0];
//     var filename2 = filenamearr[1];
//     console.log(filename1);
//     console.log(filename2);

    
//     var filepath = "../pictures/updateuploads/";
//         //ajax code    
//     $.ajax({
//         type: "GET",
//         url: "../includes/modals/generic-viewfilemodal.php?filepath=" + filename2 + "&filename=" + filename1,
//         // response code
//         success: function (response) {
//             alert("aw");
//             $('#view_recent_update').modal('hide');
//             $("#viewfilemodalrow").html(response);
//             $('#viewfile').modal('show');
//             $("body").removeAttr("style");
//         }
//         // response code
//     })
//     // ajax code
// });
// // function on view work button (owner).