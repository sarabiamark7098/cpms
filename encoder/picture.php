<?php
    include('../php/class.user.php');
	$user = new User();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $img = $user->getClientImage($id);
        $client = $user->getClientData($id);
        $name = $client['firstname'] ." ". $client['middlename'][0] .". ". $client['lastname'] ." ". $client['extraname'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
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
        #camera {
            width: 100%;
            height: 350px;
        }
        .col-centered{
            float: none;
            margin: 0 auto;
        }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="position: fixed; width: 100%; z-index:100; background: #6d7fcc;">
        <a href="home.php"><img src="../images/dswd-logo_final.png" class="img-responsive" alt="unkown" width="200" height="55"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
			</ul>
			<div class="my-2 my-lg-0"> 
             <div class="input-group input-group-lg">
                 <h4>
                    <div class="input-group-prepend text-white">
                    <span id="date_time"></span>
                        <script type="text/javascript">window.onload = date_time('date_time');</script>
                    </div>  
                </h4>
			 </div>
			</div>
        </nav>
    <div class="container">
        <br><br><br><br>
            <div class="row text-center">
                <!--<div id="camera_info"></div>-->
                    <div class="col-4">
                        <div class="border border-info" id="camera"></div><br>
                        <h3>Client Name: <?php echo $name?></h3>

                    </div>
                    <div class="col-2" style="margin:15px">
                    &nbsp;&nbsp;<br>
                        <?php 
                        if($img != "../clientImages/no_avatar.gif"){
                            echo '<div class="row"><button id="re_take" class="btn btn-warning btn-block"><i class="fa fa-camera"></i> Re-Take</button></div><br>';
                            echo '<div class="row"><button id="done" class="btn btn-success btn-block"><i class="fa fa-check"></i> Done</button></div>';
                        }else{
                            echo '<div class="row text-right"><button id="take_snapshots" class="btn btn-warning btn-block"><i class="fa fa-camera"></i> Take Snapshots</button></div>';
                        }?>
                    </div>
                    <div class="col-5"><img class="border border-success" id="image" src="<?php echo $img?>" width="100%" height="400px"></div>
            </div><br>
            
    </div> <!-- /container -->
    <script src="../js/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script>
	<script src="../js/jpeg_camera_no_flash.min.js" type="text/javascript"></script>
    <script>
        var options = {
          shutter_ogg_url: "../js/shutter.ogg",
          shutter_mp3_url: "../js/shutter.mp3",
          swf_url: "../js/jpeg_camera.swf",
        };  
        var camera = new JpegCamera("#camera", options);  //object for camera
      

        $('#take_snapshots').click(function(){ //when button is clicked
        var snapshot = camera.capture(); //hold niya ang captured image
        // console.log('kini');
        snapshot.upload({api_url: "action.php?id=<?php echo $_GET['id']?>"}).done(function(response) { //processof uploading. 
            location.reload();
            this.discard(); //continuation sa camera stream
            }).fail(function(response) {
                alert("Upload failed with status " + response);
            });
        })

        //* Re-Take
        $('#re_take').click(function(){ //when button is clicked
        var snapshot = camera.capture(); //hold niya ang captured image
        // console.log("mao");
        snapshot.upload({api_url: "action.php?id=<?php echo $_GET['id']?>&do=1"}).done(function(response) { //process of uploading. 
            location.reload();
            this.discard(); //continuation sa camera stream
            }).fail(function(response) {
                alert("Upload failed with status " + response);
            });
        })
        
        $('#done').click(function(){
            alert('Client Successfully Saved!');
            window.location.href = "home.php";
        })
    </script>
  </body>
</html>