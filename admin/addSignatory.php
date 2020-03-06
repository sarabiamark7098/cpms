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
        <form class="form-group" action="SignatoryPage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Signatory ID" id="empid" name="empid" type="text" class="form-control" required>
                        <label class="active" for="empid">Signatory ID</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="First Name" id="fname" name="fname" type="text" class="form-control" required>
                        <label class="active" for="fname">First Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Last Name" id="lname" name="lname" type="text" class="form-control " required>
                        <label class="active" for="lname">Last Name</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Middle Initial" maxlength="1" id="mi" name="mi" type="text" class="form-control" required>
                        <label class="active" for="mi">Middle Initial</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Initials" maxlength="4" id="initials" name="initials" type="text" class="form-control " required>
                        <label class="active" for="initials">Initials(e.g. NTS)</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Position" id="position" name="position" type="text" class="form-control" required>
                        <label class="active" for="position">Position</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <Select placeholder="Options" id="option" name="option" type="text" class="form-control " required>
                            <option value="" disabled selected>Options</option>
                            <option value="GL">Guarantee Letter</option>
                            <option value="GIS / CE">GIS / CE</option>
                        </select>
                            <label class="active" for="position">Options</label>
                    </div>
                    <div class="form-group col-lg-6 srange">
                        <input placeholder="&#8369; Range Start" id="rangestart" name="rangestart" type="number" class="form-control">
                        <label class="active" for="rangestart">Range Start</label>
                    </div>
                    <div class="form-group col-lg-6 srange">
                        <input  placeholder="&#8369; Range End" id="rangeend" name="rangeend" type="number" class="form-control">
                        <label class="active" for="rangeend">Range End</label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="Add">Add</button>
            </div>
        </form>
	</div>

</body>
</html>