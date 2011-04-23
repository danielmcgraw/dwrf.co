$(function() {
	$('.error').hide();

	$(".button").click(function() {
		// validate and process form
		// first hide any error messages
		$('.error').hide();
		
		var url = $("input#url").val();
		var re = /^(www[.])?[a-zA-Z0-9]+[.]([a-zA-Z]{2,3}).*/;
		if (url == "" || !re.test(url)) {
			$('#ret_val').html('Dude... For real?').hide().fadeIn(2000, function(){});
			$("input#url").focus();
			return false;
		}
		
		var dataString = 'url=' + url;
		//alert (dataString);return false;
		
		$.ajax({
			type: "POST",
			url: "/bin/process.php",
			data: dataString,
			success: function(data) {
				//This is where I would return the new url etc.
				$('#ret_val').html(data)
				.hide()
				.fadeIn(2000, function() {
				});
			}
		});
		return false;
	});
});

runOnLoad(function(){
	$("input#url").select().focus();
});
