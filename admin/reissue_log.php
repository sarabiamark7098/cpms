<?php
     include('../php/class.user.php');
     $user = new User();

    if(isset($_POST)){
        $location = "export-data.php?";
        if(isset($_POST['month'])){$location.= "m=". $user->getMonth($_POST['month']);} //month
        $location .="&";
        if(isset($_POST['year'])){$location.= "y=".$_POST['year'];} //year   
    }
    
	if(!$_SESSION['login']){
		header('Location:../index.php');
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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Re-issue log</title>

    
    <link rel="icon" type="image/png" href="../images/icons/ciu.ico"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../style5.css">
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
       window.onload = function() {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data : {page:1},
                success:function(data){
                    $('#page_data').html(data);
                }
                })
            }
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
                <h5>List of Clients Reissued</h5>
                
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control border border-black" type="text" name="search_text" id="search_text" placeholder="Search"></input>
                        </div>
                    </div>
                    <?php $getclient = $user->showdataServed_reissued();
                    if(mysqli_num_rows($getclient) > 0){
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
                                <th>Date Re-issued</th>
                                <th>Re-issued by</th>
                            </tr>
                        </thead> 
                        <tbody id="search_result">
                        </tbody>
                    </table>
                
                <script>
                    $(document).ready(function(){
                        var txt = $('#search_text').val();
                        //if empty show 10 latest data
                        if(txt == ''){
                            $.ajax({
                                type: "post", //method to use
                                url: "fetch.php", //ginapasa  sa diri nga file and data
                                data: {search_client:txt}, //mao ni nga data
                                success: function(html){  //If result found, this funtion will be called.
                                    $('#search_result').html(html).show();  //Assigning result to "#result" div.
                                }
                            });
                        }
                        //if naa nay value
                        $('#search_text').keyup(function(){  //On pressing a key on "Search box". This function will be called
                            var txt = $('#search_text').val(); //Assigning search box value to javascript variable.
                            if(txt != ''){ //Validating, if "name" is empty.
                                $.ajax({
                                    type: "post", //method to use
                                    url: "fetch.php", //ginapasa  sa diri nga file and data
                                    data: {search_client:txt}, //mao ni nga data
                                    success: function(html){  //If result found, this funtion will be called.
                                        $('#search_result').html(html).show();  //Assigning result to "#result" div.
                                    }
                                });
                            }else{
                                $('#search_result').html(""); //Assigning no result to "result" div.
                                
                            }
                        });
                    });
                </script>
            </div>
            </div>
        </div>
    </body>
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
</html>