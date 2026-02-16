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
        
        <style type="text/css">
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
        </style>
    </head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px" >
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
            <div class="container-fluid" style="padding-left: 5%" id="page_data">
                <div class="table-responsive-lg" >
                    <form class="form-group" action="cancelledGL_logs.php" method="POST">
                        <div class="row" style="padding-bottom: 40px;">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-1" style="padding-top: 10px;"><p style="font-size: 14px;">Total Client:<p></div>
                            <div class="col-lg-1"><input id="counttotalclient" class="form-control border border-dark text-center" style="width:120%;margin-left:-30px;" disabled placeholder="0"></div>
                            <div class="col-lg-5"></div>
                        </div>
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3"><input id="d_1" name="d_1" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3"><input id="d_2" name="d_2" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-1"><button class="btn btn-outline-primary text-center" type="submit">Submit<button></div>
                            <div class="col-lg-1"></div>
                        </div>
                    </form>
                    <table id="summarydtable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                            <th scope="col" style='width: 25%'>Client Name</th>
                            <th scope="col" style='width: 25%'>Beneficiary Name</th>
                            <th scope="col" style='width: 15%'>GL Cancelled Date</th>
                            <th scope="col" style='width: 20%'>Cancelled By</th>
                            <th scope="col" style='width: 15%'>Mode of Assistance</th>
                            <th scope="col" style='width: 15%'>Type of Assistance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $datenow = date("Y-m-d");
                            // $datenow2 = date("Y-m-d");
                            $datenow = strtotime($datenow);
                            $datenow2 = date('Y-m-d', strtotime('+ 1 days', $datenow));
                            $datenow = date("Y-m-d");
                            $d1 = "";
                            $d2 = "";
                            if (!empty($_POST['d_1'])){
                                $d1 = $_POST['d_1'];
                            }
                            if (!empty($_POST['d_2'])) {
                                $d2 = $_POST['d_2'];
                            }
                            $summarydt = $user->summaryDataTablecancelledGL($datenow, $datenow2, $d1, $d2);
                            $summarynumrows = $user->summaryGetNumRowscancelledGL($datenow, $datenow2, $d1, $d2);
                                if($summarydt){
                                    foreach($summarydt as $index => $value){
                                        if($summarynumrows > 0){
                                            $client_assistance = $user->getGISAssistance($value['trans_id']); //kuha sa data sa assistance table
                                            echo '<script>
                                                document.getElementById("counttotalclient").value = "'.$summarynumrows.'";
                                            </script>';
                                            echo "<tr>
                                                <td scope='row' style='width: 20%'>" . $value['lastname'] .", ". $value['firstname'] ." ". (!empty($value['middlename'][0])?$value['middlename'][0] .". ":"") . (!empty($value['extraname'])?$value['extraname']:"") . "</td> 
                                                <td scope='row' style='width: 20%'>". 
                                                (!empty($value['b_lname'])?$value['b_lname'] .", ". $value['b_fname'] ." ". (!empty($value['b_mname'][0])?$value['b_mname'][0] .". ":"") . (!empty($value['b_exname'])?$value['b_exname']:""):$value['lastname'] .", ". $value['firstname'] ." ". (!empty($value['middlename'][0])?$value['middlename'][0] .". ":"") . (!empty($value['extraname'])?$value['extraname']:""))
                                                ." </td>
                                                <td scope='row' style='width: 15%'>" . date('F j,Y', strtotime($value['date_cancelled'])) ." </td>
                                                <td scope='row' style='width: 20%'>" . $user->getEncoder($value['empid']) ." </td>
                                                <td scope='row' style='width: 10%'>" . $user->get_assistance_mode($value['trans_id']) ." </td>
                                                <td scope='row' style='width: 15%'>" . $client_assistance[1]['type'] ." </td>
                                                </td>
                                                </tr>
                                            ";
                                        }		
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
        $(function(){
			$("#summarydtable").dataTable();
		  })
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
                    url: "userAccount.php",
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
                url: "summary.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.logoutbody');
                },
                error: function(err) {
                }
            });  
        })
        
        // function prev(page){  
        //         $.ajax({
        //             url: "fetch.php",
        //             method: "POST",
        //             data : {page:page},
        //             success:function(data){
        //                 $('#page_data').html(data);
        //             } 
        //         })
        // }

        // function next(page){
      
        //         $.ajax({
        //             url: "fetch.php",
        //             method: "POST",
        //             data : {page:page},
        //             success:function(data){
        //                 $('#page_data').html(data);
        //             } 
        //         })
        // }
    </script>
</html>