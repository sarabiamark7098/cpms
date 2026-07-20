$(document).ready(function(){
    $('#search').keyup(function(){
        var txt = $('#search').val();
            $.ajax({
                type: "post",
                url: "../php/fetch.php",
                data: {search:txt},
                success: function(html){
                    $('#result').html(html).show();
                }
            });
    });
});
$('.region-select').on('change', function() {
	  var name = this.value;
	  var dataString = 'rid=' + name;
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
			},
			error: function(err) {
			}
		});
})
$('.province_select').on('change', function() {
	  var name = this.value;
	  var dataString = 'pid=' + name;
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
			},
			error: function(err) {
			}
		});
})
$('.municipality-select').on('change', function() {
	  var name = this.value;
	  var dataString = 'mid=' + name;
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
			},
			error: function(err) {
			}
		});
})
