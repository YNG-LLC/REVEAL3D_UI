<?php 

include 'YNG_ACR.php'; 
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<body>
	<div id="wrapper">
	</div>
	<div id="page-wrapper">
		<div class="row">
			<h1 id='banner' style="text-align:center"  class="col-lg-12">
			</h1>
			<!-- /.col-lg-12 -->
		</div>
		<br>
		<!-- </div> -->
		<div class="row">
			<div class="col-lg-5">
				<div class="panel panel-green">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-signal fa-fw"></i> Printer State</h3>
					</div>
					<div class="panel-body">
						<!-- <div id="morris-donut-chart"></div> -->
						<table id='printerState'>
							<tr>
								<th>State<span id="printOptions"></span><sup></sup>:</th>
								<td id="currentState" style="text-align:left;width:75%;"></td>
							</tr>
							<tr>
								<th>Active Printer<span id="printOptions"></span><sup></sup>:</th>
								<td id="currentPrinter" style="text-align:left;width:75%;">&nbsp;&nbsp;&nbsp;
									<?php
									// session_start();
									if (!$dbc) {
										die("Connection failed: " . mysqli_connect_error());
									}
									if (mysqli_num_rows($resultAP) > 0) {
										// output data of each row
										while($row = mysqli_fetch_assoc($resultAP)) {
											echo $row["ActivePrinter"];
											// echo $row;
										}
									} else {
										echo "0 results";
									}
										
									// mysqli_close($dbc);
								?></td>
							</tr>
							<tr>
								<th>Active Nozzle<span id="printOptions"></span><sup></sup>: </th>
								<td id="currentNozzle" style="text-align:left;width:75%;">&nbsp;&nbsp;&nbsp;<?php
										// session_start();
										$db_tablename = "yngUI";
										if (mysqli_num_rows($resultN) > 0) {
											// output data of each row
											while($row = mysqli_fetch_assoc($resultN)) {
												echo $row["NozzleType"];
												// echo $row;
											}
										} else {
											echo "0 results";
										}
										// mysqli_close($dbc);
								?></td>
							</tr>
							<tr>
								<th>Port<span id="printOptions"></span><sup></sup>: </th>
								<td id="currentPort" style="text-align:left;width:75%;"></td>
							</tr>
							<tr>
								<th>Baudrate<span id="printOptions"></span><sup></sup>: </th>
								<td id="currentBR" style="text-align:left;width:75%;">&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<th>Profile<span id="printOptions"></span><sup></sup>: </th>
								<td id="currentProfile" style="text-align:left;width:75%;">&nbsp;&nbsp;</td>
							</tr>
							<!-- <tr>
										<th>Job Selected<span id="jobOptions"></span><sup></sup>: </th>
										<td id="jobStatus" style="text-align:left;width:75%;">&nbsp;&nbsp;</td>
										<br><br><br>
							</tr> -->
							<tr><th>Active Job<span id="jobOptions"></span><sup></sup>: </th>
							<td id="jobActive" style="text-align:left;width:75%;">&nbsp;&nbsp;</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="panel panel-blue">
				
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-red" style="margin-top: -22px">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-fire fa-fw"></i> Temperature Panel</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-striped">
							<h1 style="text-align:center;" class="panel-heading">Extruders</h1>
							<table id='bedTemps' class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th style="text-align:center;">Extruder</th>
										<th style="text-align:center;">Input Temp (&#8451; )</th>
										<th style="text-align:center;">Actual (&#8451; )</th>
										<th style="text-align:center;">Target (&#8451;)</th>
										<th>Controls</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th style="text-align:center;">#1</th>
										<td>
											<input type="number" id="tool0"  min="0">
										</td>
										<td id="tempStatus0A" style="text-align:center;width:60%;"></td>
										<td id="tempStatus0T" style="text-align:center;width:60%;"></td>
										<td id="extUpdate0" style="text-align:center;width:10%;">
											<a  id="extUpdate0Click" class="btn btn-sq-xs btn-warning" onclick="set_tool0_temp()"><i class=" glyphicon glyphicon-fire glyphicon-fw" ></i></a>
										</td>
									</tr>
									<tr id='dualNoz' class='' >
										<th style="text-align:center;">#2</th>
										<td>
											<input type="number" id="tool1"  min="0">
										</td>
										<td id="tempStatus1A" style="text-align:center;width:50%;"></td>
										<td id="tempStatus1T" style="text-align:center;width:50%;"></td>
										<td id="extUpdat1e" style="text-align:center;width:10%;">
											<a  id="extUpdate1Click" class="btn btn-sq-xs btn-warning" onclick="set_tool1_temp()"><i class="glyphicon glyphicon-fire glyphicon-fw" ></i></a>
										</td>
									</tr>
								</tbody>
							</table><br>
							<button  id="filamentReload" class="btn btn-warning" onclick="filamentReload()" style="margin-left: 150px">Reload Filament</button>
							<button  id="filamentReload" class="btn btn-danger" onclick="disableExtruders()" style="margin-left:50px">Disable Active Extruder Motors</button>
							<hr style="color:blue"><br>
							<h1 style="text-align:center;" class="panel-heading">Zone</h1>
							<table id='bedTemps' class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th style="text-align:center;">Zone</th>
										<th style="text-align:center;">Input Temperature (&#8451; )</th>
										<th style="text-align:center;">Zone Temp (&#8451; )</th>
										<th style="text-align:center;">Controls</th>
										<!-- <th>Target Temp (&#8451; )</th> -->
									</tr>
								</thead>
								<tbody>
									<tr>
										<!-- // in file units, changed in to cm () -->
										<th style="text-align:center;width:13%;">
											<?php
											// session_start();
											// include 'YNG_ACR.php';
											$db_tablename = "yngUI";
											$dbc = mysqli_connect($ACR_host, $ACR_user, $ACR_pass, $db_tablename)
												or die('Error communicating to MySQL server');
											/// SELECT for : does value exist?
											$is_reveal3D  = $dbc->query("SELECT ActivePrinter FROM settingsUI WHERE ActivePrinter = 'reveal3D' ");
											$is_FRANK3  = $dbc->query("SELECT ActivePrinter FROM settingsUI WHERE ActivePrinter = 'FRANK3' ");
											$is_GT  = $dbc->query("SELECT ActivePrinter FROM settingsUI WHERE ActivePrinter = 'GT' ");
											// if(isset($is_reveal3D)){
											if($is_reveal3D->num_rows == 1){
												echo "<select name='zoneSelection' id='zoneSelect' class='dropdown-toggle'><option value='0'>1</option><option value='1'>2</option><option value='2'>3</option><option value='3'>4</option><option value='4'>5</option><option value='5'>6</option><option value='6'>7</option><option value='7'>8</option><option value='8'>9</option><option value='9'>10</option><option value='10'>11</option><option value='11'>12</option><option value='12'>13</option><option value='13'>14</option><option value='14'>15</option><option value='15'>16</option></select>";
											}
											// if(isset($is_FRANK3)){
											elseif($is_FRANK3->num_rows == 1){
												echo "<select name='zoneSelection' id='zoneSelect' class='dropdown-toggle'><option value='0'>1</option><option value='1'>2</option><option value='2'>3</option><option value='3'>4</option><option value='4'>5</option><option value='5'>6</option><option value='6'>7</option><option value='7'>8</option><option value='8'>9</option><option value='9'>10</option><option value='10'>11</option><option value='11'>12</option><option value='12'>13</option><option value='13'>14</option><option value='14'>15</option><option value='15'>16</option></select>";
												
											}
											// if(isset($is_GT)){
											elseif($is_GT->num_rows == 1){
												echo "<select name='zoneSelection' id='zoneSelect' class='dropdown-toggle'><option value='0'>1</option><option value='1'>2</option><option value='6'>3</option><option value='7'>4</option></select>";
											}else{
												echo 'No Active Printer has been Set';
											};
											// }
											
											// mysqli_close($dbc);
										?></th>
										<td style="text-align:center;width:30%;">
											<input type="number" name="zoneTempInput" id="zoneTempInput" min="0">
										</td>
										<td id="bedTemp" style="text-align:center;width:45%;">N/A</td>
										<td id="bedUpdate" style="text-align:center;width:10%;">
											<a  id="bedUpdateClick" class="btn btn-sq-xs btn-warning" onclick="set_bed_temp()"><i class=" glyphicon glyphicon-fire glyphicon-fw" ></i></a>
										</td>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- <div class="text-right">
								<a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
					</div> -->
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary" style="width:1000px; margin-left:15px">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Printer Control</h3>
					</div>
					<div class="panel-body">
						<button  id="conPrint" class="btn btn-success" onclick="connectPrint()">Connect to Printer</button>
						<button  id="disconPrint" class="btn btn-danger" onclick="discoPrint()">Disconnect from Printer</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button  id="resumePrint" class="btn btn-primary" onclick="startPrint()">Start Print</button>
						<button  id="pausePrint" class="btn btn-info" onclick="PRprint()">Pause/Resume Print</button>
						<button  id="cancelPrint" class="btn btn-warning" onclick="cancelPrint()">Cancel Print</button>
						<br><br><br>
						<b style="align-items: center;  justify-content: center; margin-left: 25px"> Enter Custom Commands</b><br><br>
						<input type="text" id="customCommand" style="align-items: center;  justify-content: center; margin-left: 25px">&nbsp;&nbsp;<button id="customCommand" class="btn btn-grey"onclick="customCall()" style="align-items: center;  justify-content: center; margin-left: 0px">Submit Command</button>
						<br><br><br>
						<div class="panel panel-success">
							<div class="panel-heading">
								<h3 class="panel-title"><i class="fa fa-magic fa-fw"></i> Axis Control</h3>
							</div>
						</div>
						<b style= "align-items: center;  justify-content: center; margin-left: 25px">Enter Axis Movement Length (mm) </b><br><br>
						<input type="number" id="jogInput" style="align-items: center;  justify-content: center; margin-left: 50px" min="0"><br><br><br>
						<b style="align-items: center;  justify-content: center; margin-left: 25px">X/Y Control</b>
						<b style="align-items: center;  justify-content: center; margin-left: 125px">Z Control</b>
						<br><br>
						<button id="axisControl" class="btn btn-grey" style="align-items: center;  justify-content: center; margin-left: 85px" onclick="moveUP()" >Y+</button>
						<button id="axisControl" class="btn btn-grey" style="align-items: center;  justify-content: center; margin-left: 120px" onclick="moveZ_UP()" >Z+</button>
						<button id="axisControl" class="btn btn-grey" onclick="moveZ_DOWN()" style="align-items: center;  justify-content: center; margin-left: 25px">Z-</button>
						<br>
						<button id="axisControl" class="btn btn-grey"onclick="moveLEFT()" style="align-items: center;  justify-content: center; margin-left: 25px">X-</button>
						<button id="axisControl" class="btn btn-grey" onclick="moveRIGHT()" style="align-items: center;  justify-content: center; margin-left: 75px">X+</button><br>
						<button id="axisControl" class="btn btn-grey" onclick="moveDOWN()" style="display: flex;align-items: center;  justify-content: center; margin-left: 85px">Y-</button>
						<br><br>
						
						<b style= "align-items: center;  justify-content: center; margin-left: 25px">Homing Control</b>
						<br><br>
						<button id="homeControl" class="btn btn-grey" onclick="homeX()" style="align-items: center;  justify-content: center; margin-left: 50px">Home X</button>
						<button id="homeControl" class="btn btn-grey" onclick="homeY()" style="align-items: center;  justify-content: center; margin-left: 25px">Home Y</button>
						<button id="homeControl" class="btn btn-grey" onclick="homeZ()" style="align-items: center;  justify-content: center; margin-left: 25px">Home Z</button>
						<button id="homeControl" class="btn btn-grey" onclick="homeAll()" style="align-items: center;  justify-content: center; margin-left: 25px">Home XYZ</button>
						<br>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-folder fa-fw"></i>  Available Files</h3>
				</div>
				<div class="col-lg-4">
					<br><br><br><br><br><br>
					<!-- <div class="panel panel-info">
								<div class="panel-heading">
											<h3 class="panel-title"><i class="fa fa-file fa-fw"></i> File Controls</h3>
								</div>
						<div class="panel-body"> -->
							<!-- <input type="button" value="Create Folder" class="btn btn-outline btn-primary" onclick="createFolder()"></>&nbsp; -->
							<!-- <input type="text" id="fName" name="fName" ></><br><br> -->
							<!-- <input id="gcode_upload" class="btn btn-outline btn-success" content-type="multipart/form-data" accept=".stl,.gcode,.gco,.g" type="file" name="file" class="fileinput-button" data-bind="enable: loginState.isUser()"><br>
							&nbsp;&nbsp;<button  id="uploadFile" class="btn btn-primary" onclick="uploadFile()">Upload</button>
						</div>
					</div> -->
				</div>
				<div class="panel-body">
					<div id="table_contents" class="table-responsive">
					</div>
					<!-- <div class="text-right">
								<a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	
	<!-- /.panel .chat-panel -->
</div>
<!-- /.col-lg-4 -->
</div>
<!-- /.row -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

	<script type="text/javascript">

		if ($id('currentState').innerHTML == ''){

			$id('currentState').innerHTML = '<b style="color: red;">ERROR: FIX ME!</b>';
			// console.log("blank");


		}
		// ### establish connection to the API ### //
		// var printerURL = "http://yng2.dyndns.org:9999";  //this is for remote testing
		var client1 = new OctoPrintClient({baseurl: printerURL, apikey: apiKey});
		// console.log(client1);
		//// how to call api:  client1.printer.setToolTargetTemperatures({"tool0": 220, "tool1": 205});  


		var fileSelect = "";
		var rowCount = ""

		var list = [];
		var list_count = 0;
		var name = "";
		var size = "";
		var volume = "";
		var nameDelete = [];
		var nameID_num = 0;
		var buttonID_num = 0;
		var rowID = 0;
		var wheeCheck = 0;
		var noz_count = JSON.stringify(document.getElementById("currentNozzle").innerText);


		/// for getFiles();
		var list_size = 10;


		function add_to_list_array(pos, count){
			for (var x = pos;x < (count+pos);x++){
			  list[x] = new Array(4);
			}
		}

		add_to_list_array(0,list_size);        
		// console.log(list);


		// ele calls ()
		var tool0 = $id('tool0').innerHTML;
		var tool1 = $id('tool1').innerHTML;
		// var yngFiles = 	OctoPrint.files.list();


		// Octo Data
		var data = {"port": 'AUTO',
					"baudrate": 250000, 
					"save": true, 
					"autoconnect": true};

		
		// Dynamic Table ()
		function create_a_table(list,list_count){
				if(list_count > 0){

					var table = "<table id='dynTable'class='table table-bordered table-hover table-striped'>";
					// var name = "";
					// var size = "";
					// var volume = "";
					// var depth = "";
					var time = "";
/*
					var controls = '<a onclick="jobSelectDownload()" class="btn btn-sq-xs btn-primary"><i class="fa fa-download fa-1x"></i><br/></a><a onclick="jobSelectDelete()" class="btn btn-sq-xs btn-danger"><i class="fa fa-trash-o fa-1x"></i><br/></a><a href="#" class="btn btn-sq-xs btn-info"><i class="fa fa-folder-open fa-1x"></i><br/></a><a href="#" class="btn btn-sq-xs btn-success"><i class="fa fa-print fa-1x"></i><br/></a><a href="#" class="btn btn-sq-xs btn-default"><i class="fa fa-linux fa-1x">';
*/                       
					var controlstart = "";
					var controlend = "";
					var controls = "";

					// console.log(list);
					table = table + "<thead>";
					table = table + "<tr>";
					table = table + "<th onclick='sortQuotes1(0);'>File Name</th>";
					table = table + "<th>Size (MB)</th>";
					table = table + "<th>Volume (cm<sup>3</sup>)</th>";
					table = table + "<th onclick='sortQuotes1(1);'>Print Time (Hours)</th>";
					table = table + "<th>Controls</th>";
					table = table + "</tr>";
					table = table + "</thead>";
					table = table + "<tbody>";


					for(var x=0;x<list_count;x++){
						/*DAN CHECK HERE*/
						name = list[x][0];
						size = list[x][1];
						volume = list[x][2];
						time = list[x][3];

						nameDelete.push(name);
						nameID_num = x;
						buttonID_num = x;
						rowID = x;
						

						controlstart = '<a href="'+printerURL+"/downloads/files/local/"+name+'" title="Download" ';
						controlend = '< class="btn btn-sq-xs btn-primary"><i class="fa fa-download fa-1x"></i><br/></a><a id="name_ID_'+buttonID_num+'" onclick="deleteLocal(this.id)" title="Delete File" class="btn btn-sq-xs btn-danger"><i class="fa fa-trash-o fa-1x"></i><br/></a><a id="name_ID_'+buttonID_num+'" onclick="loadJob(this.id)" title="Print Now" class="btn btn-sq-xs btn-success"><i class="fa fa-print fa-1x"></i><br/></a><a href="#" title="This is Tux" class="btn btn-sq-xs btn-default"><i class="fa fa-linux fa-1x">';
						controls = controlstart+controlend;
						// console.log(controls);
						// depth = list[x][2];


						//FOLDER DOWNLOAD: store file path in 'name' and use regex clean up the path. or add a new element to the array for 'name'


						table = table + "<tr id='row"+rowID+"'>";
						// table = table + "<td style='text-align:left;width:25%; align='>" + id + "</td>";
						table = table + "<td id='name_ID_"+nameID_num+"' style='text-align:left;width:25%; align=''>" + name + "</td>";
						table = table + "<td style='text-align:left;width:10%;'>" + size + "</td>";
						table = table + "<td style='text-align:left;width:10%;'>" + volume + "</td>"
						// table = table + "<td style='text-align:left;width:20%;'>" + depth + "</td>";
						table = table + "<td style='text-align:left;width:11%;'>" + time + "</td>";
						table = table + "<td style='text-align:left;width:23%;'>" + controls + "</td>";
						table = table + "</tr>";
					}

					table = table + "</tbody>";
					table = table + "</table>";

					document.getElementById('table_contents').innerHTML = table;

				}
			}


		// File Queue ()
		function getFiles(fileNameDL){

			list_count = 0;

			var recursivelyPrintNames = function(entry, depth) {
			depth = depth || 0;

			var isFolder = entry.type == "folder";
			var namef = (isFolder ? "+ " + entry.name : entry.name);
			var sizef = (isFolder ? "+ " + entry.size : entry.size);
			var volumef = (isFolder ? "+ " + entry.gcodeAnalysis.filament.tool0.volume : entry.gcodeAnalysis.filament.tool0.volume);
			var timef = (isFolder ? "+ " + entry.gcodeAnalysis.estimatedPrintTime : entry.gcodeAnalysis.estimatedPrintTime);
			if(list_count >= list_size){    //make the list longer by 5
				add_to_list_array(list_count,1);
			}   

			list_count = list_count + 1;


			///####### File Select, File Download ######
			var fileNameDL = JSON.stringify(entry.name);
			// console.log('fileNameDL: ' + fileNameDL);


			client1.files.download('testing',fileNameDL).done(function(response){
				var contents = response;
				// console.log('downloaded File:' + fileNameDL);
				});
			
			// console.log(_.repeat("| ", depth - 1) + (depth ? "|-" : "") + name);

			if (isFolder) {
			_.each(entry.children, function(child) {
				recursivelyPrintNames(child, depth + 1);
					});
				}
			};

			var depth;
			client1.files.list(true)        //this makes for a LONG console list....
				.done(function(response){
					// console.log("### Files:");
					_.each(response.files, function(entry) {
						// console.log(additionalInfo.type);


						//##### entry.type = machine code or folder #########
						if (entry.type == "folder"){
							var isFolder = 1;
							depth = depth || 0;
							var name = (isFolder ? "+ " + entry.name : entry.name);
							_.each(entry.children, function(child) {
									recursivelyPrintNames(child, depth + 1);
										});
							
						}else{
							

							if(list_count >= list_size){        //make the list longer by 5
								add_to_list_array(list_count,1);
							}
							try{
								list[list_count][0]=entry.name;
							} catch(err){
								//do something or nothing
							}
							try{
								list[list_count][1]=(Math.round((entry.size)/10000)/100);
							} catch(err){
								//do something or nothing
								list[list_count][1] = 'Processing';
							}
							try{
								list[list_count][2]=(Math.round((entry.gcodeAnalysis.filament.tool0.volume)*100)/100);
							} catch(err){
								//do something or nothing
								list[list_count][2] = 'Processing';

							}
							try{
								list[list_count][3]=((Math.round((entry.gcodeAnalysis.estimatedPrintTime)/60)/60));
							} catch(err){
								//do something or nothing
								list[list_count][3] = 'Processing';

							}

							list_count = list_count + 1;

						}

					});
					//console.log("list count: " + list_count);
					//console.log("list: " + list);
					create_a_table(list,list_count);
				});


		}

		getFiles();


		//## Delete File ##
		function deleteLocal(clicked_id){

			//## file name ## 
			var fileSelect = document.getElementById(clicked_id).textContent;

			swal({
			  title: "Are you sure?",
			  text: "You are deleting  '" + fileSelect + "'  from the Local Directory",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, DELETE it!",
			  closeOnConfirm: false
			},
			function(){
				client1.files.delete("local",fileSelect);
				getFiles();

			  swal("Deletion Complete!", "'"+fileSelect+"'  has been DELETED!", "success");
			});

		}

		//## Refresh Table ##
		function refreshTable(){

			getFiles();
			// console.log('getFiles executed');
		}

		///## Update File Table ## 
		var updateTable = function updateTable() {
			$.get(printerState()), function(dataTable){    // get new total
				$id('dynTable').innerHTML = dataTable;
				};
			};
		var runRefTable = setInterval(updateTable,5000);



		var uN = ""
		var pW = ""
		// User Login ()
		function userLogin(){
			
			client1.browser.login(uN, pW, true);

		}

		// Printer Status (temp info, sd state, etc.) ()
		function printerState() {

			client1.connection.getSettings().done(function(response){

				var getState = JSON.stringify(response.current.state);
				var getPort = JSON.stringify(response.current.port);
				var getBaudrate = JSON.stringify(response.current.baudrate);
				var getPrinterProfile = JSON.stringify(response.current.printerProfile);


				$id('currentState').innerHTML = getState;
				$id('currentPort').innerHTML = getPort;
				$id('currentBR').innerHTML = getBaudrate;
				$id('currentProfile').innerHTML = getPrinterProfile;
				// $id('jobStatus').innerHTML = fileSelect;

				// console.log(wheeCheck);

				// if(wheeCheck == 0){

					// wheeCheck = 1


					//## Enable/Disable Connection Buttons ## ()
					var current_state = $id('currentState').innerHTML;
					// console.log(current_state);

					if(current_state == '"Operational"' | '"Connecting"'  | '"Printing"'){

						//## Turn off ##
						$('#conPrint').removeAttr('enabled','enabled');
						$('#conPrint').attr('disabled','disabled');
						// console.log('greyed on switch');

						//## Turn on ##
						$('#disconPrint').removeAttr('disabled','disabled');
						$('#disconPrint').attr('enabled','enabled');
						$id('disconPrint').classList.remove('disabled');

					}else if(current_state == '"Closed"' | '"offline"'){

						//## Turn off ##
						$('#disconPrint').removeAttr('enabled','enabled');
						$('#disconPrint').attr('disabled','disabled');
						// console.log('greyed off switch');

						//## Turn on ##
						$('#conPrint').removeAttr('disabled','disabled');
						$('#conPrint').attr('enabled','enabled');
						$id('conPrint').classList.remove('disabled');

					}
				// }else if(wheeCheck == 1){
				// }
			});

		}

		printerState();

		//## AUTO Refresh Printer State ##
		function refreshState(){

			// ();
			// console.log('Printer State Refreshed');
			///## Update File Table ## 
			var updateState = function updateState() {
				$.get(refreshState()), function(dataState){    // get new total
					$id('printerState').innerHTML = dataState;
					};
				};
			// var runRefTable = setInterval(updateState,3000);
		}
		refreshState();
		

		function pop_PRT(){

			client1.connection.getSettings().done(function(response){

				// takes elements from an array, removes Brackets, parantheses and sends elements to new array.

				var PRT = document.getElementById('selectPRT');
				var prt_Array = JSON.stringify(response.options.ports).replace(/[\]"\")}[{(]/g, '');
				// console.log(prt_Array);
				prt_Array = prt_Array.split(',');


				// console.log(prt_Array);
				// console.log(prt_Array.length);


				function populateSelectElement(element, array){

					var PRT_option,
						i;
					for(i = 0; i < prt_Array.length; i += 1) {
						PRT_option = document.createElement('option');
						PRT_option.textContent = prt_Array[i];
						element.appendChild(PRT_option);
					}
				}
					populateSelectElement(PRT, prt_Array);

			});

		}

		// pop_PRT();

		function pop_BR(){

			client1.connection.getSettings().done(function(response){

				// takes elements from an array, removes Brackets and sends elements to new array.

				var BR = document.getElementById('selectBR');
				var br_Array = JSON.stringify(response.options.baudrates).replace(/[\])}[{(]/g, '');
				// console.log(br_Array);
				br_Array = br_Array.split(',');

				// console.log(br_Array);
				// console.log(br_Array.length);

				function populateSelectElement(element, array){

					var BR_option,
						i;
					for(i = 0; i < br_Array.length; i += 1) {
						BR_option = document.createElement('option');
						BR_option.textContent = br_Array[i];
						element.appendChild(BR_option);
					}
				}
					populateSelectElement(BR, br_Array);

			});

		}

		// pop_BR();


		// List of Users ()
		function activeUsers(){
			var yngUsers = 	client1.users.list();
			// console.log(client1.users.list());

			$id('activeUsers').innerHTML = yngUsers;
		}


		//########## Print Controls () ##############


		// Connect to Printer ()
		function connectPrint() {

			client1.connection.connect(data);
			swal("Good News","The Printer has been Connected","success");
			printerState();
		}
		

		// Disconnect from the Printer ()
		function discoPrint(){


			swal({
			  title: "Are you sure?",
			  text: "You are disconnecting from the printer",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, Disconnect it!",
			  closeOnConfirm: false
			},
			function(){
			  client1.connection.disconnect(data);
			  printerState();
			  swal("Disconnected!", "The Printer has been disconnected.", "success");
			});

			printerState();

		}



		function startPrint(){

			client1.job.start();
			// console.log('resumed');

		}

		// Pause/Resume
		function PRprint(){


			client1.job.togglePause();
			// console.log('paused');

		}


		function cancelPrint(){

			client1.job.cancel();
			// console.log('caneled print');

		}



		function filamentReload(){

					// ### Sends commands straight to the terminal ### \\
					// client1.control.sendGcode();

					var eNUM = 650;     // extruder length ? (E#)
					var fNUM = 5000;    //feed rate
					var numCounter = (fillLength/(eNUM));
					var Final_eNUM = (fillLength%(eNUM));
					var roundedCounter = Math.round(numCounter);
					var counterCheck = 0;
					var fullCommand = "";

					for(var f = 0;f<roundedCounter;f++){
						fullCommand = fullCommand + "G92 E0\r\n";
						counterCheck++;

						if((Final_eNUM == 0) && (f == roundedCounter - 1)){
							counterCheck == 0;
							f == 0;
							fullCommand = fullCommand + "G1 E650 F500\r\n";
							fullCommand = fullCommand + "G92 E0\r\n";

						}else{
							fullCommand = fullCommand + "G1 E650 F5000\r\n";

						}
					}


					if((counterCheck == f) && (Final_eNUM != 0)){
						fullCommand = fullCommand + "G92 E0\r\n";
						fullCommand = fullCommand + "G1 E"+Final_eNUM+" F500\r\n";
						fullCommand = fullCommand + "G92 E0\r\n";
						counterCheck == 0;
						f == 0;
					}
					if(fullCommand == ""){
						console.log("there was an error");
					}else{
						client1.control.sendGcode(fullCommand);
					}
		}

		function disableExtruders(){

			swal({
				  title: "Disable Active Extruder Motors?",
				  text: "Are you sure you want to DISABLE any Active Extruder Motors?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, DISABLE Active Extruders",
				  closeOnConfirm: false
				},
				function(){

					client1.control.sendGcode("M18 E0");
					client1.control.sendGcode("M18 E1");

					swal("Command Executed", "Active Extruder Motors DISABLED", "success");
				});
			


		}


		// ###  Axis Movement (JOG COMMAND) & Homing commands  ###

		function moveUP(){

			var jogEntered = parseInt($id('jogInput').value);
			console.log("stingified UP: "+jogEntered);
			client1.printer.jog({"y": jogEntered});
			console.log("Moved UP by "+jogEntered+" "+"mm");

		}

		function moveDOWN(){
			var jogEntered = parseInt($id('jogInput').value);
			client1.printer.jog({"y": -jogEntered});
			console.log("Moved DOWN by "+jogEntered+" "+"mm");

		}

		function moveLEFT(){
			var jogEntered = parseInt($id('jogInput').value);
			client1.printer.jog({"x": -jogEntered});
			console.log("Moved LEFT by "+jogEntered+" "+"mm");

		}

		function moveRIGHT(){
			var jogEntered = parseInt($id('jogInput').value);
			client1.printer.jog({"x": jogEntered});
			console.log("Moved RIGHT by "+jogEntered+" "+"mm");

		}

		function moveZ_UP(){
			var jogEntered = parseInt($id('jogInput').value);
			client1.printer.jog({"z": jogEntered});
			console.log("Moved z_AXIS  UP by "+jogEntered+" "+"mm");

		}

		function moveZ_DOWN(){
			var jogEntered = parseInt($id('jogInput').value);
			client1.printer.jog({"z": -jogEntered});
			console.log("Moved Z-AXIS  DOWN by "+jogEntered+" "+"mm");

		}

		function homeX(){
			// console.log('Homed X Axis');
			client1.printer.home(["x"]);
		}

		function homeY(){
			// console.log('Homed Y Axis');
			client1.printer.home(["y"]);
		}

		function homeZ(){
			// console.log('Homed Z Axis');
			client1.printer.home(["z"]);
		}

		function homeAll(){
			client1.printer.home(["x","y","z"]);
		}

		function customCall(){
			var commandEntered = $id('customCommand').value;
			client1.control.sendGcode(commandEntered);
		}


		function get_tool0_temp(){


			client1.printer.getFullState().done(function(response){

			// Actual Temp
			var getTemp0A = JSON.stringify(response.temperature.tool0.actual);
			$id('tempStatus0A').innerHTML = getTemp0A;

			// Target Temp
			var getTemp0T = JSON.stringify(response.temperature.tool0.target);
			$id('tempStatus0T').innerHTML = getTemp0T;


			// // Actual Temp Placeholder if no value is available
			if ((getTemp0A === "null") || (getTemp0A === "off") || (getTemp0A === "0")){

				$id('tempStatus0A').innerHTML = "off";
				// return updateTempT0();

			}else{

				$id('tempStatus0A').innerHTML = getTemp0A;
				// return updateTempT0();
			}; 


			// Target Temp Placeholder if no value is available
			if ((getTemp0T === "null") || (getTemp0T === "off") || (getTemp0T === "0")){

			$id('tempStatus0T').innerHTML = "off";

			}else{

				$id('tempStatus0T').innerHTML = getTemp0T;
			};

			});
		}

		get_tool0_temp();



		function get_tool1_temp(){

			if(noz_count != '"   Single"'){

				// console.log("noz: "+noz_count);

			client1.printer.getFullState().done(function(response){

				// Actual Temp
				var getTemp1A = JSON.stringify(response.temperature.tool1.actual);
				$id('tempStatus1A').innerHTML = getTemp1A;
				// console.log("getTemp1A: "+getTemp1A);

				// Target Temp
				var getTemp1T = JSON.stringify(response.temperature.tool1.target);
				$id('tempStatus1T').innerHTML = getTemp1T;


				// // Actual Temp Placeholder if no value is available
				if ((getTemp1A === "") || (getTemp1A === "null") || (getTemp1A === "off") || (getTemp1A === "0")){

					$id('tempStatus1A').innerHTML = "off";
					// return updateTempT0();

				}else{

					$id('tempStatus1A').innerHTML = getTemp1A;
					// return updateTempT0();
				}; 


				// Target Temp Placeholder if no value is available
				if ((getTemp1T === "null") || (getTemp1T === "off") || (getTemp1T === "0")){

				$id('tempStatus1T').innerHTML = "off";

				}else{

					$id('tempStatus1T').innerHTML = getTemp1T;
				};


				// console.log("getTemp0A: " + getTemp0A);
				// console.log("getTemp0T: " + getTemp0T);
				});
			}
		}

		get_tool1_temp();


		function set_tool0_temp(){

			var tool_temp0 = parseInt($id('tool0').value);

			swal({
				  title: "TOOL_0 Temp Change",
				  text: "You are changing TOOL_1's Temperature to: " + "'" + tool_temp0 + "'",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, update TOOL_1's Temp!",
				  closeOnConfirm: false
				},
				function(){

					client1.printer.setToolTargetTemperatures({"tool0": tool_temp0});

					swal("Updated!", "TOOL_0's Temperature has been UPDATED!", "success");
				});

		}

		

		function set_tool1_temp(){

			var tool_temp1 = parseInt($id('tool1').value);

			swal({
				  title: "TOOL_1 Temp Change",
				  text: "You are changing TOOL_1's Temperature to: " + "'" + tool_temp1 + "'",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, update TOOL_1's Temp!",
				  closeOnConfirm: false
				},
				function(){

					client1.printer.setToolTargetTemperatures({"tool1": tool_temp1});

					swal("Updated!", "TOOL_1's Temperature has been UPDATED!", "success");
				});

		}



		// Update Actual Temp
		var updateTempsA = function updateTempsA(){
			$.get(get_tool0_temp()), function(data0A){    // get new total
				$id('tempStatus0A').innerHTML = data0A;
			}

			// run2nd = JSON.stringify(document.getElementById("currentNozzle").innerText);
			// console.log('run2nd:' + run2nd);

			if(noz_count == '"   Duplication"'){
				// console.log('Duplication Mode -> T1A Updated');
				$.get(get_tool1_temp()), function(data0T){    // get new total
					$id('tempStatus0T').innerHTML = data0T;
				}
			}


		};


		// Update Target Temp
		var updateTempsT = function updateTempsT(){
			$.get(get_tool0_temp()), function(data0T){    // get new total
				$id('tempStatus0T').innerHTML = data0T;
			}

			// run2nd = JSON.stringify(document.getElementById("currentNozzle").innerText);

			if(noz_count == '"   Duplication"'){
				$.get(get_tool1_temp()), function(data1T){    // get new total
					$id('tempStatus1T').innerHTML = data1T;
				}
			}
		};

		var runningA = setInterval(updateTempsA,5000);
		var runningT = setInterval(updateTempsT,2500);

		function set_bed_temp(){

			var ddZoneSelect = document.getElementById("zoneSelect");
			var zoneSelect = ddZoneSelect.options[ddZoneSelect.selectedIndex].value;
			var zoneTemp = document.getElementById("zoneTempInput").value;

			// console.log(zoneSelect);



			swal({
				  title: "Zone Temperature Change",
				  text: "You are changing Zone"+" "+zoneSelect+" Temperature to: " + "'" + zoneTemp + "'",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, update Zone"+" "+zoneSelect+" Temp!",
				  closeOnConfirm: false
				},
				function(){

					if(zoneTemp<20){

						client1.control.sendGcode("B16 P" +zoneSelect+" S"+zoneTemp+" E0");

					}else{

						client1.control.sendGcode("B16 P" +zoneSelect+" S"+zoneTemp+" E1");

					}

					swal("Updated!", "Zone "+zoneSelect+"'s Temperature has been UPDATED to "+zoneTemp+"", "success");
				});

			

		}


		// No longer needed, Nozzle pulled from DB ()
		function nozzleCount(){

			// console.log(noz_count);


			if(noz_count == '"   Single"'){

				$("#dualNoz").css("display","none");
				
			}else if(noz_count == '"   Duplication"'){

				;
				
			}else{
				console.log('Nozzle Hide error');	//### If broken, due to the ABSCENCE/OR NOT of &nbsp; before the values. hence the spaces for the IF statements
			}

		}
		nozzleCount();


		function updateBanner(){


			client1.settings.get().done(function(response){
				var nameTitle = JSON.stringify(response.appearance.name);
				// console.log(nameTitle);
				var banner = JSON.stringify(document.getElementById("currentPrinter").innerText);

				document.getElementById("banner").innerHTML = nameTitle;

				// if(banner == '"    reveal3D"'){
				//     img_element = '<img src="images/reveal3D_Banner.png">';
				//     document.getElementById("banner").innerHTML = img_element;


				// }else if(banner =='"    FRANK3"'){
				//     img_element = '<img src="images/frankLightning.png">';
				//     document.getElementById("banner").innerHTML = img_element;

				// }else if(banner =='"    GT"'){
				//     img_element = '<img src="images/gt_logo.jpg">';
				//     document.getElementById("banner").innerHTML = img_element;


				// }else{
				//     console.log('did not work');	//### If broken, due to the ABSCENCE/OR NOT of &nbsp; before the values. hence the spaces for the IF statements
				// }

				// '<h1 style="text-align:center" class="page-header"><img src="/images/gt_logo.jpg"></h1>'

			});

		}
		updateBanner();



		function uploadFile(){

			//## Selects file name from upload input ##
			var file = $('#gcode_upload')[0].files[0];


			swal({
				  title: "Are you sure?",
				  text: "You are UPLOADING a new file called:    '"+JSON.stringify(file.name)+"' ",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, UPLOAD '"+file.name+"'! ",
				  closeOnConfirm: false
				},
				function(){

					if (file){
						// console.log('fileName: ' + file.name);
						client1.files.upload("local",file);
						// getFiles();
					}

					swal("Upload Success!", "The File has been UPLOADED!", "success");
					getFiles();
				});
		}


		function createFolder(){

		swal({
			  title: "Are you sure?",
			  text: "You are creating a new folder",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, create the new folder!",
			  closeOnConfirm: false
			},
			function(){

				var file_Name = $id('fName').value;

				// console.log(client1.files.createFolder('local', file_Name));

				client1.files.createFolder('local', file_Name);

				swal("Created!", "The folder has been created!", "success");
			});


		}


		function activeJob(){

			var acjob = client1.get("api/job");
			var tmpstate = "";


			client1.get("api/job").done(function(job){
				// console.log(job);
				// console.log("wtf");
				// console.log(job.job.file.name);
				// console.log("2");
				// console.log(job.job);
				//dan look here
				tmpstate = job.job.file.name;
				var getAJ = JSON.stringify(tmpstate);
				$id('jobActive').innerHTML = getAJ;
				// console.log(tmpstate+" WTFWASDFASDFASDFASDF");

			});
		}

			activeJob();

// ############################################################################# //
		// Update ActiveJob every 25 secondss
		var updateAJob = function updateAJob(){
			$.get(activeJob()), function(data0T){    // get new total
				$id('tempStatus0T').innerHTML = data0T;
			}
			
		};

		var runningActJob = setInterval(updateAJob,25000);

// ############################################################################# //

		function loadJob(clicked_id){

			var fileLoad = document.getElementById(clicked_id).textContent;

			$id('jobActive').innerHTML = JSON.stringify(fileLoad);
			client1.files.select("local",fileLoad,true);
		}


		function showSettings(){

			client1.settings.get().done(function(response){
				var nameTitle = JSON.stringify(response.appearance.name);
				// console.log(nameTitle);
			});

		}

		showSettings();

		//### Sort Table1 when clicking header ###
		function sortQuotes1(n){
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("dynTable");
			switching = true;
			dir = "asc";
			while (switching) {
			switching = false;
			rows = table.getElementsByTagName("TR");
			for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName("TD")[n];
			y = rows[i + 1].getElementsByTagName("TD")[n];
			// console.log(valueX);
			// console.log(valueY);
			if(n == 0){
				if (dir == "asc") {
			if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
				shouldSwitch= true;
				break;
			}
			} else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch= true;
					break;
				}
				}
				}
			if(n == 1){
				if (dir == "asc") {
				if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
				shouldSwitch= true;
				break;
				}
			}else if (dir == "desc") {
				if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())) {
				shouldSwitch= true;
				break;
				}
				}
				}
			}
			
			if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
			switchcount ++;
			} else {
			if (switchcount == 0 && dir == "asc") {
			dir = "desc";
			switching = true;
			}
			}
			}
		}

		sortQuotes1();
		$(document).ready(function(){
			sortQuotes1();

			window.onload(sortQuotes1(0));

		});

	</script>


	<?php  

		mysqli_close($dbc);

	?>

	<!-- jQuery -->
	<script src="vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="vendor/metisMenu/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<!-- <script src="vendor/raphael/raphael.min.js"></script> -->

	<!-- Custom Theme JavaScript -->
	<script src="dist/js/sb-admin-2.js"></script>

</body>

<footer class="panel-footer" align="center">
	<p style="color:rgb(4, 0, 84)"> Copyright &copy 2017 All Rights Reserved: Y.N.G LLC D.B.A. "You'll Never Guess" </p>
</footer>

</html>
