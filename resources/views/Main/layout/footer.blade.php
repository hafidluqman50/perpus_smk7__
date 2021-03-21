</div>
</body>
</html>
  <script type="text/javascript" src="{{ asset('/front-assets/js/jquery-3.2.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/front-assets/js/slick/slick.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/front-assets/aos/aos.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/front-assets/js/notif.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/front-assets/js/slider.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/front-assets/js/custom.js') }}"></script>
  <script>
  	$(function(){
		  $(".btn-drop").click(function(e){
		    e.preventDefault();
		    var element = $(this);
		    element.next(".drop-menu").slideToggle(100);
		  });
		  
		  $(window).click(function(e){
		    if (!e.target.matches(".btn-drop")) {
		      if ($(".drop-menu").slideToggle(100)) {
		        $(".drop-menu").css("display","none");
		      }
		    }
		  });
  	});
  </script>