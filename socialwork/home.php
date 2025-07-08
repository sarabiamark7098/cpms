<?php
	include('../php/class.user.php');
	$user = new User();
    
    if(isset($_GET['servingid'])){
		$result = $user->pendingstatus($_GET['servingid']);
		if($result){
			header('Location:../socialwork/home.php');
			echo "<meta http-equiv='refresh' content='0'>";
		}else{
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}
	if($_SESSION['position'] != 'Social Worker'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php");
							break;
			case 'Social Worker': header("Location: ../socialwork/home.php");
							break;
			case 'Admin': header("Location: ../admin/home.php");
							break;
			default:
				echo "<script>window.location='index.php';</script>";
		}
    }

    // echo $_SESSION['f_office'];

	if((!$_SESSION['login']) && (!$_SESSION['userAccountusername'])	&& (!$_SESSION['userAccountpassword'])){
		header('Location:../index.php');
		exit();
		}

    $licenseData = $user->show_user_data($_SESSION['userId']); // Create this method if needed
    $licenseExpiryMessage = '';

    if ($licenseData && isset($licenseData['sw_license_expiry'])) {
        $expiryDate = new DateTime($licenseData['sw_license_expiry']);
        $today = new DateTime();
        $interval = $today->diff($expiryDate);
        $daysRemaining = (int)$interval->format('%r%a');

        if ($daysRemaining > 0 && $daysRemaining <= 30) {
            $licenseExpiryMessage = "License nearing expiry! ($daysRemaining days left)";
        }elseif ($daysRemaining == 0 ) {
            $licenseExpiryMessage = "Your license expires today!";
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Social Worker</title>

    
    <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../style5.css">
    <style>
        
    </style>
    <!-- Font Awesome JS -->
    <script defer src="../js/solid.js"></script>
    <script defer src="../js/fontawesome.js"></script>
    <script src="../js/jquery.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <!-- added -->
		
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
    <script type="text/javascript">
        //var num = document.getElementById();
        var auto_refresh = setInterval(refreshPage, 1000); // refresh every 1 second interval
        
        function refreshPage(){
            $.ajax({
                type:"POST",
                url:'fetch.php',// put your real file name 
                data:{soc_work:1},
                success:function(msg){
                    $('#table_result').html(msg); 
                    //console.log(msg);
                }
            });
        }
    </script>
</head>

<body>
    <?php //echo $_SESSION['userfullname'] ?>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px" s>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="home.php">List of Client<i style="float: right;font-size:25px" class="fa fa-users"></i> </a> 
                </li>
                <li>
                    <a href="draft.php">Serving Client <i style="float: right;font-size:25px" class="fa fa-child"></i></a>
                </li>
                <li>
                    <a href="reissue.php">Re-issue <i style="float: right;font-size:25px" class="fa fa-clone"></i></a>
                </li>
                <li>
                    <a href="summary_social.php">Summary <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="export.php">Export <i style="float: right;font-size:25px" class="fa fa-file-excel"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-blue">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#userAccount" style="margin-left: 10px;" data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                        <?php $name = explode(' ',$_SESSION['userfullname']); $namef=strtoupper($name[0]); echo $namef;?>
                    </a>
                    <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#license" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add/Update User License</a>
                    <a class="nav-link" disabled style='color:red; font-weight:bold;'><?php echo $licenseExpiryMessage; ?></a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link tohover" data-toggle="modal" data-target="#logoutmodal">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container-fluid" style="padding-left: 5%;">
                <div class="table-responsive-lg">
                    <h5>List of New Clients</h5>
                    <div class="table-responsive-lg" style=" overflow-y: auto; height: 500px;">
                        <table id="tablenamo" class="table responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                            <thead>
                                <tr style="color:white;background-color:gray">
                                    <th>Client Name</th>
                                    <th>Beneficiary Name</th>
                                    <th>Date Started</th>
                                    <th>Encoder</th>
                                    <th width="22%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table_result">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
         $(document).ready(function () {
            $('#sidebar').toggleClass('active');
            $('#sidebarCollapse').toggleClass('active');
        });

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
    <!-- Modal sa user Account -->
    <div class="modal fade in" id="userAccount" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="useraccount">
				
				</div>
			</div>	
		</div>
    </div>
    <div class="modal hide fade" id="declineclient" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Declining Client!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="declineClientbody">
				</div>
			</div>	
		</div>
	</div>
    <div class="modal hide fade" id="logoutmodal" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>
            <div class="modal-body logoutbody"><i class="fa fa-question-circle"></i> Are you sure you want to log-out?</div>
            <div class="modal-footer"><a href="../php/logout.php" class="btn btn-primary btn-block">Logout</a></div>
            </div>
        </div>
    </div>
    <div class="modal fade in" id="license" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Position and License</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="swlicense"> 
				
				</div>
			</div>	
		</div>
    </div>
    
	<script type="text/javascript">
        //userAccount   
        $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
            //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "userAccount.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.useraccount').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
        })

	    //jscript declineclient
		$('#declineclient').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var clientid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + clientid;
		  //console.log(dataString);
            $.ajax({
                type: "GET",
                url: "declineClient.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    //console.log(data);
                    modal.find('.declineClientbody').html(data);
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
        })
        $('#logoutmodal').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=logout';
		  //console.log(dataString);
            $.ajax({
                type: "GET",
                url: "home.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    //console.log(data);
                    modal.find('.logoutbody');
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
        })

        //Social Worker license 
        $('#license').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
            //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "socialwork_license.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.swlicense').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
        })
	</script>
</html>