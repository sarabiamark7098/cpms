	function selectCategory(val) {
	    if (val.value == "Province") {
	        document.getElementById("showDistrict").style.display = "none";
	    } else if (val.value == "Municipality") {
	        document.getElementById("showDistrict").style.display = "block";
	    } else if (val.value == "Barangay") {
	        document.getElementById("showDistrict").style.display = "none";
	    } else if (val.value == "Region") {
	        document.getElementById("showDistrict").style.display = "none";
	    }
	}

	function get_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provincelist").html(data);
	        }
	    });
	}

	function get_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provincename=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalitylist").html(data);

	        }
	    });
	}

	function get_Municipality(val) {
	    var municipality = (val.value).split(' /');
	    var dataString = 'municipalityname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangaylist").html(data);
	        }
	    });
	}

	function get_Barangay(val) {
	    var barangay = (val.value).split(' /');
	    var dataString = 'barangayname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#districtlist").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_c_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionCname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceClist").html(data)
	        }
	    });
	}

	function get_c_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provinceCname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityClist").html(data);

	        }
	    });
	}

	function get_c_Municipality(val) {
	    var municipality = (val.value).split(' /');
	    var dataString = 'municipalityCname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayClist").html(data);
	        }
	    });
	}

	function get_c_Barangay(val) {
	    var barangay = (val.value).split(' /');
	    var dataString = 'barangayCname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#client_district").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_b_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionBname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceBlist").html(data)
	        }
	    });
	}

	function get_b_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provinceBname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityBlist").html(data);

	        }
	    });
	}

	function get_b_Municipality(val) {
	    var municipality = (val.value).split(' /');
	    var dataString = 'municipalityBname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayBlist").html(data);
	        }
	    });
	}

	function get_b_Barangay(val) {
	    var barangay = (val.value).split(' /');
	    var dataString = 'barangayBname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#beneficiary_district").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_hc_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionCname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceClist").html(data)
	        }
	    });
	}

	function get_hc_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provinceCname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityClist").html(data);

	        }
	    });
	}

	function get_hc_Municipality(val) {
	    var municipality = (val.value).split(' /');
	    var dataString = 'municipalityCname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayClist").html(data);
	        }
	    });
	}

	function get_hc_Barangay(val) {
	    var barangay = (val.value).split(' /');
	    var dataString = 'barangayCname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#client_district").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_hb_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionBname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceBlist").html(data)
	        }
	    });
	}

	function get_hb_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provinceBname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityBlist").html(data);

	        }
	    });
	}

	function get_hb_Municipality(val) {
	    var municipality = (val.value).split(' /');
	    var dataString = 'municipalityBname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayBlist").html(data);
	        }
	    });
	}

	function get_hb_Barangay(val) {
	    var barangay = (val.value).split(' /');
	    var dataString = 'barangayBname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#beneficiary_district").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_c_Region_sw(val) {
	    var region = (val).split(' /');
	    var dataString = 'regionCname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceClist").html(data)
	        }
	    });
	}

	function get_c_Province_sw(val) {
	    var province = (val).split(' /');
	    var dataString = 'provinceCname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityClist").html(data);

	        }
	    });
	}

	function get_c_Municipality_sw(val) {
	    var municipality = (val).split(' /');
	    var dataString = 'municipalityCname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayClist").html(data);
	        }
	    });
	}

	function get_c_Barangay_sw(val) {
	    var barangay = (val).split(' /');
	    var dataString = 'barangayCname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        async: false,
	        data: dataString,
	        dataType: "json",
	        success: function(data) {
	            $("#districtClist").html(data)
	        }
	    });
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_b_Region_sw(val) {
	    var region = (val).split(' /');
	    var dataString = 'regionBname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceBlist").html(data)
	        }
	    });
	}

	function get_b_Province_sw(val) {
	    var province = (val).split(' /');
	    var dataString = 'provinceBname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityBlist").html(data);

	        }
	    });
	}

	function get_b_Municipality_sw(val) {
	    var municipality = (val).split(' /');
	    var dataString = 'municipalityBname=' + municipality[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "barangay.php",
	        data: dataString,
	        success: function(data) {
	            $("#barangayBlist").html(data);
	        }
	    });
	}

	function get_b_Barangay_sw(val) {
	    var barangay = (val).split(' /');
	    var dataString = 'barangayBname=' + barangay[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        async: false,
	        data: dataString,
	        dataType: "json",
	        success: function(data) {
	            $("#districtBlist").html(data)
	        }
	    });
	}

	//---------------------------------------------------------------------------------------------------------------------------------------------------

	function get_admin_Region(val) {
	    var region = (val.value).split(' /');
	    var dataString = 'regionCname=' + region[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceClist").html(data)
	        }
	    });
	}

	function get_admin_Province(val) {
	    var province = (val.value).split(' /');
	    var dataString = 'provinceCname=' + province[1];
	    console.log(dataString);
	    $.ajax({
	        type: "POST",
	        url: "municipality.php",
	        data: dataString,
	        success: function(data) {
	            $("#municipalityClist").html(data);

	        }
	    });
	}