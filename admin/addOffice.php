<?php
	include('../php/class.user.php');
    $user = new User();
?>
<!DOCTYPE html>
<html>
	<body>
	<div class="body">
        <form class="form-group" action="OfficePage.php" method="POST">
            <div class="modal-body">
                <div class="row form-group" style="margin-top: 2%; height:10%;">
                    <div class="form-group col-lg-12">
                        <input list="regionClist" id="creg" name="regionname" class="form-control mr-sm-2 b" placeholder="Region" onChange="get_c_Region(this)" required>
                        <datalist id="regionClist">
                        <?php
                            $getregions = $user->optionregion();
                                //Loop through results
                            foreach($getregions as $index => $value){
                                //Display info
                                echo '<option value="'. $value['r_name'] .' /'. $value['psgc_code'] .'"> ';
                                //echo $value['psgc_code'];
                                echo '</option>';
                            }
                        ?>
                        
                        </datalist>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="provinceClist" id="cprov" type="text" class="form-control mr-sm-2 b" name="province" placeholder="Province" onChange="get_c_Province(this)" required>
                        <datalist id="provinceClist">
                        </datalist>
                    </div>
                    <div class="form-group col-lg-12">
                        <input list="municipalityClist" type="text" class="form-control mr-sm-2 b" id="client_city" name="city" placeholder="City or Municipality" required>
                        <datalist id="municipalityClist">
                        </datalist>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Office Name" id="officename" name="officename" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
                        <label class="active" for="officename">Office Name</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <input placeholder="Office Acronym" id="officeacronym" name="officeacronym" type="text" class="form-control" required oninput="this.value = this.value.replace(/[^A-Za-zÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()">
                        <label class="active" for="officename">Office Acronym</label>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Description" id="description" name="description" class="form-control " required maxlength="100" oninput="this.value = this.value.replace(/[^A-Za-z0-9ÑñÉéÈèÊêËë\-., ]/g, '').toUpperCase()"></textarea>
                        <label class="active" for="description">Description</label>
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