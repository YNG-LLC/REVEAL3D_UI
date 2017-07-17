// //jQuery


// // #### Runs Dynamic  Fill for  Selection in YNGUpload.php ####
// // var printers = "";
// // var nozzle = "";


// if (dd_AP = '"reveal3D"'){
//     console.log("dd_AP: "+dd_AP);

//     printers = {"reveal3D": [" 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"]};

//     nozzle = {"reveal3D": [" Single", " Duplication"]};
    
// }else if(dd_AP = '"FRANK3"'){
//     console.log("dd_AP: "+dd_AP);

//     printers = {"FRANK3": [" 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"]};

//     nozzle = {"FRANK3": [" Single", " Duplication"]};
    
// }else if(dd_AP = '"GT"'){
//     console.log("dd_AP: "+dd_AP);

//     printers = {"GT": [" 1", " 2", " 3", " 4"]};

//     nozzle = {"GT": [" Single", " Duplication"]};
// };

// console.log('AFTER ALL: '+dd_AP);




// // printers = {
// //     "reveal3D": [" 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
// //     "FRANK3": [" 1", " 2", " 3", " 4", " 5", " 6", " 7", " 8", " 9", " 10", " 11", " 12", " 13", " 14", " 15", " 16"],
// //     "GT": [" 1", " 2", " 3", " 4"]
// // };

// // nozzle = {
// //     "reveal3D": [" Single", " Duplication"],
// //     "FRANK3": [" Single", " Duplication"],
// //     "GT": [" Single", " Duplication"]
// // };


// $.each(printers, function(key, value) {

//     $('#printerSelection').append($('<option />').text(key));
// });


// // Populates Availble options for select based off Selected Printer
// $('#printerSelection').change(function() {
//     var key = $(this).val();
//     $('#zoneSelection').empty();
//     $('#nozzleSelection').empty();
//     for (var i in printers[key]) {
//         $('#zoneSelection').append('<option>' + printers[key][i] + '</option>');
//     }
//     for (var i in nozzle[key]) {
//         $('#nozzleSelection').append('<option>' + nozzle[key][i] + '</option>');
//     }
// }).trigger('change');

