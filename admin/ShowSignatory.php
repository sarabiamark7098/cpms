<?php
include('../php/class.user.php');
$user = new User();

    $empid = $_GET['id'];
	
	$getsignatory = $user->show_signatory_data($empid);
?>
<?php
	if(!$_SESSION['login']){
		header('Location:../index.php');
		}

?>
<!DOCTYPE html>
<html>
	<head>
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
	  <form class="form-group" action="ShowSignatory.php" method="POST">
		<div class="modal-body">
			<div class="row form-group" style="margin-top: 2%; height:10%;">
				<div class="form-group col-lg-3">
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $empid; ?>" placeholder="Signatory ID" id="empid" name="empid" type="text" class="form-control text-center" readonly disabled>
				  <label class="active" for="empid">Employee ID(Signatory)</label>
				</div>
				<div class="form-group col-lg-3">
				</div>
				<div class="form-group col-lg-12">
                  <input value="<?php echo $getsignatory['name_title']; ?>" placeholder="" id="title" name="title" type="text" class="form-control" readonly disabled>
                  <label class="active" for="title">Signatory Title (e.g. Atty.)</label>
                </div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getsignatory['first_name']; ?>" placeholder="First Name" id="fname" name="fname" type="text" class="form-control" readonly disabled>
				  <label class="active" for="fname">First Name</label>
				</div>
				<div class="form-group col-lg-12">
				  <input value="<?php echo $getsignatory['last_name']; ?>" placeholder="Last Name" id="lname" name="lname" type="text" class="form-control " readonly disabled>
				  <label class="active" for="lname">Last Name</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['middle_I']; ?>" placeholder="Middle Initial" id="mi" name="mi" type="text" class="form-control" readonly disabled>
				  <label class="active" for="mi">Middle Initial</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['initials']; ?>" placeholder="Initials" id="initials" name="initials" type="text" class="form-control " readonly disabled>
				  <label class="active" for="initials">Initials(e.g. NTS)</label>
				</div>
				<div class="form-group col-lg-6">
				  <input value="<?php echo $getsignatory['position']; ?>" placeholder="Position" id="position" name="position" type="text" class="form-control" readonly disabled>
				  <label class="active" for="position">Position</label>
				</div>
				<div class="form-group col-lg-6">
					<div class="row">
						<div class="col-6">
						<input type="checkbox" name="gis_ce_check" id="gis_ce_check" <?php echo ($getsignatory['option_GIS'] == 1?"checked":"") ?> disabled><label for="gis_ce_check">GIS/CE</label>
						</div>
						<div class="col-6">
						<input type="checkbox" name="gl_check" id="gl_check" <?php echo ($getsignatory['option_GL'] == 1?"checked":"") ?> disabled><label for="gl_check">GL</label>
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6">
                    <select placeholder="SIGNATORY TREE" id="s_tree" name="s_tree" type="text" class="form-control" readonly disabled>
						<option value="none" <?php echo (strtolower($getsignatory['signatory_tree']) == "none"?"selected":"") ?>> - </option>
                        <option value="CURRENTHEAD1" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead1"?"selected":"") ?>>DSWD SECRETARY</option>
                        <option value="CURRENTHEAD2" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead2"?"selected":"") ?>>Regional Director</option>
                        <option value="CURRENTHEAD3" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead3"?"selected":"") ?>>ARD for Operation</option>
                        <option value="CURRENTHEAD4" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead4"?"selected":"") ?>>ARD for Administration</option>
                        <option value="CURRENTHEAD5" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead5"?"selected":"") ?>>PSD CHIEF</option>
                        <option value="CURRENTHEAD6" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead6"?"selected":"") ?>>CIS HEAD</option>
                        <option value="CURRENTHEAD7" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead7"?"selected":"") ?>>SWADO - 3RD DISTRICT</option>
                        <option value="CURRENTHEAD8" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead8"?"selected":"") ?>>SWADO - DAVAO DEL SUR</option>
                        <option value="CURRENTHEAD9" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead9"?"selected":"") ?>>SWADO - DAVAO DEL NORTE</option>
                        <option value="CURRENTHEAD10" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead10"?"selected":"") ?>>SWADO - DAVAO DE ORO</option>
                        <option value="CURRENTHEAD11" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead11"?"selected":"") ?>>SWADO - DAVAO ORIENTAL</option>
                        <option value="CURRENTHEAD12" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead12"?"selected":"") ?>>SWADO - DAVAO OCCIDENTAL</option>
                        <option value="CURRENTHEAD13" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead13"?"selected":"") ?>>SPMC</option>
                        <option value="CURRENTHEAD14" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead14"?"selected":"") ?>>DRMC</option>
                        <option value="CURRENTHEAD15" <?php echo (strtolower($getsignatory['signatory_tree']) == "currenthead15"?"selected":"") ?>>ASSISTANT TO CIS HEAD</option>
					</select>
					<label class="active" for="s_tree">SIGNATORY TREE</label>
                </div>
                <div class="form-group col-lg-6">
                    <select placeholder="SPECIAL SIGNATORY" id="s_signatory" name="s_signatory" type="text" class="form-control" readonly disabled>
						<option value="0" <?php echo ($getsignatory['special_ini'] == "0"?"selected":"") ?>>De-Activate</option>
						<option value="1" <?php echo ($getsignatory['special_ini'] == "1"?"selected":"") ?>>Active</option>
					</select>
                    <label class="active" for="s_signatory">SPECIAL SIGNATORY</label>
                </div>
			</div>
		</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
        </form>
</body>
    <script>
        $(function () {
			if ($("#gl_check").is(":checked")) {
				$(".srange").show();
			} else {
				$(".srange").hide();
			}
            $("#gl_check").click(function () {
                if ($(this).is(":checked")) {
                    $(".srange").show();
                } else {
                    $(".srange").hide();
                }
            });
        });
    </script>
</html>