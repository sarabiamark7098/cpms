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
	if($_SESSION['position'] != 'Social Worker'){
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
    // echo $_POST['d_1'];
    // echo $_POST['d_2'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Social Worker</title>

    
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
		
        
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.css">
    <script type="text/javascript" charset="utf8" src="../datatables/datatables.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
    <?php 
    if(!empty($_POST["d_1"]) && !empty($_POST["d_2"])){
        $date1 = $_POST["d_1"];
        $date2 = $_POST["d_2"];
        echo '<input type="text" name="date1_1" id="date1_1" hidden value="'.$date1.'">
        <input type="text" name="date2_2" id="date2_2" hidden value="'.$date2.'">';
    }else{
        $date1="";
        $date2="";
    }
    ?>
    
    <script type="text/javascript">
    var d_1_1 = $("#date1_1").val();
    var d_2_2 = $("#date2_2").val();
    // console.log(d_1_1);
    // console.log(d_2_2);
    //    window.onload = function() {
    //         $.ajax({
    //             url: "fetch.php",
    //             method: "POST",
    //             data : {page:1,date1:d_1_1,date2:d_2_2},
    //             success:function(data){
    //                 $('#page_data').html(data);
    //                 //console.log(data);
    //             } 
    //             })
    //         }
    </script>
    </head>

    <body>
        <?php //echo $_SESSION['userfullname'] ?>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <img src="../images/logo.png" alt="dswd logo" width="100px" height="100px" >
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="home.php">List of Client<i style="float: right;font-size:25px" class="fa fa-users"></i> </a> 
                    </li>
                    <li>
                        <a href="draft.php">Serving Client <i style="float: right;font-size:25px" class="fa fa-child"></i></a>
                    </li>
                    <li>
                        <a href="reissue.php">Re-issue <i style="float: right;font-size:25px" class="fa fa-clone"></i></a>
                    </li>
                    <li>
                        <a href="summary_social.php">Summary <i style="float: right;font-size:25px" class="fa fa-list"></i></a>
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
                <div class="container-fluid" style="padding-left: 5%;" id="page_data">
                    <form class="form-group" action="summary_social.php" method="POST">
                        <div class="row" style="padding-bottom: 50px;">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-1" style="padding-top: 10px;"><p style="font-size: 14px;">Total Client:<p></div>
                            <div class="col-lg-1"><input id="counttotalclient" class="form-control border border-dark text-center" style="width:120%;margin-left:-30px;" disabled placeholder="0"></div>
                            <div class="col-lg-5"></div>
                        </div>
                        <div class="row" style="padding-bottom: 30px;">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3"><input id="d_1" name="d_1" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3"><input id="d_2" name="d_2" class="form-control border border-primary" type="date" required></div>
                            <div class="col-lg-1"><button class="btn btn-outline-primary text-center" type="submit">Submit<button></div>
                            <div class="col-lg-1"></div>
                        </div>
                    </form>
            
                    <table id="summarydtablesw" class="table table-fixed table-striped table-hover highlight responsive-table" style="width: 100%; margin: 2% 0% 0% 0%;">
                        <thead>
                            <tr>
                                <th scope="col" style='width: 25%'>Client Name</th>
                                <th scope="col" style='width: 25%'>Beneficiary Name</th>
                                <th scope="col" style='width: 15%'>Transaction Date</th>
                                <th scope="col" style='width: 20%'>Encoder</th>
                                <th scope="col" style='width: 15%'>Mode of Assistance</th>
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
                                $summarydt = $user->summaryDataTableSocialWork($datenow, $datenow2, $d1, $d2);
                                $summarynumrows = $user->summaryGetNumRowsSocWork($datenow, $datenow2, $d1, $d2);
                                    if($summarydt){
                                        foreach($summarydt as $index => $value){
                                            if($summarynumrows > 0){
                                                echo '<script>
                                                    console.log("'.$summarynumrows.'");
                                                    document.getElementById("counttotalclient").value = "'.$summarynumrows.'";
                                                </script>';
                                                echo "<tr>
                                                    <td scope='row' style='width: 25%'>" . $value['lastname'] .", ". $value['firstname'] ." ". (!empty($value['middlename'][0])?($value['middlename'][0] != " "?$value['middlename'][0] .". ":""):""). (!empty($value['extraname'])?$value['extraname'].".":"") . "</td> 
                                                    <td scope='row' style='width: 25%'>". 
                                                    (!empty($value['b_lname'])?$value['b_lname'] .", ". $value['b_fname'] ." ". (!empty($value['b_mname'][0])?($value['b_mname'][0] != " "?$value['b_mname'][0] .". ":""):""). (!empty($value['b_exname'])?$value['b_exname'].".":""):$value['lastname'] .", ". $value['firstname'] ." ". (!empty($value['middlename'][0])?($value['middlename'][0] != " "?$value['middlename'][0] .". ":""):""). (!empty($value['extraname'])?$value['extraname'].".":""))
                                                    ." </td>
                                                    <td scope='row' style='width: 15%'>" . $value['date_accomplished'] ." </td>
                                                    <td scope='row' style='width: 20%'>" . $user->getEncoder($value['encoded_encoder']) ." </td>
                                                    <td scope='row' style='width: 15%'>" .$user->get_assistance_mode($value['trans_id']) ." </td>
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
                <script type="text/javascript">
                    $(function(){
                        $("#summarydtablesw").dataTable();
                    });
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
            </div>
        </div>
    </body>
    <!-- Modal sa user Account -->
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

	
	<script type="text/javascript">
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
                url: "summary_social.php",
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