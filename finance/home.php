<?php
	include('../php/class.user.php');
    require_once("../php/session_timeout.php");
    $user = new User();
?>
<?php
	if((!$_SESSION['login']) && (!$_SESSION['userAccountusername'])	&& (!$_SESSION['userAccountpassword'])){
		header('Location:../index.php');
		}
	if($_SESSION['position'] != 'Finance'){
		switch ($_SESSION['position']){
			case 'Encoder': header("Location: ../encoder/home.php");
							break;
			case 'Social Worker': header("Location: ../socialwork/home.php");
							break;
			case 'Admin': header("Location: ../admin/home.php");
							break;
			case 'Program Head': header("Location: ../programhead/home.php");
							break;
			default:
				echo "<script>window.location='index.php';</script>";
		}
    }
?>

<!DOCTYPE html>
<html>

<head>
<title>DSWD HOME</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="UTF-8">
		<link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/table.responsive.css">
        <link rel="stylesheet" type="text/css" href="../style5.css">
		<link rel="stylesheet" type="text/css" href="../css/finance.css?v=2">
		<link rel="stylesheet" type="text/css" href="../css/all.css">

        <script defer src="../js/solid.js"></script>
        <script defer src="../js/fontawesome.js"></script>
        <script src="../js/jquery.slim.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
        <script type="text/javascript" src="../js/main.js"></script>
        <script type="text/javascript" src="../js/PSGC.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.mask.min.js"></script>
        <script type="text/javascript" src="../js/jquery.inputmask.min.js"></script>

        <!-- added -->

        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>

		<style type="text/css">
			:required  {
				 background: url(../images/icons/asterisk.png) no-repeat;
				 background-position:left top;
			}
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}

            #search_text:disabled {
                background-color: #e9ecef;
                cursor: not-allowed;
                border-color: #d1d1d1;
            }
        </style>
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
                    <a href="Dashboard.php">Dashboard <i style="float: right;font-size:25px" class="fa fa-chart-bar"></i></a>
                </li>
                <li>
                    <a href="home.php">List of Served Clients<i style="float: right;font-size:25px" class="fa fa-child"></i> </a>
                </li>
                <li>
                    <a href="ProviderPage.php">Providers <i style="float: right;font-size:25px" class="fa fa-handshake"></i></a>
                </li>
                <li>
                    <a href="OfficePage.php">Offices <i style="float: right;font-size:25px" class="fa fa-building"></i></a>
                </li>
                <li>
                    <a href="fundsource.php">Fund Source <i style="float: right;font-size:25px" class="fa fa-coins"></i></a>
                </li>
                <li>
                    <a href="reissue_log.php">Re-issue Logs <i style="float: right;font-size:25px" class="fa fa-clone"></i></a>
                </li>
                <li>
                    <a href="cancelledGL_logs.php">Cancelled GL Logs <i style="float: right;font-size:25px" class="fa fa-ban"></i></a>
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
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto tohover" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <h5>List of Served Clients</h5>

                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control border border-black" type="text" name="search_text" id="search_text" placeholder="Search"></input>
                        </div>
                    </div>
                    <?php $getclient = $user->showdataServed();
                    if(mysqli_num_rows($getclient) > 0 ){
                        echo "<tr><h5 class='text-success text-center'>Search to Show data</h5></tr>";
                    } else {
                        echo "<h5 class='text-danger text-center'>NO DATA</h5></>";
                    }?>
                    <div>
                    <!-- Suggestions will be displayed in below div. -->
                    <table class="table table-fixed table-striped table-hover highlight responsive-table border-left border-bottom" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Beneficiary Name</th>
                                <th>Date Completed</th>
                                <th>Remaining Days</th>
                                <th>Service</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="search_result">
                        </tbody>
                    </table>

                    <script>
                        // Custom debounce function
                        function debounce(func, wait) {
                            let timeout;
                            return function () {
                                const context = this;
                                const args = arguments;
                                clearTimeout(timeout);
                                timeout = setTimeout(function () {
                                    func.apply(context, args);
                                }, wait);
                            };
                        }

                        $(document).ready(function () {
                            let isSearching = false;

                            const debouncedSearch = debounce(function () {
                                var txt = $('#search_text').val();

                                if (txt !== '') {
                                    $.ajax({
                                        type: "post",
                                        url: "fetch.php",
                                        data: { search: txt },
                                        beforeSend: function() {
                                            $('#search_text').prop('disabled', true);
                                            $('body').css('cursor', 'progress');
                                        },
                                        success: function (html) {
                                            $('#search_result').html(html).show();
                                        },
                                        complete: function() {
                                            isSearching = false;
                                            $('#search_text').prop('disabled', false);
                                            $('body').css('cursor', 'default');

                                            $('#search_text').focus();
                                        }
                                    });
                                } else {
                                    $('#search_result').html("");
                                    isSearching = false;
                                }
                            }, 1000);

                            $('#search_text').on('keydown', function (e) {
                                if (e.key === 'Enter') {
                                    e.preventDefault();
                                    if (isSearching) return;

                                    isSearching = true;
                                    debouncedSearch();
                                }
                            });
                        });
                    </script>
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
<script src="../js/session_heartbeat.js"></script>
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
    </script>

		<!-- Modal for Full deatils of the client -->
     <div class="modal hide fade" id="clientdata" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="showClientData">
				</div>
			</div>
		</div>
	</div>
	<!-- Mag trigger sa modal na clentdata-->
<script type="text/javascript">
$('#clientdata').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
            $.ajax({
                type: "GET",
                url: "showClientData.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.showClientData').html(data);
                },
                error: function(err) {
                }
            });
    })
$(".clientdata").appendTo("body").on("hidden.bs.modal", function(){
    $(".showClientData").html("");
});
</script>
</html>
