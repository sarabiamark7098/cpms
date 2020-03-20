<?php
	include('../php/class.user.php');
    $user = new User();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>DSWD HOME</title>
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
        
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap-3.3.7.min.js"></script>
        
        
		<style type="text/css">
			:required  {  
				 background: url(../images/icons/asterisk.png) no-repeat;
				 background-position:left top;
			}
			.dropdown .dropdown-menu .dropdown-item:active, .dropdown 
			.dropdown-menu .dropdown-item:hover{background-color: skyblue  !important;}
        </style>
    </head>

    <body>
        <form class="form-group" action="home.php" method="POST" onsubmit="return submittingForm(this);" autocomplete="off">
            <div class="modal-body">
                <h4 class="text-center">Client Info</h4>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="firstname" class="form-control mr-sm-2 b" style="text-transform:uppercase" placeholder="First Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control mr-sm-2 b" name="middlename" style="text-transform:uppercase" placeholder="Middle Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control mr-sm-2 b" name="lastname" style="text-transform:uppercase" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <!-- <input type="text" class="form-control mr-sm-2 b" name="extraname" style="text-transform:uppercase" placeholder="Extension Name"> -->
                        <select name="extraname" class="form-control mr-sm-2 b">
                            <option value="" selected> Extension Name</option>
                            <option value="JR">JR</option>
                            <option value="SR">SR</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 label" style="font-size: 20px">Birth Date: </label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control mr-sm-2" name="birthday" placeholder="Birth Date" max='<?php echo date("Y-m-d") ?>' required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select name="sex" class="form-control mr-sm-2 b" required >
                        <option value="" disabled selected>Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>  
                    </div>
                    <div class="col-sm-6">
                    <select name="civilstatus" class="form-control mr-sm-2 b" required >
                        <option value="" disabled selected>Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Widow/Widower">Widow/Widower</option>
                        <option value="Common-Law">Common-law</option>
                    </select>  
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control mr-sm-2 b" name="occupation" placeholder="Occupation" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="number" class="form-control mr-sm-2 b" name="salary" placeholder="Salary">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="text" class="form-control mr-sm-2 b" name="contact" placeholder="Contact Number" onKeyPress="if(this.value.length==11) return false;">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input list="categories" class="form-control mr-sm-2 b" type="text" name="category" placeholder="Category" name="category" required>
                        <datalist id="categories">
                            <option>Children in Need of Special Protection</option>
                            <option>Persons Living with HIV/AIDS</option>
                            <option>Youth</option>
                            <option>Men/Women in Specially Difficult Circumstances</option>
                            <option>Persons with Disabilities</option>
                            <option>Senior Citizens (no subcategories)</option>
                            <option>Family Heads and Other Needy Adult</option>
                            <option>None of the Above</option>
                        </datalist>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control mr-sm-2 b" name="subcategory" placeholder="Sub-Category">
                    </div>
                </div>
                    <!--Address-->
                <h4 class="text-center">Address</h4>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input list="regionClist" id="creg" name="regions" class="form-control mr-sm-2 b" placeholder="Region" onChange="get_hc_Region(this)" required>
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
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input list="provinceClist" id="cprov" type="text" class="form-control mr-sm-2 b" name="province" placeholder="Province" onChange="get_hc_Province(this)" required>
                    <datalist id="provinceClist">
                    </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input list="municipalityClist" type="text" class="form-control mr-sm-2 b" id="client_city" name="city" placeholder="City or Municipality" onChange="get_hc_Municipality(this)" required>
                    <datalist id="municipalityClist">
                    </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input list="barangayClist" id="cbrgy" type="text" class="form-control mr-sm-2 b" name="barangay" placeholder="Barangay" required>
                    <datalist id="barangayClist">
                    </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <select class="form-control mr-sm-2 b" name="district" id="client_district">
                            <option value="" selected>Select District</option>
                            <?php
                                $getdistrict = $user->getdistrictlist();
                                //Loop through results
                                foreach($getdistrict as $index => $value){
                                    //Display info
                                    echo '<option value="'. $value['district_name'] .'"> ';
                                    echo $value['district_name'];
                                    echo '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <!-- <div id="district_hidden_client" class="col-sm-12" style="margin-top:10px;">
                        <input class="form-control mr-sm-2 b" type="text" name="selected_district" id="district_ni_client" placeholder="Other District">
                    </div> -->
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                    <input type="text" id="cstr" class="form-control mr-sm-2 b" name="street" placeholder="No./Street/Purok">
                    </div>
                </div>
                

                <!--Check Box, Beneficiary info sheet-->
                <div class="row">
                    <div class="checkbox col-6">
                        <label data-toggle="collapse" for='radiobutton' data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <input type="checkbox" id="radiobutton" class="checkbutton" name="wbeneficiary" style="height:15px;width:15px;margin: 10px" required> With BENEFICIARY
                        </label>
                    </div>
                    <div class="checkbox col-6">
                        <label for='radiobutton2'>
                            <input type="checkbox" id="radiobutton2" class="checkbutton" name="wobeneficiary" style="height:15px;width:15px;margin: 10px" required> Without BENEFICIARY
                        </label>
                    </div>
                </div>
                <div id="collapseOne" aria-expanded="false" class="collapse">
                    <h4 class="text-center">Beneficiary Info</h4>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <!-- <input id="foo" type="text" name="relation" class="form-control mr-sm-2 b benerequire" placeholder="Relationship with Beneficiary"> -->
                        <select name="relation" class="form-control mr-sm-2 b benerequire">
                            <option value="" disabled selected>Relation With Beneficiary</option>
                            <?php
                                $getrelation = $user->getrelationshiplist();
                                //Loop through results
                                foreach($getrelation as $index => $value){
                                    //Display info
                                    echo '<option value="'. $value['relation'] .'"> ';
                                    echo $value['relation'];
                                    echo '</option>';
                                }
                            ?>  
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" name="b_fname" class="form-control mr-sm-2 b benerequire" style="text-transform:uppercase" placeholder="Beneficiary First Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control mr-sm-2 b benerequire" name="b_mname" style="text-transform:uppercase" placeholder="Beneficiary Middle Name">    
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input type="text" class="form-control mr-sm-2 b benerequire" name="b_lname" style="text-transform:uppercase" placeholder="Beneficiary Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <!-- <input type="text" class="form-control mr-sm-2 b" name="b_exname" style="text-transform:uppercase" placeholder="Beneficiary Extension Name"> -->
                        <select name="b_exname" class="form-control mr-sm-2 b">
                            <option value="" selected>Beneficiary Extension Name</option>
                            <option value="JR">JR</option>
                            <option value="SR">SR</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 label" style="font-size: 20px">Birth Date: </label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control mr-sm-2 benerequire" name="b_bday" placeholder="Beneficiary Birth Date"  max='<?php echo date("Y-m-d") ?>'>  
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                        <select name="b_sex" class="form-control mr-sm-2 b benerequire">
                            <option value="" disabled selected>Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <select name="b_cstatus" class="form-control mr-sm-2 b benerequire">
                            <option value="" disabled selected>Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Separated">Separated</option>
                            <option value="Widow/Widower">Widow/Widower</option>
                            <option value="Common-Law">Common-law</option>
                        </select>  
                        </div>
                    </div>
                        <div class="form-group row">
                        <div class="col-sm-12">
                        <input type="text" class="form-control mr-sm-2 b" name="b_contact" placeholder="Beneficiary Contact Number" onKeyPress="if(this.value.length==11) return false;" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input list="b_categories" type="text" class="form-control mr-sm-2 b benerequire" name="b_category" placeholder="Beneficiary Category" >
                            <datalist id="b_categories">
                                <option>Children in Need of Special Protection</option>
                                <option>Persons Living with HIV/AIDS</option>
                                <option>Youth</option>
                                <option>Men/Women in Specially Difficult Circumstances</option>
                                <option>Persons with Disabilities</option>
                                <option>Senior Citizens (no subcategories)</option>
                                <option>Family Heads and Other Needy Adult</option>
                                <option>None of the Above</option>
                            </datalist>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control mr-sm-2 b" name="b_subcat" placeholder="Beneficiary Sub-Category" >
                        </div>
                    </div>
                    
                    <!--Address-->
                    <h4 class="text-center">Beneficiary Address</h4>
                    <div class="row" style="margin-bottom: 2%;">
                        <div class="col-8">
                        </div>  
                        <div class="col-4">
                            <input class="btn btn-primary" style="border:none;" type="button" value="Copy Client Address" onclick="copyaddressclient()"></input>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input list="regionBlist" id="breg" type="text" class="form-control mr-sm-2 b benerequire" name="b_region" placeholder="Beneficiary Region" onChange="get_hb_Region(this)">
                        <datalist id="regionBlist">
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
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input list="provinceBlist" id="bprov" type="text" class="form-control mr-sm-2 b benerequire" name="b_province" placeholder="Beneficiary Province" onChange="get_hb_Province(this)">
                        <datalist id="provinceBlist">
                        </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input list="municipalityBlist" type="text" class="form-control mr-sm-2 b benerequire" id="beneficiary_city" name="b_city" placeholder="Beneficiary City or Municipality" onChange="get_hb_Municipality(this)">
                        <datalist id="municipalityBlist">
                        </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input list="barangayBlist" id="bbrgy" type="text" class="form-control mr-sm-2 b benerequire" name="b_barangay" placeholder="Beneficiary Barangay" onChange="get_hb_Barangay(this)">
                        <datalist id="barangayBlist">
                        </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select class="form-control mr-sm-2 b" name="b_district" id="beneficiary_district">
                                <option value="" selected>Select District</option>
                                <?php
                                    $getdistrict = $user->getdistrictlist();
                                    //Loop through results
                                    foreach($getdistrict as $index => $value){
                                        //Display info
                                        echo '<option value="'. $value['district_name'] .'"> ';
                                        echo $value['district_name'];
                                        echo '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                        <input type="text" id="bstr" class="form-control mr-sm-2 b" name="b_street" placeholder="Beneficiary No./Street/Purok">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary btn-md submitload" name="addClient" value="Submit" onclick="msg()">      
            </div>
            <script>
                function msg(){
                    alert("Adding Client!");
                }
            </script>   

        </form> 
            
        <script type="text/javascript">
        
        // $(function () {
        //     $("#district_hidden_client").hide();
        //     did = document.getElementById('client_district').value;
        //     console.log(did); 
             
        // });
        // $(function () { data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing"
        //     $('.submitload').on('click', function() {
        //             var $this = $(this);
        //         $this.button('loading');
        //             setTimeout(function() {
        //             $this.button('reset');
        //         }, 8000);
        //     });
        // });
        // function submittingForm(form) {
        //     form.addClient.disabled = true;
        //     form.addClient.value = "Please wait...";
        //     return true;
        // }

        $(function () {
            $("#radiobutton2").click(function () {
                if ($(this).is(":checked")) {
                    $("#collapseOne").hide();
                } else {
                    $("#collapseOne").hide();
                }
            }); 
        });

        $(function () {
            $("#radiobutton").click(function () {
                if ($(this).is(":checked")) {
                    $("#collapseOne").show();
                } else {
                    $("#collapseOne").hide();
                }
            });
        });
        
        $(function () {
            $("#radiobutton2").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton").not($(this)).each(function () {
                        $(this).removeAttr("checked");
                    });
                }
            });
        });

        $(function () {
            $("#radiobutton").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton2").not($(this)).each(function () {
                        $(this).removeAttr("checked");
                    })
                }
            });
        });

        $(function () {
            $("#radiobutton").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton2").not($(this)).each(function () {
                        $(this).removeAttr("required");
                    });
                }
            });
            $("#radiobutton2").change(function () {
                if ($(this).is(":checked")) {
                    $("#radiobutton").not($(this)).each(function () {
                        $(this).removeAttr("required");
                    });
                }
            });
        });

        $(function () {
            $("#radiobutton").click(function () {
                if ($(this).is(":checked")) {
                    // console.log("require");
                    $(".benerequire").attr('required', '');
                } else {
                    // console.log("wla na require");
                    $(".benerequire").removeAttr('required');
                }
            });
        });

        function copyaddressclient() {
            reg = document.getElementById('creg').value;
			prov = document.getElementById('cprov').value;
			muni = document.getElementById('client_city').value;
            brgy = document.getElementById('cbrgy').value;
            dist = document.getElementById('client_district').value;
            str = document.getElementById('cstr').value;
            // console.log(reg);console.log(prov);console.log(muni);console.log(brgy);console.log(dist);console.log(str);

			document.getElementById('breg').value = reg;
			document.getElementById('bprov').value = prov;
			document.getElementById('beneficiary_city').value = muni;
            document.getElementById('bbrgy').value = brgy;
            document.getElementById('beneficiary_district').value = dist;
            document.getElementById('bstr').value = str;
            
			get_b_Region_sw(reg);
			get_b_Province_sw(prov);
			get_b_Municipality_sw(muni);
			get_b_Barangay_sw(brgy);
		}

        </script>
</html>