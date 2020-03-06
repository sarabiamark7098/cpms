<?php
include('../php/class.user.php');
$user = new User();

	$clientid = $_GET['id'];
	
	$client =  $user->clientData($_GET['id']);
	$image = $user->webcamimagesource($_GET['id']);
	$name = $client["firstname"]." ". $client["middlename"][0] .". ".$client["lastname"] .' '.(!empty($client["extraname"])?$client["extraname"]:"");
	$muni = explode("/",$client["client_municipality"]);
	$address = $client["client_street"].', '.$muni[0];
	$now = date("jS").' day of '. date("F Y");
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
    }
?>
<html>
    <head>
        <title>DSWD LOGIN</title>
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
            .pic {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .content{
                justify-content: center;
                text-indent: 50px;
            }
        </style>
    </head>
    <body>
	<script>
	function printIDCert(){
            var divElements = $('#printidcert').html();
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
	function done(){
		alert("Done");
		window.location='UnservedClient.php';
	}
	</script>
	<br><br>
	<div class="container">
		<div class="row">
			<div class="col-4"> <button class="btn btn-primary btn-block no-print" onclick="printIDCert()"><span class="fa fa-print"></span> Print</button></div>
			<div class="col-4"></div>
			<div class="col-4"> <button class="btn btn-success btn-block no-print" onclick="done()"><span class="fa fa-check"></span> Done</button></div>
		</div>
	</div>
	
        <div id="printidcert">
		<br><br><br><br><br>
			<div class="container">
				<div class="pic">
					<img src="<?php echo $image['image']; ?>" alt="" width="300">
				</div>
				<div class="pic">
					_____________________________________________________
				</div>
				<br>
				<div class="pic">
					<h4><u>CERTIFICATION</u></h4>
				</div>

				<div>
					<p>To whom it may concern:</p>
					<div class="content">
							This is to certify that the client appeared named <?php echo $name ?>, residing at <?php echo $address ?>.
							This certification is made in line of Identification Card (ID) considering that the client has no identification card.   
					</div><br>
					<div class="content">
							Given this <?php echo $now ?> at Davao City, Philippines.
					</div>
				</div><br><br><br><br>
				<div class="row">
					<div class="col-4 text-center">
						<div class="content"> 
							__________________________
						</div>
						<div class="content"> 
							Signature of Client
						</div>
					</div>
				</div>
			</div>
        </div>
    </body>
	
</html>