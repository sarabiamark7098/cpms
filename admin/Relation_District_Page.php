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
          $(function(){
			$("#admintable2").dataTable();
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
                    <a class="nav-link toggle tohover" data-target="#Adddistrict" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add District<a>
					<a class="nav-link toggle tohover" data-target="#Addrelation" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add Relation<a>
						
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
                <div class="table-responsive-lg" style="float:right; width: 48%;">
					<h5>Relation List</h5>
					<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
						<thead>
							<tr>
							<th scope="col">Relation</th>
							<th scope="col" style="width: 30%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$getuser = $user->getrelationshiplist();
                                if($getuser){
									foreach($getuser as $index => $value){
                                        
									    echo "<tr>
												<td scope='row'>" . $value["relation"] . "</td> 
												<td style='width: 30%'>
												<button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["r_id"]. "' style='margin-right: 10px;' data-target='#Updateass'> Update </button>
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
                
                <div class="table-responsive-lg" style="width: 48%; float: left">
                    <h5>District List</h5>
                    <table id="admintable2" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                            <th scope="col">District Name</th>
                            <th scope="col" style="width: 30%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getdist = $user->getdistrictlist();
                                if($getdist){
                                    foreach($getdist as $index => $value){
                                    echo "<tr>
                                                <td scope='row'>" . $value["district_name"] ." </td>
                                                <td scope='row' style='width: 30%'>
                                                <button type='button' name='view' class='btn btn-primary deep-sky' data-toggle='modal' data-id='" . $value["d_id"]. "' style='margin-right: 10px;' data-target='#UpdateEmployee'> Update </button>
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

    <!-- Modal for Adding Relation -->

    <div class="modal hide fade" id="Addrelation" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add Relation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Addbody">
                    <form action="Relation_District_Page.php" method="post">
                        <div class="modal-body">
                            <div class="row form-group" style="margin-top: 2%; height:10%;">
                                <div class="form-group col-lg-12">
                                    <input placeholder="Relationship" id="relation" name="relation" style="text-transform: uppercase" type="text" class="form-control">
                                    <label class="active" for="relation">Relationship</label>
                                </div>
                            </div>
                                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="Add">Save</button>
                        </div>
                    </form>
				</div>
			</div>	
		</div>
	</div>
    <div class="modal hide fade" id="Adddistrict" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Add District</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="Addbody">
                    <form action="Relation_District_Page.php" method="post">
                        <div class="modal-body">
                            <div class="row form-group" style="margin-top: 2%; height:10%;">
                                <div class="form-group col-lg-12">
                                    <input placeholder="District" id="district" name="district" style="text-transform: uppercase" type="text" class="form-control">
                                    <label class="active" for="relation">District</label>
                                </div>
                            </div>
                                    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="Add">Save</button>
                        </div>
                    </form>
				</div>
			</div>	
		</div>
	</div>
    <script>
        $('#Addrelation').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=relation';
            $.ajax({
                type: "GET",
                url: "Relation_District_Page.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.Addbody');
                },
                error: function(err) {
                }
            });
        })
        $('#Adddistrict').appendTo("body").on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var modal = $(this);
          var dataString = 'id=district';
            $.ajax({
                type: "GET",
                url: "Relation_District_Page.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.Addbody');
                },
                error: function(err) {
                }
            });  
        })
    </script>
    
</html>