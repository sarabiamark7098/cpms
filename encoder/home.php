<?php
	include('../php/class.user.php');
    $user = new User();
?>
<?php
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
				echo "<script>window.location='index.php';</script>";
		}
    }
?>
<?php
    if(!isset($_POST['wbeneficiary'])){
		if(isset($_POST['addClient'])){
            // print_r($_POST);
			//client the one that process the transaction
			$fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['firstname'])," "));
			$mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['middlename'])," "));
			$lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['lastname'])," "));
			$exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['extraname']), " "));
			$sex = mysqli_real_escape_string($user->db,$_POST['sex']);
			$bday = $_POST['birthday'];
			$age = $_POST['age'];
			$occupation = mysqli_real_escape_string($user->db,$_POST['occupation']);
			if($_POST['salary'] != ''){
				$salary= $_POST['salary'];
			}else{
				$salary = '0';
			}
            if($_POST['pantawid_y']){
                $pantawid = "Yes";
            }elseif($_POST['pantawid_n']){
                $pantawid = "No";
            }
			$category = mysqli_real_escape_string($user->db,$_POST['category']);
			$civilStatus = mysqli_real_escape_string($user->db,$_POST['civilstatus']);
			$contact = mysqli_real_escape_string($user->db,$_POST['contact']);
			
			$region = mysqli_real_escape_string($user->db,$_POST['regions']);
			$province = mysqli_real_escape_string($user->db,$_POST['province']);
			$city_mun = mysqli_real_escape_string($user->db,$_POST['city']);
			$barangay = mysqli_real_escape_string($user->db,$_POST['barangay']);
			$district = mysqli_real_escape_string($user->db,$_POST['district']);
			$street= mysqli_real_escape_string($user->db,$_POST['street']);
            if($age > 17){
                $execute = $user->insertClient($fname, $mname, $lname, $exname, $sex, $bday, $age, $occupation, $salary, $category, $pantawid, $civilStatus, $contact, $region, $province, $city_mun, $barangay, $district, $street);
            }
            else {
                $dedup = $user->cleardup();
				echo "<script>alert('Error! Minor Client');</script>";
                echo "<script>window.location='home.php';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
            }
            if($execute){
                $dedup = $user->cleardup();
				echo "<script>alert('Client Successfully Added!');</script>";
                echo "<script>window.location='picture.php?id=".$execute."';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
			else{
                $dedup = $user->cleardup();
				echo "<script>alert('Sorry Error uploading!');</script>";
                echo "<script>window.location='home.php';</script>";
				echo "<meta http-equiv='refresh' content='0'>";
			}
		}
	}
	else{
		if(isset($_POST['addClient'])){
            
            //client the one that process the transaction
            $fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['firstname']), " "));
            $mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['middlename']), " "));
            $lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['lastname']), " "));
            $exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['extraname']), " "));
            $sex = mysqli_real_escape_string($user->db,$_POST['sex']);
            $bday = $_POST['birthday'];
			$age = $_POST['age'];
            $occupation = mysqli_real_escape_string($user->db,strtoupper($_POST['occupation']));
            if($_POST['salary'] != ''){
                $salary= $_POST['salary'];
            }else{
                $salary = '0';
            }
            if($_POST['pantawid_y']){
                $pantawid = "Yes";
            }elseif($_POST['pantawid_n']){
                $pantawid = "No";
            }
            $category = mysqli_real_escape_string($user->db,$_POST['category']);
            $civilStatus = mysqli_real_escape_string($user->db,$_POST['civilstatus']);
            $contact = mysqli_real_escape_string($user->db,$_POST['contact']);
            $region = mysqli_real_escape_string($user->db,$_POST['regions']);
            $province = mysqli_real_escape_string($user->db,$_POST['province']);
            $city_mun = mysqli_real_escape_string($user->db,$_POST['city']);
            $barangay = mysqli_real_escape_string($user->db,$_POST['barangay']);
            $district = mysqli_real_escape_string($user->db,$_POST['district']);
            $street= mysqli_real_escape_string($user->db,$_POST['street']);
        
            // beneficiary
            $relationship = mysqli_real_escape_string($user->db,$_POST['relation']);
            $b_fname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['b_fname']), " "));
            $b_mname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['b_mname']), " "));
            $b_lname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['b_lname']), " "));
            $b_exname = mysqli_real_escape_string($user->db, trim(strtoupper($_POST['b_exname']), " "));
            $b_bday = $_POST['b_bday'];
			// $b_age = $user->getAge($b_bday);
            $b_occupation = mysqli_real_escape_string($user->db,strtoupper($_POST['b_occupation']));
            if($_POST['b_salary'] != ''){
                $b_salary= $_POST['b_salary'];
            }else{
                $b_salary = '0';
            }
            $b_sex = mysqli_real_escape_string($user->db,$_POST['b_sex']);
            $b_civilStatus = mysqli_real_escape_string($user->db,$_POST['b_cstatus']);
            $b_contact = mysqli_real_escape_string($user->db,$_POST['b_contact']);
            $b_category = mysqli_real_escape_string($user->db,$_POST['b_category']);
            $b_region = mysqli_real_escape_string($user->db,$_POST['b_region']);
            $b_province = mysqli_real_escape_string($user->db,$_POST['b_province']);
            $b_city_mun = mysqli_real_escape_string($user->db,$_POST['b_city']);
            $b_district = mysqli_real_escape_string($user->db,$_POST['b_district']);
            $b_barangay = mysqli_real_escape_string($user->db,$_POST['b_barangay']);
            $b_street = mysqli_real_escape_string($user->db,$_POST['b_street']);
            
            if($age > 17){
                $execute = $user->insertClientWB($fname, $mname, $lname, $exname, $sex, $bday, $occupation, $salary, $category, $pantawid, $civilStatus, $contact, $region, 
                $province, $city_mun, $barangay, $district, $street, $relationship, $b_fname, $b_mname, $b_lname, $b_exname, $b_bday, $b_sex, $b_civilStatus, $b_contact, 
                $b_occupation, $b_salary, $b_category, $b_region, $b_province, $b_city_mun, $b_district, $b_barangay, $b_street);
            }
            else{
                $dedup = $user->cleardup();
                echo "<script>alert('Error! Minor Client');</script>";
                echo "<script>window.location='home.php';</script>";
                echo "<meta http-equiv='refresh' content='0'>";
            }
        
    		if($execute){
                $dedup = $user->cleardup();
    			echo "<script>alert('Client Successfully Added!');</script>";
                echo "<script>window.location='picture.php?id=".$execute."';</script>";
    			echo "<meta http-equiv='refresh' content='0'>";
    		}
    		else{
                $dedup = $user->cleardup();
    			echo "<script>alert('Sorry Error uploading!');</script>";
                echo "<script>window.location='home.php';</script>";
    			echo "<meta http-equiv='refresh' content='0'>";
    		}
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
                    <a class="nav-link toggle tohover" data-target="#addClient" data-toggle="modal" aria-haspopup="true" style="border-left: solid 4px gray" aria-expanded="false">Add Client</a>
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
                <h5>List of Clients</h5>
                
                    <div class="form-group">
                        <div class="input-group">
                            <input class="form-control border border-black" type="text" name="search_text" id="search_text" placeholder="Search"></input>
                        </div>
                    </div>
                    <?php $getclient = $user->showdataServed();
							// $getimportclient = $user->showdataImported();
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
                                <th>Passing Action</th>
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
                            const debouncedSearch = debounce(function () {
                                var txt = $('#search_text').val();
                                if (txt !== '') {
                                    $.ajax({
                                        type: "post",
                                        url: "fetch.php",
                                        data: { search: txt },
                                        success: function (html) {
                                            $('#search_result').html(html).show();
                                        }
                                    });
                                } else {
                                    $('#search_result').html("");
                                }
                            }, 1000); 

                            $('#search_text').keyup(debouncedSearch);
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
    <div class="modal hide fade" id="cancelGL" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancellation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="cancelbody">
				</div>
			</div>	
		</div>
	</div>
    <div class="modal hide fade" id="passclient" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client To be Pass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="passClientData">
				</div>
			</div>	
		</div>
	</div>
		<!-- Modal for Passomg Client and Beneficiary Information -->
	<div class="modal hide fade" id="passwithbene" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client To be Pass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="passClientDatawithBene">
				</div>
			</div>	
		</div>
	</div>
    
		<!-- Modal for Passing Beneficiary into Client -->
	<div class="modal hide fade" id="passbenetoclient" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client To be Pass</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
				<div class="passBeneToClient">
				</div>
			</div>	
		</div>
	</div>
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
     <!-- Reissue Client-->
     <div class="modal fade bd-add-modal-lg" id="reissue" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reissuance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="proceedbody">

                    </div>
                </div>
            </div>
        </div>
        <!-- Reissue Client-->
     <div class="modal fade bd-add-modal-lg" id="reissueexpired" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reissuance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="proceedbodyexpired">

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
                    modal.find('.showClientData').html(data);
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
    })
$(".clientdata").appendTo("body").on("hidden.bs.modal", function(){
    $(".showClientData").html("");
});

//jscript pass Client
$('#cancelGL').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
		    // console.log(dataString);
            $.ajax({
                type: "GET",
                url: "cancelclientGL.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.cancelbody').html(data);
                },
                error: function(err) {
                    // console.log(err);
                }
            });  
    });

//jscript pass Client
$('#passclient').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
		    // console.log(dataString);
            $.ajax({
                type: "GET",
                url: "passclient.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.passClientData').html(data);
                },
                error: function(err) {
                    // console.log(err);
                }
            });  
    });
//jscript pass With Beneficiary
$('#passwithbene').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
		  //console.log(dataString);
            $.ajax({
                type: "GET",
                url: "passwithbene.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.passClientDatawithBene').html(data);
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
    })
//jscript pass With Beneficiary
        $('#passbenetoclient').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var userid = button.data('id') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + userid;
		  //console.log(dataString);
            $.ajax({
                type: "GET",
                url: "passbenetoclient.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('.passBeneToClient').html(data);
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
    });
		$(document).ready(function(){
             $('#client_city').keyup(function(){  //On pressing a key on "Search box". This function will be called
                var txt = $('#client_city').val(); //Assigning search box value to javascript variable.
				if(txt != ''){ //Validating, if "name" is empty.
                    $.ajax({
                        type: "post", //method to use
                        url: "district.php", //ginapasa  sa diri nga file and data
                        data: {municode:txt}, //mao ni nga data
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
                        type: "POST", //method to use
                        url: "district.php", //ginapasa  sa diri nga file and data
                        data: {municode:txt}, //mao ni nga data
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
        $('#reissue').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
            // console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "reissuemodal.php",
                    data: dataString,
                    success: function (data) {
                        modal.find('.proceedbody').html(data);
                    },
                    error: function(err) {
                        // console.log(err);
                    }
                });  
        });
        $('#reissueexpired').appendTo("body").on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var userid = button.data('id') // Extract info from data-* attributes
            var modal = $(this);
            var dataString = 'id=' + userid;
            // console.log(dataString);
                $.ajax({
                    type: "GET",
                    url: "reissuemodalexpired.php",
                    data: dataString,
                    success: function (data) {
                        modal.find('.proceedbodyexpired').html(data);
                    },
                    error: function(err) {
                        // console.log(err);
                    }
                });  
        });
</script>

<!-- AddClientData-->
        <div class="modal fade bd-add-modal-lg" id="addClient" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Please Fill-up Client Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="addclientbody"></div> 
                </div>
            </div>
        </div>
        


        <script type="text/javascript">
        $('#addClient').appendTo("body").on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var modal = $(this);
          var dataString = "New Data";
		  //console.log(dataString);
            $.ajax({
                type: "GET",
                url: "addClient.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    modal.find('#addclientbody').html(data);
                },
                error: function(err) {
                    //console.log(err);
                }
            });  
        })
        function re_print(id){
            window.location.href = "reprint.php?id=" + id;
        }
        function create_osap(id){
            window.location.href = "osap_page.php?id=" + id;
        }

        $(function () {
            $("#radiobutton2").click(function () {
                if ($("#radiobutton2").is(":checked")) {
                    $("#collapseOne").hide();
                } else {
                    $("#collapseOne").hide();
                }
            }); 
        });

        $(function () {
            $("#radiobutton").click(function () {
                if ($("#radiobutton").is(":checked")) {
                    $("#collapseOne").show();
                } else {
                    $("#collapseOne").hide();
                }
            });
        });
        
        $(function () {
            $("#radiobutton2").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton").not($(this)).each(function () {
                        $(this).removeAttr("checked");
                    })
                }
            })
        })

        $(function () {
            $("#radiobutton").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton2").not($(this)).each(function () {
                        $(this).removeAttr("required");
                    })
                }
            })
            $("#radiobutton2").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton").not($(this)).each(function () {
                        $(this).removeAttr("required");
                    })
                }
            })
        })

        $(function () {
            $("#radiobutton").click(function () {
                if ($(this).is(":checked")) {
                    // console.log("require");
                    $(".benerequire").attr('required', '');
                } else {
                    // console.log("wla na require");
                    $(".benerequire").removeAttr('required');
                }
            });
        });

        function copyaddressclient() {
            reg = document.getElementById('creg').value;
			prov = document.getElementById('cprov').value;
			muni = document.getElementById('client_city').value;
            brgy = document.getElementById('cbrgy').value;
            dist = document.getElementById('client_district').value;
            str = document.getElementById('cstr').value;
            // console.log(reg);console.log(prov);console.log(muni);console.log(brgy);console.log(dist);console.log(str);

			document.getElementById('breg').value = reg;
			document.getElementById('bprov').value = prov;
			document.getElementById('beneficiary_city').value = muni;
            document.getElementById('bbrgy').value = brgy;
            document.getElementById('beneficiary_district').value = dist;
            document.getElementById('bstr').value = str;
            
			get_b_Region_sw(reg);
			get_b_Province_sw(prov);
			get_b_Municipality_sw(muni);
			get_b_Barangay_sw(brgy);
		}

        </script>
</html>