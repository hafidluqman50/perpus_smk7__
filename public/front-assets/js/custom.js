$(function(){
	//======= ANIMATION SCROLL ========//
	AOS.init();
	//======= END ANIMATION SCROLL ========//
	
	//======= TOGGLE RESPONSIVE =========//
	$('.navbar-burger').on('click',function(){
		$('#navMenuExample').slideToggle(200);
	});
	//======= END TOGGLE RESPONSIVE =========//

	//======== IMAGE SHOW ========//
	  $("#image").change(function(){
		var file = document.getElementById("image").files[0];
		var readImg = new FileReader();
		readImg.readAsDataURL(file);
		readImg.onload = function(e) {
			$('#uploadPreview').attr('src',e.target.result).fadeIn();
		}
	  });
	//======== END IMAGE SHOW ========//

	//======== SHOW PASSWORD JS ========//
	 if ($('#pinjam').is(':checked')) {
			$('button[type="submit"]').attr('disabled',false);
	  }
	  $('#pinjam').on('click',function(){
	  	if ($(this).is(':checked')) {
	  		$('button[type="submit"]').attr('disabled',false);
	  	}
	  	else {
	  		$('button[type="submit"]').attr('disabled',true);	
	  	}
	  });
	  //======= END SHOW PASSWORD JS =========//

	  //====== AJAX SEARCHING BUKU ========//

	  $('button[name="daguy"]').click(function(){
	  	// var i = 0;
		var cari       = $('input[name="cari"]').val();
		var order_buku = $('select[name="order-buku"]').val();
		var getUrl     = window.location.origin+'/ajax/cari-buku/'+cari+'/'+order_buku;
	  	if (cari != '') {
		  	$.ajax({
		  		url: getUrl,
	  			timeout:50000,
		  		beforeSend: function() {
		  			$('.loading-page').show();
		  			$('body').css({overflow:'hidden'});
		  		},
		  		success: function(done) {
		  			$('.loading-page').delay(600).fadeOut();
		  			$('body').css({overflow:'scroll'});
		  			for (var i = 0; i < done.length; i++) {
		  				console.log(done[i].judul_buku);
		  			}
		  		},
		  		error: function(error) {
		  			console.log(error);
		  			$('.loading-page').delay(600).fadeOut(function(){
					    $('.error').show().animate({
					        right:'10px'
					    },300);
					    $('.error-box:first-child').show().animate({
					        right:'10px'
					    },300).delay(5000).fadeOut();
		  			});
		  			$('body').css({overflow:'scroll'});
		  		}
		  	});
		  }
	  });
	  //======== END AJAX SEARCHING BUKU =========//

	  //======= AJAX ORDER BUKU ======//
	  $('select[name="order-buku"]').change(function(){
			var cari       = $('input[name="cari"]').val();
			var order_buku = $(this).val();
			var getUrl     = '';
			if (cari != '') {
				getUrl = window.location.origin+'/ajax/order-buku/'+order_buku+'/'+cari;
			} else {
				getUrl = window.location.origin+'/ajax/order-buku/'+order_buku;
			}
			$.ajax({
				url: getUrl,
	  			timeout:20000,
		  		beforeSend: function() {
		  			$('.loading-page').show();
		  			$('body').css({overflow:'hidden'});
		  		},
		  		success: function(done) {
		  			console.table(done);
		  			$('.loading-page').delay(600).fadeOut();
		  			$('body').css({overflow:'scroll'});
		  		},
		  		error: function(XHR) {
		  			var message = XHR.statusText;
		  			$('.loading-page').delay(600).fadeOut(function(){
					    $('.error').show().animate({
					        right:'10px'
					    },300);
					    $('.error-box:first-child').show().animate({
					        right:'10px'
					    },300).delay(5000).fadeOut();
					    $('.error-box p').html(message);
		  			});
		  			$('body').css({overflow:'scroll'});
	  			}
			});
	  });
	  //====== END AJAX ORDER BUKU =====//

	  //======= WISHLIST =======//
	  $('.notif-wishlist').click(function(){
		var buku    = $(this).attr('data-buku');
		var anggota = $(this).attr('data-anggota');
	  	var getUrl  = window.location.origin+'/ajax/buku-wishlist/'+buku+'/'+anggota;
	  	if ((typeof buku !== typeof undefinied && buku !== false) && (typeof anggota !== typeof undefinied && anggota !== false)) {
	  		$.ajax({
	  			url: getUrl,
	  			timeout:50000,
	  			beforeSend: function() {

	  			},
	  			success: function(success) {

	  			},
	  			error: function(error) {

	  			}
	  		})
	  	}
	  });
	  //======= END WISHLIST =======//
});