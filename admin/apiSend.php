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
<title>DSWD - API Send</title>
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

        <link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
		<script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

        <style type="text/css">
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
			.badge-sent { background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; }
			.badge-unsent { background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px; }
        </style>
		<script>
			$(function(){
				$("#apiSendTable").dataTable();
			})
		</script>
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
            <div class="container-fluid" style="padding-left: 5%">
                <div class="table-responsive-lg">
                    <h5>Medical Assistance - API Send</h5>
                    <div class="row" style="padding-bottom: 20px; padding-top: 10px;">
                        <div class="col-lg-3">
                            <button id="btnSendUnsent" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i> Send Unsent Records
                            </button>
                        </div>
                        <div class="col-lg-6">
                            <div id="apiResult" style="display:none;" class="alert" role="alert"></div>
                        </div>
                    </div>
                    <table id="apiSendTable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                            <th scope="col">Trans ID</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Beneficiary Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Mode</th>
                            <th scope="col">Date Accomplished</th>
                            <th scope="col" style="width: 10%">API Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $medicalRecords = $user->getMedicalAssistanceForApi();
                            if($medicalRecords){
                                foreach($medicalRecords as $index => $value){
                                    $dateacc = !empty($value['date_accomplished']) ? date('F j, Y', strtotime($value['date_accomplished'])) : '';
                                    $statusBadge = ($value['api_status'] == 'Sent')
                                        ? "<span class='badge-sent'>Sent</span>"
                                        : "<span class='badge-unsent'>Unsent</span>";
                                    $clientName = $value['lastname'] . ", " . $value['firstname'] . " " . $value['middlename'];
                                    $beneName = !empty($value['b_lname'])
                                        ? $value['b_lname'] . ", " . $value['b_fname'] . " " . $value['b_mname']
                                        : $value['lastname'] . ", " . $value['firstname'] . " " . $value['middlename'];
                                    echo "<tr>
                                        <td>" . $value['trans_id'] . "</td>
                                        <td>" . $clientName . "</td>
                                        <td>" . $beneName . "</td>
                                        <td>Medical</td>
                                        <td>" . $value['amount'] . "</td>
                                        <td>" . $value['mode'] . "</td>
                                        <td>" . $dateacc . "</td>
                                        <td style='width: 10%'>" . $statusBadge . "</td>
                                    </tr>";
                                }
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

    <script type="text/javascript">
        $(document).ready(function(){
            $('#btnSendUnsent').on('click', function(){
                var btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Sending...');
                $('#apiResult').hide();

                $.ajax({
                    type: "POST",
                    url: "api_fetch.php",
                    data: { send_unsent_medical: true },
                    dataType: "json",
                    success: function(response){
                        var alertClass = 'alert-success';
                        if(response.status === 'error'){
                            alertClass = 'alert-danger';
                        } else if(response.status === 'info'){
                            alertClass = 'alert-info';
                        }
                        $('#apiResult')
                            .removeClass('alert-success alert-danger alert-info')
                            .addClass(alertClass)
                            .html(response.message)
                            .show();

                        btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send Unsent Records');

                        if(response.status === 'success'){
                            setTimeout(function(){
                                location.reload();
                            }, 2000);
                        }
                    },
                    error: function(xhr, status, error){
                        $('#apiResult')
                            .removeClass('alert-success alert-info')
                            .addClass('alert-danger')
                            .html('AJAX Error: ' + error)
                            .show();
                        btn.prop('disabled', false).html('<i class="fa fa-paper-plane"></i> Send Unsent Records');
                    }
                });
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
        $('#userAccount').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var userid = button.data('id')
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
		  var button = $(event.relatedTarget)
		  var modal = $(this);
          var dataString = 'id=logout';
            $.ajax({
                type: "GET",
                url: "apiSend.php",
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
</html>
