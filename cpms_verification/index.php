<!doctype html>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php  

	//error_reporting(0);
	session_start();
	include "db_connect2.php";

?> 
<html lang="en">
<head>
	<title>CPMS VERIFICATION</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="image/dswd_icon.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/dswd_icon.jpg">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/dswd_icon.jpg">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js3/datatable.js"></script>
	<script src="js3/datatable2.js"></script>	
</head>
<style>
.modal-dialog {
   width: 100%;
   padding: 0;
}
.modal-content {
   height: 100%;
   border-radius: 0;
}
#example_filter{
   float:right;
}
#example_paginate{
   float:right;
}
label {
   display: inline-flex;
   margin-bottom: .5rem;
   margin-top: .5rem;  
}
#myProgress {
  width: 100%;
  background-color: #ddd;
}
#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
}
</style>

<body>
	<!-- WRAPPER -->
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand"style="height:95%">
				<a href="index.html"><img src="assets/img/logo-dswd.png"  class="img-responsive logo"></a>
			</div>
			
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT --><br><br><br><br><br>
							<!-- BASIC TABLE -->
							<div class="panel">
								 <div id="employee_table" style="font-family:arial">  
								<table id="example" width="100%" class="table table-striped table-bordered" > 
							<thead>
                               <tr>
								  <th width="5%"><center><b>No.</b></th>
								  <th width="20%"><center><b>Client Name</b></th>
								  <th width="20%"><center><b>Beneficiary Name</b></th>
								  <th width="10%"><center><b>Date Completed</b></th>
								  <th width="20%"><center><b>Remaining Days</b></th>
								  <th width="20%"><center><b>Service</b></th>
								  <th width="5%"><center><b>Mode</b></th>
								</tr>
			</thead>
			<tbody>
                               <?php 
							  
								
								$ctr1=1;
								$sql = "SELECT DISTINCT t.bene_id,c.lastname,c.middlename,c.firstname,c.extraname, b.b_fname,b.b_lname,b.b_mname,DATEDIFF(now(),DATE(t.date_accomplished)) as days,
										date(t.date_accomplished) as date_accomplished,a.mode,a.type from tbl_transaction t
										LEFT OUTER JOIN client_data c on c.client_id = t.client_id 
										LEFT OUTER JOIN beneficiary_data b on b.bene_id = t.bene_id 
										INNER JOIN assistance a on a.trans_id = t.trans_id 
										WHERE status_client = 'Done' and DATEDIFF(now(),DATE(t.date_accomplished)) < 120 GROUP BY t.client_id";
								
								$result = mysqli_query($conn,$sql);
								mysqli_set_charset($conn, "utf8");
								$resultcheck = mysqli_num_rows($result);
								if($resultcheck>0){
                               while($row = mysqli_fetch_assoc($result))  
                               {	$cname				=	$row["lastname"].', '.$row["firstname"].' '.$row["middlename"];  
									$bname				=	$row["b_lname"].', '.$row["b_fname"].' '.$row["b_lname"] ;  
									$dateaccomplished   = 	date($row['date_accomplished']);
									$days 				=	90 - $row['days'];
									
									$dateaccomplished2 	= strtotime($row['date_accomplished']);
									$accomplisheddate 	= explode("-",$dateaccomplished);
									$dateaccomplished3 	= date('F d,Y',strtotime('+ 00 days',$dateaccomplished2));
									$next_due_date 		= date('F d,Y', strtotime('+ 91 days', $dateaccomplished2));
								
								
								//$dateStart = new DateTime($dateStart);
								//$date = DateTime::createFromFormat('Y-m-d', $now)->diff($dateEnd)->d;
								
                               ?>  
                               <tr >  
								<td><?php echo $ctr1?></td>
								<td><?php echo strtoupper($cname)?></td>
								<td><?php if($row["bene_id"]==null){echo "";}else{echo strtoupper($bname);}?></td>
								<td><?php echo $dateaccomplished3?></td>
								<td align="center"><?php echo $next_due_date.'<br>Remaining '.$days.' day(s)'?></td>
								<td><?php echo strtoupper($row["type"])?></td>
								<td><?php echo strtoupper($row["mode"])?></td>
							   </tr>
							<?php $ctr1++;?>
                               <?php  
							   }}
							else{
								echo "<script>window.open('index.php','_self')</script>"; }
                               ?>   
							   <tfoot>
								<tr>
								  <th width="5%"><center><b>No.</b></th>
								  <th width="20%"><center><b>Client Name</b></th>
								  <th width="20%"><center><b>Beneficiary Name</b></th>
								  <th width="10%"><center><b>Date Completed</b></th>
								  <th width="20%"><center><b>Remaining Days</b></th>
								  <th width="20%"><center><b>Service</b></th>
								  <th width="5%"><center><b>Mode</b></th>
								</tr>
							</tfoot>
							</table> 
								</div>
							</div>
							<!-- END BASIC TABLE -->
					
							<!-- END CONDENSED TABLE -->
						</div>
						
			<!-- END MAIN CONTENT -->
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 . All Rights Reserved.</p>
			</div>
		</footer>
	<!-- END WRAPPER -->
	<!-- Javascript -->
</body>

</html>

 <script>
 function test(full_name) {
 alert(full_name);
}
 </script>
 <script>
$(document).ready(function() {
    $('#example').DataTable(
        
         {     

      "aLengthMenu": [[10, 15, 25, -1], [10, 15, 25, "All"]],
        "iDisplayLength": 10
       } 
        );
} );


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>
<script type="text/javascript" charset="utf-8">
 
function addmsg(type, msg){
 
$('#notification_count').html(msg);
$('#noti3').html(msg);
 
}
 
 function cutmsg(type, msg1){
 
$('#notification_count').html(msg1);
$('#noti3').html(msg);
 
}
 function removeNotification(){
$.ajax({
type: "GET",
url: "insert.php",
 
async: true,
cache: false,
timeout:50000,
 
success: function(data){
cutmsg("new", data);
setTimeout(
waitForMsg,
1000
);
}
});
 }
function waitForMsg(){
 
$.ajax({
type: "GET",
url: "fetch.php",
 
async: true,
cache: false,
timeout:50000,
 
success: function(data){
addmsg("new", data);
setTimeout(
waitForMsg,
1000
);
},
error: function(XMLHttpRequest, textStatus, errorThrown){
addmsg("error", textStatus + " (" + errorThrown + ")");
setTimeout(
waitForMsg,
15000);
}
});
};
 
$(document).ready(function(){
 
waitForMsg();
 
});
 
</script>
 
 