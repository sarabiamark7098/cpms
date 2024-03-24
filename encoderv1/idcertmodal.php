<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	
        
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }

?>
<!DOCTYPE html>
<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">	
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
		<link rel="stylesheet" type="text/css" href="../style5.css">
        
		<script defer src="../js/solid.js"></script>
		<script defer src="../js/fontawesome.js"></script>
		<script src="../js/jquery.slim.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>
		<script type="text/javascript" src="../js/PSGC.js"></script>
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		
		<!-- added -->
		
		<link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
		<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

	</head>
	<body>
    <script type="text/javascript">
        function idcert(id){
            console.log(id);
            window.location.href = "idcert.php?id="+ id;
        }
    </script>
    <div class="modal-c-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#decline" role="tab"><i class="fa fa-info mr-1"></i> Client</a>
            </li>
        </ul>
        <!-- Tab panels -->
        <div class="tab-content">
            <!--Panel 7-->
            <div class="tab-pane fade in show active" id="decline" role="tabpanel">

                <!--Body-->
                <div class="body">
                    <div class="modal-body">
                    <h5>Do you want to issue ID Certification?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button id="proceed" class="btn btn-primary btn-sm" onclick="idcert(<?php echo $clientid ?>)">Proceed</button>
                    </div> 
                </div>
            </div>
            <!--/.Panel 7-->
					
    </div>

</div> 

</body>
</html>