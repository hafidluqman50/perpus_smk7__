$(function(){
	// IMAGE PREVIEW //
	$("#image").change(function(){
		var file = document.getElementById("image").files[0];
		var readImg = new FileReader();
		readImg.readAsDataURL(file);
		readImg.onload = function(e) {
		   $('#uploadPreview').attr('src',e.target.result).fadeIn();
		}
	});

	$('#check').click(function(event) {
		if ($(this).is(':checked')) {
			$('input[name="username"]').removeAttr('disabled');
		}
		else {
			$('input[name="username"]').attr('disabled','disabled');	
		}
	});
});