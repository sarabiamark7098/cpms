<!DOCTYPE html>
<html>
	<head>
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
		
	</head>
	<body>
	<div class="body">
        <form class="form-group" action="home.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Addressee Name" id="addresseename" name="addresseename" type="text" class="form-control">
                        <label class="active" for="addresseename">Addressee</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Addressee Position" id="addresseeposition" name="addresseeposition" type="text" class="form-control" required>
                        <label class="active" for="addresseeposition">Addressee Position(e.g. Adminisitrator)</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Company Name" id="companyname" name="companyname" type="text" class="form-control" required>
                        <label class="active" for="companyname">Company Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Company Address" id="companyaddress" name="companyaddress" type="text" class="form-control " required>
                        <label class="active" for="companyaddress">Company Address(Complete)</label>
                    </div>
                </div>
                        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Add">Save</button>
            </div>
        </form>
	</div>

</body>
</html>