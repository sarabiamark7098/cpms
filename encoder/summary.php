<?php
	include('../php/class.user.php');
    $user = new User();

    //$result = mysqli_query($user->db, $query);
	if((!$_SESSION['login']) && (!$_SESSION['userAccountusername'])	&& (!$_SESSION['userAccountpassword'])){
		header('Location:../index.php');
		}
	if($_SESSION['position'] != 'Encoder'){
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
        
        <style type="text/css">
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
        </style>
        <script type="text/javascript">
            $(function(){
              $("#tablenamo").dataTable();
            }) 
        
            window.onload = function() {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data : {page:1},
                    success:function(data){
                        $('#page_data').html(data);
                        //console.log(data);
                    } 
                    })
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
                    <a href="home.php">Client's List<i style="float: right;font-size:25px" class="fa fa-child"></i> </a> 
                </li>
                <li>
                    <a href="UnservedClient.php">Unserved List <i style="float: right;font-size:25px" class="fa fa-child"></i></a>
                </li>
                <li>
                    <a href="ProviderPage.php">Providers <i style="float: right;font-size:25px" class="fa fa-handshake"></i></a>
                </li>
                <li>
                    <a href="summary.php">Summary <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
                </li>
                <!-- <li>
                    <a href="import_page.php">Import <i style="float: right;font-size:25px" class="fa fa-upload"></i></a>
                </li> -->
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
            <h4>Summary</h4> <br>
                <div class="table-responsive-lg" id="page_data">
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
                url: "summary.php",
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
        
        function prev(page){  
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data : {page:page},
                    success:function(data){
                        $('#page_data').html(data);
                    } 
                })
        }

        function next(page){
      
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data : {page:page},
                    success:function(data){
                        $('#page_data').html(data);
                    } 
                })
        }
    </script>
</html>