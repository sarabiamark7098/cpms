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
		
        <style>
            input[type=checkbox]
            {
                /* Double-sized Checkboxes */
                -ms-transform: scale(2); /* IE */
                -moz-transform: scale(2); /* FF */
                -webkit-transform: scale(2); /* Safari and Chrome */
                -o-transform: scale(2); /* Opera */
                padding: 10px;
                margin: 10px;
                font-size: 20px;
                text-align:center;
            }
        </style>

	</head>
	<body>
	<div class="body">
        <form class="form-group" action="SignatoryPage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <!-- <div class="form-group col-lg-12">
                        <input placeholder="Signatory ID" id="empid" name="empid" type="text" class="form-control" required>
                        <label class="active" for="empid">Signatory ID</label>
                    </div> -->
                    <div class="form-group col-lg-12">
                        <input placeholder="First Name" id="fname" name="fname" type="text" class="form-control" required>
                        <label class="active" for="fname">First Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Last Name" id="lname" name="lname" type="text" class="form-control " required>
                        <label class="active" for="lname">Last Name</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Middle Initial" maxlength="1" id="mini" name="mi" type="text" class="form-control" required>
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
                        <div class="row">
                            <div class="col-6">
                            <input type="checkbox" name="gis_ce_check" id="gis_ce_check"><label for="gis_ce_check">GIS/CE</label>
                            </div>
                            <div class="col-6">
                            <input type="checkbox" name="gl_check" id="gl_check"><label for="gl_check">GL</label>
                            </div>
                        </div>
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
    <script>
        $(function () {
            $(".srange").hide();
            $("#gl_check").click(function () {
                if ($(this).is(":checked")) {
                    $(".srange").show();
                } else {
                    $(".srange").hide();
                }
            });
        });
        // $(function() {
        //     $('#fname').keyup(function() {
        //         var ini = $('#initials').val();
        //         var fn = $('#fname').val().substr(0, 1);
        //         var mi = $('#mini').val().substr(0, 1);
        //         var ln = $('#lname').val().substr(0, 1);
        //         ini = fn+mi+ln;
        //         document.getElementById("initials").value = ini;
        //     });
        // });
        // $(function() {
        //     $('#lname').keyup(function() {
        //         var ini = $('#initials').val();
        //         var fn = $('#fname').val().substr(0, 1);
        //         var mi = $('#mini').val().substr(0, 1);
        //         var ln = $('#lname').val().substr(0, 1);
        //         ini = fn+mi+ln;
        //         document.getElementById("initials").value = ini;
        //     });
        // });
        // $(function() {
        //     ('#mini').keyup(function() {
        //         var ini = $('#initials').val();
        //         var fn = $('#fname').val().substr(0, 1);
        //         var mi = $('#mini').val().substr(0, 1);
        //         var ln = $('#lname').val().substr(0, 1);
        //         ini = fn+mi+ln;
        //         document.getElementById("initials").value = ini;
        //     });
           
        // });
    </script>
</html>