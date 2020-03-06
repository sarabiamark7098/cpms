//AJAX
$(document).ready(function(){
    $('#search').keyup(function(){  //On pressing a key on "Search box". This function will be called
        var txt = $('#search').val(); //Assigning search box value to javascript variable.
         //Validating, if "name" is empty.
            $.ajax({
                type: "post", //method to use
                url: "../php/fetch.php", //ginapasa  sa diri nga file and data
                data: {search:txt}, //mao ni nga data
                success: function(html){  //If result found, this funtion will be called.
                    $('#result').html(html).show();  //Assigning result to "result" div.
                }
            });
    });
});
$('.region-select').on('change', function() {
	  var name = this.value;
	  var dataString = 'rid=' + name;
	  console.log(dataString);
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
				console.log(data);
			},
			error: function(err) {
				console.log(err);
			}
		});  
})
$('.province_select').on('change', function() {
	  var name = this.value;
	  var dataString = 'pid=' + name;
	  console.log(dataString);
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
				console.log(data);
			},
			error: function(err) {
				console.log(err);
			}
		});  
})
$('.municipality-select').on('change', function() {
	  var name = this.value;
	  var dataString = 'mid=' + name;
	  console.log(name);
		$.ajax({
			type: "GET",
			url: "PSGCPage.php",
			data: dataString,
			cache: false,
			success: function (data) {
				console.log(data);
			},
			error: function(err) {
				console.log(err);
			}
		});  
})

