$("#sameadd").click(function() {
	var a= 	document.getElementById('house').value;
	var b= 	document.getElementById('street').value;
	var c= 	document.getElementById('subd').value;
	var d= 	document.getElementById('brgy').value;
	var e= 	document.getElementById('city').value;
	var f= 	document.getElementById('prov').value;
			document.getElementById("house2").value = a;
			document.getElementById("street2").value = b;
			document.getElementById("subd2").value = c;
			document.getElementById("brgy2").value = d;
			document.getElementById("city2").value = e;
			document.getElementById("prov2").value = f;
});

$("#sssbut").click(function() {
  $("#ssstext").attr('disabled', !$("#ssstext").attr('disabled'));
  document.getElementById("ssstext").value = "None";
});

$("#gsisbut").click(function() {
  $("#gsistext").attr('disabled', !$("#gsistext").attr('disabled'));
  document.getElementById("gsistext").value = "None";
});
$("#pgbgbut").click(function() {
  $("#pgbgtext").attr('disabled', !$("#pgbgtext").attr('disabled'));
  document.getElementById("pgbgtext").value = "None";
});  
  $("#phlhltbut").click(function() {
  $("#phlthlttext").attr('disabled', !$("#phlthlttext").attr('disabled'));
  document.getElementById("phlthlttext").value = "None";
});



