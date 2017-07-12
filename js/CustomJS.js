//jQuery


// #### Runs Dynamic  Fill for  Selection in YNGUpload.php ####
var printers = {
    // "-Select-": ["Please select a Printer!"],
    "reveal3D": ["-Select-", " 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
    "FRANK3": ["-Select-", " 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
    "GT": ["-Select-", " 1", " 2", " 3", " 4"]
};

var nozzle = {
    // "-Select-": ["Please select a Nozzle Mode"],
    "reveal3D": ["-Select-", " Single", " Duplication"],
    "FRANK3": ["-Select-", " Single", " Duplication"],
    "GT": ["-Select-", " Single", " Duplication"]
};


$.each(printers, function(key, value) {

    $('#printerSelection').append($('<option />').text(key));
});


// Populates Availble options for select based off Selected Printer
$('#printerSelection').change(function() {
    var key = $(this).val();
    $('#zoneSelection').empty();
    $('#nozzleSelection').empty();
    for (var i in printers[key]) {
        $('#zoneSelection').append('<option>' + printers[key][i] + '</option>');
    }
    for (var i in nozzle[key]) {
        $('#nozzleSelection').append('<option>' + nozzle[key][i] + '</option>');
    }
}).trigger('change');




// //### Nozzle Mode Select ###//
// var nozzle = {
//     "-Select-": ["Please select a Nozzle Mode"],
//     "Single": ["-Select-", " 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
//     "Duplication": ["-Select-", " 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
//     // "GT Single": ["-Select-", " 1", " 2", " 3", " 4"],
//     // "GT Duplication": ["-Select-", " 1", " 2", " 3", " 4"]
// };


// $.each(nozzle, function(key, value) {
//     $('#nozzleSelection').append($('<option />').text(key));
// });


// $('#activeNozzle').change(function() {
//     var keyN = $(this).val();
//     $('#zoneSelection').empty();
//     for (var n in nozzle[keyN]) {
//         $('#zoneSelection').append('<option>' + nozzle[keyN][n] + '</option>');
//     }
// }).trigger('change');
//////////////////////////////////////////////////////////////////////////////////


// Ajax for YNGUpload.php



// Single Temp Submit Check
// var sinCheck = 0;
//
//     $(document).ready(function() {
//         $("#dvSubmitSingle").click(function() {
//             var dvBedFirst = $("#dvBedFirst").val();
//             var dvExtruderFirst = $("#dvExtruderFirst").val();
//             var dvBedSec = $("#dvBedSec").val();
//             var dvExtruderSec = $("#dvExtruderSec").val();
//             var dvName = $("#dvName").val();
//
//             if (dvBedFirst == '' || dvExtruderFirst == '' || dvBedSec == '' || dvExtruderSec == '' || dvName == '' ) {
//             alert("Some Fields were left Blank! Fill them!");
//             sinCheck == 1;
//
//             } else {
//
// // Returns successful data submission message when the entered information is stored in database.
//             $.post("upload.php", {
//                 name1: dvName,
//                 extF1: dvExtruderFirst,
//                 extS1: dvExtruderSec,
//                 bedF1: dvBedFirst,
//                 bedS1: dvBedSec
//             }, function(data) {
//             alert(data);
//             $('#form')[0].reset();  // Resets Form
//                 });
//             }
//         });
//     });


//
// // Duplicate Temp Submit
//     $(document).ready(function() {
//         $("#dvSubmitDuplication").click(function() {
//             var name = $("#name").val();
//             var email = $("#email").val();
//             var contact = $("#contact").val();
//             var gender = $("input[type=radio]:checked").val();
//             var msg = $("#msg").val();
//
//             if (name == '' || email == '' || contact == '' || gender == '' || msg == '') {
//             alert("Insertion Failed Some Fields are Blank....!!");
//
//             } else {
//
// // Returns successful data submission message when the entered information is stored in database.
//             $.post("upload.php", {
//              name1: dvName,
//              extF1: dvExtruderFirst,
//              extS1: dvExtruderSec,
//              bedF1: dvBedFirst,
//              bedS1: dvBedSec
//             }, function(data) {
//             alert(data);
//             $('#form')[0].reset(); // Resets Form
//                 });
//             }
//         });
//     });




    // function dubCheckSingle() {
    //     $(document).ready(function() {
    //         $("#dvSubmitSingle").click(function() {
    //             var dvBedFirst = $("#dvBedFirst").val();
    //             var dvExtruderFirst = $("#dvExtruderFirst").val();
    //             var dvBedSec = $("#dvBedSec").val();
    //             var dvExtruderSec = $("#dvExtruderSec").val();
    //             var dvName = $("#dvName").val();
    //
    //             if (dvBedFirst == '' || dvExtruderFirst == '' || dvBedSec == '' || dvExtruderSec == '' || dvName == '' ) {
    //             alert("Some Fields were left Blank! Fill them!");
    //             sinCheck == 1;
    //
    //             } else {
    //
    // // Returns successful data submission message when the entered information is stored in database.
    //             $.post("upload.php", {
    //                 name1: dvName,
    //                 extF1: dvExtruderFirst,
    //                 extS1: dvExtruderSec,
    //                 bedF1: dvBedFirst,
    //                 bedS1: dvBedSec
    //             }, function(data) {
    //             alert(data);
    //             $('#form')[0].reset();  // Resets Form
    //                 });
    //             }
    //         });
    //     });
