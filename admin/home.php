<?php
	include("../php/class.user.php");
	$user = new User();
	
	if(!$_SESSION['login']){
		header('location:../index.php');
		}
	if($_SESSION['position'] != 'Admin'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php");
							break;
			case 'Social Worker': header("Location: ../socialwork/home.php");
							break;
			case 'Admin': header("Location: ../admin/home.php");
							break;
			default:
				echo "<script>window.location='../index.php';</script>";
		}
	}
	
	$dup_number = $user->no_dup();
                            
	if(isset($_POST['Add'])) {
		
		$addresseename = $_POST['addresseename'];
		$addresseeposition = $_POST['addresseeposition'];
		$addresseetomention = $_POST['addresseetomention'];
		$addcname = $_POST['companyname'];
		$addcaddress = $_POST['companyaddress'];
		
        $result = $user->addCompany($addresseename, $addresseeposition, $addresseetomention, $addcname, $addcaddress);
		
		if($result == "success"){
			echo "<script>alert('Successfully Adding Company!');</script>";
			echo "<script>window.location='home.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
        elseif($result == "exists"){
            echo "<script>alert('Company Already Exist!');</script>";
            echo "<script>window.location='home.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
    	}else{
			echo "<script>alert('Error Adding Company!');</script>";
			echo "<script>window.location='home.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}
	}

	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>

<!DOCTYPE html>
<html>

<head>
<title>DSWD HOME</title>
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
		
        <script type="text/javascript" src="../js/jquery.inputmask.min.js"></script>
		<style>
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
		</style>
		<script>
		  $(function(){
			$("#admintable").dataTable();
		  })
		</script>
    </head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px" s>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="home.php">Providers<i style="float: right;font-size:25px" class="fa fa-handshake"></i> </a> 
                </li>
                <li>
                    <a href="OfficePage.php">Offices<i style="float: right;font-size:25px" class="fa fa-building"></i></a>
                </li>
                <li>
                    <a href="Employee.php">Employees <i style="float: right;font-size:25px" class="fa fa-users"></i></a>
                </li>
                <li>
                    <a href="SignatoryPage.php">Signatory List <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="GISassessment.php">GIS Assessment <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="fundsource.php">Fund Source <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="summarylist.php">Summary List <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="reissue_log.php">Re-issue Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="cancelledGL_logs.php">Cancelled GL Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="apiSend.php">API Send <i style="float: right;font-size:25px" class="fa fa-paper-plane"></i></a>
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
					<a class="nav-link toggle tohover" data-target="#AddProvider" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add Provider<a>
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
            <div class="container-fluid" style="padding-left: 5%">
                <div class="table-responsive-lg">
					<h5>List of Provider</h5>
					<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
						<thead>
							<tr>
							<th scope="col" style='width: 15%'>Company id</th>
							<th scope="col">Company Name</th>
							<th scope="col" style="width: 25%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $getuser = $user->get_provider_to_admin_table();
                            if($getuser){
                                foreach($getuser as $index => $value){
                                echo "<tr>
                                            <td scope='row' style='width: 15%'>" . $value["company_id"]. "</td> 
                                            <td>" . $value["company_name"] . "</td>
                                            <td style='width: 25%'>
                                            <button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["company_id"]. "' style='margin-right: 10px;' data-target='#ProviderInfo'> View </button>
                                            <button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["company_id"]. "' style='margin-right: 10px;' data-target='#UpdateProvider'> Update </button>
                                            </td>
                                            </tr>
                                            
                                        ";		
                                }
                            } else {
                                echo "NO DATA";
                            }
							?>
						</tbody>
					</table>
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
<div class="module">
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
</div>
</body>
    <script>
        //userAccount
        $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
                $.ajax({
                    type: "GET",
                    url: "adminuserAccount.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.useraccount').html(data);
                    },
                    error: function(err) {
                    }
                });  
        })
    </script>

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
	
    <div class="modal hide fade" id="clear" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header"><h4>Option <i class="fa fa-recycle"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>
            <div class="modal-body clearbody"><i class="fa fa-question-circle"></i> Are you sure you want to clear duplicate?<br>
				<label style="text-indent: 25px;"><?php echo $dup_number." Duplicate/s Found";?></label>
			
			</div>
            <div class="modal-footer"><a href="../php/cleardup.php" class="btn btn-primary btn-block">Clear Duplicate</a></div>
            </div>
        </div>
    </div>

    <script>
        $('#logoutmodal').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=logout';
            $.ajax({
                type: "GET",
                url: "home.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.logoutbody');
                },
                error: function(err) {
                }
            });
        })
        $('#clear').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=clear';
            $.ajax({
                type: "GET",
                url: "home.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.clearbody');
                },
                error: function(err) {
                }
            });  
        })
    </script>
	<!-- Modal for Viewing Information of Provider -->

	<div class="modal hide fade" id="ProviderInfo" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Show Provider's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Viewbody">
				</div>
			</div>	
		</div>
	</div>
	
<!-- Modal for Updating Information of Provider -->

     <div class="modal hide fade" id="UpdateProvider" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Provider's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Updatebody">
				</div>
			</div>	
		</div>
	</div>

    
    
<script type="text/javascript">
$('#ProviderInfo').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
 
            $.ajax({
                type: "GET",
                url: "ShowProvider.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.Viewbody').html(data);
                },
                error: function(err) {
                }
				
            });  
			
    })
	
$('#UpdateProvider').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
 
            $.ajax({
                type: "GET",
                url: "UpdateProvider.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.Updatebody').html(data);
                },
                error: function(err) {
                }
				
            });  
    })
</script>

<!-- Modal for adding Information of Provider -->

    <div class="modal hide fade" id="AddProvider" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Provider's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Addbody">
				  
				</div>
			</div>	
		</div>
	</div>
	<script>
        $('#AddProvider').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var modal = $(this);
            var dataString = 'New Data';
    
                $.ajax({
                    type: "GET",
                    url: "addCompany.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        modal.find('.Addbody').html(data);
                    },
                    error: function(err) {
                    }
                    
                });  
        });
        $(document).ready(function () {
            $(".currencyMaskedInput").inputmask({
                alias: "currency",
                prefix: "",
                rightAlign: false,
                groupSeparator: ",",
                autoGroup: true,
                digits: 2,
                allowMinus: false
            });
        });
	</script>
</html>