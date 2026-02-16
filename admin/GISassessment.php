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
				echo "<script>window.location='index.php';</script>";
		}
	}
	
	if(isset($_POST['Add'])) {
		
		$ass_opt = mysqli_real_escape_string($user->db,($_POST['assopt']));
		$prob_pre = mysqli_real_escape_string($user->db,($_POST['prob_pre']));
		$swass = mysqli_real_escape_string($user->db,($_POST['swass']));
		
		$result = $user->addassessment($ass_opt, $prob_pre, $swass);
		
		if($result == "success"){
			echo "<script>alert('Successfully Adding Assessment Option!');</script>";
			echo "<script>window.location='GISassessment.php';</script>";
			echo "<meta http-equiv='refresh' content='0'>";
		}elseif($result == "exists"){
            echo "<script>alert('Assessment Option Already Exist!');</script>";
            echo "<script>window.location='GISassessment.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
			echo "<script>alert('Error Adding Assessment Option!');</script>";
			echo "<script>window.location='GISassessment.php';</script>";
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
<title>DSWD - CPMS</title>
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
                    <a class="nav-link toggle tohover" data-id="<?php echo $_SESSION['userId'];?>" data-target="#userAccount" data-toggle="modal" aria-haspopup="true" aria-expanded="false">
                        <?php $name = explode(' ',$_SESSION['userfullname']); $namef=strtoupper($name[0]); echo $namef;?>
						</a>
					<a class="nav-link toggle tohover" data-target="#AddAss" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add Assessment Option<a>
						
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
            <div class="container-fluid"  style="padding-left: 5%">
                <div class="table-responsive-lg">
					<h5>List of Assessment Option</h5>
					<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
						<thead>
							<tr>
							<th scope="col">Assessment Option</th>
							<th scope="col" style="width: 30%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $getuser = $user->get_ass_opt_to_admin_table();
                            if($getuser){
                                foreach($getuser as $index => $value){
                                echo "<tr>
                                            <td scope='row'>" . $value["ass_opt"]. "</td> 
                                            <td style='width: 30%'>
                                            <button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["ass_opt"]. "' style='margin-right: 10px;' data-target='#assInfo'> View </button>
                                            <button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["ass_opt"]. "' style='margin-right: 10px;' data-target='#Updateass'> Update </button>
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
	<div class="modal fade in" id="userAccount" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalLabel">User Account</h5>
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

    <script>
        $('#logoutmodal').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=logout';
            $.ajax({
                type: "GET",
                url: "GISassessment.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.logoutbody');
                },
                error: function(err) {
                }
            });  
        })
    </script>
<div class="modal hide fade" id="assInfo" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Show Assessment</h5>
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

     <div class="modal hide fade" id="Updateass" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Update Assessment</h5>
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
$('#assInfo').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
 
            $.ajax({
                type: "GET",
                url: "ShowAssessment.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.Viewbody').html(data);
                },
                error: function(err) {
                }
				
            });  
			
    })
$('#Updateass').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
 
            $.ajax({
                type: "GET",
                url: "UpdateAssessment.php",
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

<!-- Modal for Updating Information of Provider -->

     <div class="modal hide fade" id="AddAss" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add Assessment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Addbody">
				  
				</div>
			</div>	
		</div>
	</div>
    <script type="text/javascript">
		$('#AddAss').appendTo("body").on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var modal = $(this);
			var dataString = 'New Data';
			$.ajax({
					type: "GET",
					url: "addAssessment.php",
					data: dataString,
					cache: false,
					success: function (data) {
							modal.find('.Addbody').html(data);
					},
					error: function(err) {
					}
	
			});  
		})
	</script>
</html>