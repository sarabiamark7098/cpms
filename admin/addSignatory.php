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
	<div class="body">
        <form class="form-group" action="SignatoryPage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input placeholder="Signatory Title" id="title" name="title" type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-,. ]/g, '')">
                        <label class="active" for="title">Signatory Title (e.g. Atty.)</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="First Name" id="fname" name="fname" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-,. ]/g, '')">
                        <label class="active" for="fname">First Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Last Name" id="lname" name="lname" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-,. ]/g, '')">
                        <label class="active" for="lname">Last Name</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Middle Initial" maxlength="1" id="mini" name="mi" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-. ]/g, '')">
                        <label class="active" for="mi">Middle Initial</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Initials" maxlength="4" id="initials" name="initials" type="text" class="form-control " required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë ]/g, '').toUpperCase()">
                        <label class="active" for="initials">Initials(e.g. NTS)</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <input placeholder="Position" id="position" name="position" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-,. ]/g, '')">
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
                    <div class="form-group col-lg-6">
                        <select placeholder="SIGNATORY TREE" id="s_tree" name="s_tree" type="text" class="form-control" required>
							<option value="none" selected> - </option>
                            <option value="CURRENTHEAD1" >DSWD SECRETARY</option>
                            <option value="CURRENTHEAD2" >Regional Director</option>
                            <option value="CURRENTHEAD3" >ARD for Operation</option>
                            <option value="CURRENTHEAD4" >ARD for Administration</option>
                            <option value="CURRENTHEAD5" >PSD CHIEF</option>
                            <option value="CURRENTHEAD6" >CIS HEAD</option>
                            <option value="CURRENTHEAD7" >SWADO - 3RD DISTRICT</option>
                            <option value="CURRENTHEAD8" >SWADO - DAVAO DEL SUR</option>
                            <option value="CURRENTHEAD9" >SWADO - DAVAO DEL NORTE</option>
                            <option value="CURRENTHEAD10" >SWADO - DAVAO DE ORO</option>
                            <option value="CURRENTHEAD11" >SWADO - DAVAO ORIENTAL</option>
                            <option value="CURRENTHEAD12" >SWADO - DAVAO OCCIDENTAL</option>
                            <option value="CURRENTHEAD13" >SPMC</option>
                            <option value="CURRENTHEAD14" >DRMC</option>
                            <option value="CURRENTHEAD15" >ASSISTANT TO CIS HEAD</option>
						</select>
						<label class="active" for="s_tree">SIGNATORY TREE</label>
                    </div>
                    <div class="form-group col-lg-6">
                        <select placeholder="SPECIAL SIGNATORY" id="s_signatory" name="s_signatory" type="text" class="form-control" required>
							<option value="0" selected>No</option>
							<option value="1">Yes</option>
						</select>
                        <label class="active" for="s_signatory">SPECIAL SIGNATORY</label>
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
    </script>
</html>