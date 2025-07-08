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

	function clearFields(...ids) {
		ids.forEach(id => {
			const el = document.getElementById(id);
			if (el) el.value = '';
		});
	}

	//---------------------------------------------------------------------------------------------------------------------------------------------------
	function get_c_Region(val) {
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'regionCname=' + parts[1];
	    console.log(dataString);
		clearFields('cprov', 'client_city', 'cbrgy', 'client_district', 'cstr');
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
				$("#provinceClist").html(data);
	        }
	    });
	}

	function get_c_Province(val) {
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'provinceCname=' + parts[1];
	    console.log(dataString);
		clearFields('client_city', 'cbrgy', 'client_district', 'cstr');
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
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'municipalityCname=' + parts[1];
	    console.log(dataString);
		clearFields('cbrgy', 'client_district', 'cstr');
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
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'barangayCname=' + parts[1];
	    console.log(dataString);
		clearFields('client_district', 'cstr');
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
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'regionBname=' + parts[1];
	    console.log(dataString);
		clearFields('bprov', 'beneficiary_city', 'bbrgy', 'beneficiary_district', 'bstr');
	    $.ajax({
	        type: "POST",
	        url: "province.php",
	        data: dataString,
	        success: function(data) {
	            $("#provinceBlist").html(data);
	        }
	    });
	}

	function get_b_Province(val) {
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'provinceBname=' + parts[1];
	    console.log(dataString);
		clearFields('beneficiary_city', 'bbrgy', 'beneficiary_district', 'bstr');
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
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'municipalityBname=' + parts[1];
	    console.log(dataString);
		clearFields('bbrgy', 'beneficiary_district', 'bstr');
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
		const raw = val.value.trim() || val.getAttribute("value") || "";
		const parts = raw.split(/\s*\/\s*/);
	    var dataString = 'barangayBname=' + parts[1];
	    console.log(dataString);
		clearFields('beneficiary_district', 'bstr');
	    $.ajax({
	        type: "POST",
	        url: "district.php",
	        data: dataString,
	        success: function(data) {
	            $("#beneficiary_district").html(data)
	        }
	    });
	}
	