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
        <form class="form-group" action="GISassessment.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Assessment Option" id="assopt" name="assopt" style="text-transform: uppercase" type="text" class="form-control">
                        <label class="active" for="assopt">Assessment Option</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Problem Presented" id="prob_pre" name="prob_pre" style="text-transform: uppercase;" type="text" class="form-control" required></textarea>
                        <label class="active" for="prob_pre">Problem Presented</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Social Work Assessment" id="swass" name="swass" style="text-transform: uppercase" type="text" class="form-control" required></textarea>
                        <label class="active" for="swass">Social Work Assessment</label>
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