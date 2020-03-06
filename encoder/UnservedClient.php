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
        
        
		<script>
		  $(function(){
			$("#coderdatatable").dataTable();
		  })
		</script>
		<style type="text/css">
			:required  {  
				 background: url(../images/icons/asterisk.png) no-repeat;
				 background-position:left top;
				}
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
		</style>

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
                    <h5>List of Clients</h5><br>
                    <table id="coderdatatable" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Beneficiary Name</th>
                                <th>Encoder</th>
                                <th>Full Details</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!isset($_REQUEST['buttonSearch'])){
                                $getclient = $user->showdataUnserved();
                                if(mysqli_num_rows($getclient)){
                                foreach($getclient as $index => $value){

                                    $getEncoder = $user->getEncoder($value['encoded_encoder']);
                                    echo "<tr class='danger' style='font-size: 15px;'>
                                            <td>". $value['lastname'] .", ". $value['firstname'] ." ". $value['middlename'] ." ". $value['extraname'] ."</td>
                                            <td>";
                                                    if($value['relation']!='Self'){
                                                        echo $value['b_lname'].", ".$value['b_fname']." ".$value['b_mname'];
                                                    }else{
                                                        echo $value['lastname'].", ".$value['firstname']." ".$value['middlename'];
                                                    }
                                                    
                                    echo "</td><td>". $getEncoder ."</td>
                                            <td>
                                            <button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#clientdata' data-id='". $value["trans_id"] ."' style='margin-right: 10px; width: 110px;'> View </button>
                                            <!--<button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#idcert' data-id='". $value["trans_id"] ."' style='margin-right: 10px; width: 110px; margin-top:5px;'> ID Cert </button>-->
                                            </td><td>";
                                            if($value['status_client'] == 'Pending') {
                                                echo "<h4 class='text-danger'><small>PENDING...</small></h4>";
                                            } elseif($value['status_client'] == 'Serving') {
                                                echo "<h4 class='text-success'><small>Serving...</small></h4>";
                                            }
                                            echo "</td>
                                            
                                            </tr>";
                                    } 
                                } 
                            } else {
                                $searchdata = $_POST['searchdata'];
                                $getclient = $user->searchUnserved($searchdata);
                                if($getclient){
                                    foreach($getclient as $index => $value){
                                    $getEncoder = $user->getEncoder($value['encoded_encoder']);
                                    echo "<tr class='danger' style='font-size: 15px;'>
                                            <td>". $value['lastname'] .", ". $value['firstname'] ." ". $value['middlename'] ." ". $value['extraname'] ."</td>
                                            <td>";
                                                    if($value['relation']!='Self'){
                                                        echo $vlaue['b_lname'].", ".$value['b_fname']." ".$value['b_mname'];
                                                    }else{
                                                        echo $value['lastname'].", ".$value['firstname']." ".$value['middlename'];
                                                    }
                                                    
                                    echo "</td><td>". $getEncoder['fullname'] ."</td>
                                            <td>
                                            <button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#clientdata' data-id='". $value["client_id"] ."' style='margin-right: 10px; width: 110px;'> View </button>
                                            <!--<button type='submit' class='btn btn-outline-primary deep-sky' data-toggle='modal' data-target='#idcert' data-id='". $value["client_id"] ."' style='margin-right: 10px; width: 110px; margin-top:5px;'> for testing </button>-->
                                            </td><td>";
                                            if($value['status_client'] == 'Pending') {
                                                echo "<h4 class='text-danger'><small>PENDING...</small></h4>";
                                            } elseif($value['status_client'] == 'Serving') {
                                                echo "<h4 class='text-success'><small>Serving...</small></h4>";
                                            }
                                            echo "</td>
                                            
                                            </tr>";
                                    } 
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
                url: "UnservedClient.php",
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
	<div class="modal hide fade" id="idcert" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client's Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="idcertbody">
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
            //console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "showClientData.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.showClientData').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
        })
        $('#idcert').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
            //console.log(dataString);
                $.ajax({
                    type: "GET",
                    //  url: "idcertmodal.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        modal.find('.idcertbody').html(data);
                    },
                    error: function(err) {
                        //console.log(err);
                    }
                });  
        })
            $(document).ready(function(){
                $('#client_city').keyup(function(){  //On pressing a key on "Search box". This function will be called
                    var txt = $('#client_city').val(); //Assigning search box value to javascript variable.
                    if(txt != ''){ //Validating, if "name" is empty.
                        $.ajax({
                            type: "post", //method to use
                            url: "district.php", //ginapasa  sa diri nga file and data
                            data: {search:txt}, //mao ni nga data
                            success: function(html){  //If result found, this funtion will be call
                                var json = JSON.parse(html);
                                $('#client_district').val( json["Client_district"]);
                            }
                        });
                    }else{
                    $('#search_result').html(""); 
                    }
                });
            });
            $(document).ready(function(){
                $('#beneficiary_city').keyup(function(){  //On pressing a key on "Search box". This function will be called
                    var txt = $('#beneficiary_city').val(); //Assigning search box value to javascript variable.
                    if(txt != ''){ //Validating, if "name" is empty.
                        $.ajax({
                            type: "post", //method to use
                            url: "district.php", //ginapasa  sa diri nga file and data
                            data: {search:txt}, //mao ni nga data
                            success: function(html){  //If result found, this funtion will be call
                                var json = JSON.parse(html);
                                $('#beneficiary_district').val( json["Client_district"]);
                            }
                        });
                    }else{
                    $('#search_result').html(""); 
                    }
                });
            });
    </script>


    <script type="text/javascript">
        function re_print(id){
            window.location.href = "reprint.php?id=" + id;
        }
    </script>
</html>