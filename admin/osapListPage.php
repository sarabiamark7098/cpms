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
	
    if(!$_SESSION['login']){
        header('Location:../index.php');
    }
    
    if(!empty($_POST["d_1"]) && !empty($_POST["d_2"]) && !empty($_POST['emp'])){
        $date1 = $_POST["d_1"]." 00:00:00";
        $datetoconv = $_POST["d_2"]." 00:00:00";
        $datetoconv2 = strtotime($datetoconv);
        $date2 = date('Y-m-d H:i:s', strtotime('+ 1 days', $datetoconv2));
        $emp = $_POST['emp'];
        $numrows = $user->getClientAndEmpSetNumforOsap($emp, $date1, $date2);
    }else{
        $numrows = 0;
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
			$("#admintable").dataTable({
                responsive: {
                    breakpoints: [
                    {name: 'bigdesktop', width: Infinity},
                    {name: 'meddesktop', width: 1480},
                    {name: 'smalldesktop', width: 1280},
                    {name: 'medium', width: 1188},
                    {name: 'tabletl', width: 1024},
                    {name: 'btwtabllandp', width: 848},
                    {name: 'tabletp', width: 768},
                    {name: 'mobilel', width: 480},
                    {name: 'mobilep', width: 320}
                    ]
                }
            });
		  })
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
                    <a href="home.php">Providers<i style="float: right;font-size:25px" class="fa fa-handshake"></i> </a> 
                </li>
                <li>
                    <a href="Employee.php">Employees <i style="float: right;font-size:25px" class="fa fa-users"></i></a>
                </li>
                <li>
                    <a href="SignatoryPage.php">Signatory List <i style="float: right;font-size:25px" class="fa fa-venus-mars"></i></a>
                </li>
                <li>
                    <a href="GISassessment.php">GIS Assessment <i style="float: right;font-size:25px" class="fa fa-cube"></i></a>
                </li>
                <li>
                    <a href="OfficePage.php">Offices<i style="float: right;font-size:25px" class="fa fa-building"></i></a>
                </li>
                <li>
                    <a href="reissue_log.php">Re-issue Logs <i style="float: right;font-size:25px" class="fa fa-cube"></i></a>
                </li>
                <li>
                    <a href="fundsource.php">Fund Source <i style="float: right;font-size:25px" class="fa fa-cube"></i></a>
                </li>
                <li>
                    <a href="summarylist.php">Summary List <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <li>
                    <a href="cancelledGl_logs.php">Cancelled GL Logs <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
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
					<!-- <a class="nav-link toggle tohover" data-target="#AddProvider" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add Provider<a> -->
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
            <div class="container-fluid"  style="padding-left: 5%">
                <div class="table-responsive-lg">
					<h5>Created OSAP List</h5>
                    <form class="form-group" action="osapListPage.php" method="POST">
                        <div class="row" style="padding-bottom: 40px;">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-1" style="padding-top: 10px;"><p style="font-size: 14px;">Total Client:<p></div>
                            <div class="col-lg-1"><input id="counttotalclient" class="form-control border border-dark text-center" style="width:120%;margin-left:-30px;" disabled placeholder="0"></div>
                            <div class="col-lg-5"></div>
                        </div>
                        <div class="row" style="padding-bottom: 20px;">

                            <div class="col-lg-1"></div>
                            <div class="col-lg-2">Employee:
                                <select id="emp" name="emp" class="form-control border border-primary" type="text" required>
                                    <option value="">Select Employee</option>
                                    <?php 
                                        $encoder = $user->encoderosaplist();
                                        if (!empty($encoder)) {
                                            foreach ($encoder as $index => $value) {
                                                echo '<option value="'.$value['empid'].'">'.$user->getEncoder($value['empid']).'</option>';
                                            }
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2">From:<input id="d_1" name="d_1" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-2">To:<input id="d_2" name="d_2" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-1"><br><button class="btn btn-outline-primary text-center" type="submit">Submit<button></div>
                            <div class="col-lg-1"></div>
                        </div>
                    </form>
					<table id="admintable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
						<thead>
							<tr>
							<th scope="col" style='width: 18%'>Transaction ID</th>
							<th scope="col">Beneficiary</th>
							<th scope="col">Client</th>
							<th scope="col">Signatory</th>
							<th scope="col">Encoder</th>
							<th scope="col" style="width: 15%">OSAP Created</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            if (!empty($emp) && !empty($date1) && !empty($date2)) {
                                $get = $user->getClientAndEmpSetforOsap($emp, $date1, $date2);
                                if ($get) {
                                    foreach ($get as $index => $value) {
                                        $dateaccomplished = date('F j, Y g:i A', strtotime($value['osap_created']));
                                        $sign_name = explode('-', $value['signatory']);
                                        echo "<tr>
                                        <td scope='row' style='width: 18%'>" . $value["trans_id"]. "</td> 
                                        <td>" . $value["lastname"] .", ". $value["firstname"] ." ". $value["middlename"] ." ". (!empty($value["extraname"])?$value["extraname"]:"") ."</td>
                                        <td>";
                                        if (!empty($value['b_lname'])) {
                                            echo $value["b_lname"] .", ". $value["b_fname"] ." ". $value["b_mname"] ." ". (!empty($value["b_exname"])?$value["b_exname"]:"");
                                        } else {
                                            echo $value["lastname"] .", ". $value["firstname"] ." ". $value["middlename"] ." ". (!empty($value["extraname"])?$value["extraname"]:"");
                                        }
                                        echo "</td>
                                        <td>" . $sign_name[0] . "</td>
                                        <td>" . $user->getEncoder($value["empid"]) . "</td>
                                        <td style='width: 15%'>". $dateaccomplished ."</td>
                                        </tr>
                                    ";
                                    }
                                } else {
                                    echo "NO DATA";
                                }
                            } else {
                                    echo "<div class='container-fluid'><h4 class='text-center'><b class='text-danger'>Need to Submit Employee and Date Ranges to show Created OSAP data's</b></h4></div>";
                                }
                            echo '<script>
                                document.getElementById("counttotalclient").value = "'.$numrows.'";
                            </script>';
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
            //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "adminuserAccount.php",
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
    </script>

</html>