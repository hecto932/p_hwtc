<!--Footer-->
<footer id="footer">
	<div class="holder860 clearfix">
		<p>RIF J-30060593-0 RTN 11245 Inversiones HMR, C.A</p>
		<!--Socials footer-->
		<ul class="socialsFooter">
			<li><a class="socialFacebook" href="/"><i class="icon-facebook"></i></a></li>
			<li><a class="socialTwitter" href="https://twitter.com/HESPERIAVZLA"><i class="icon-twitter-1"></i></a></li>
		</ul>
		
		<!--End socials footer-->
		
		<p><a href="http://wintech.com.ve"><img src="assets/front/images/wintech.png" width="64"/></a>&copy; 1992–2013 Wintech C.A, Todos los derechos reservados.</p>
		<br />
		<p><a id="gaceta" href="assets/front/uploads/banco_plaza.pdf">Este establecimiento es financiado por la cartera de credito para el sector turismo gracias al Gobierno Bolivariano</a>, según Resolucion 070, del Ministerio del poder Popular para el Turismo, publicada en Gaceta Oficial 40.209, del 17-07-13.</p>
		
	</div>
</footer>
<!--End footer-->
	
</div>
<!--ENd wrapper-->	
	
<!--Javascript-->
<script src="assets/front/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="assets/front/js/jquery-migrate-1.2.1.js"></script>
<script src="assets/front/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="assets/front/js/jquery.scrollTo-min.js" type="text/javascript"></script>
<script src="assets/front/js/slides.min.jquery.js" type="text/javascript"></script>
<script src="assets/front/js/waypoints.js" type="text/javascript"></script>
<script src="assets/front/js/jquery.parallax-1.1.3.js"></script>
<script src="assets/front/js/Placeholders.min.js" type="text/javascript"></script>
<script src="assets/front/js/jquery.ui.totop.min.js" type="text/javascript"></script>
<script src="assets/front/js/jquery.countdown.min.js" type="text/javascript"></script>
<script src="assets/front/js/jquery.validate.js" type="text/javascript"></script>
<script src="assets/front/js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="assets/front/js/gmaps.js" type="text/javascript"></script>




<script>

//<![CDATA[
//---------------------------------- Gmap setup -----------------------------------------//
	   var map;
	    $(document).ready(function(){


	      map = new GMaps({
	        div: '#map',
	 		lat: 10.234253400000007,
	 		lng: -68.00564200000001,
	 		zoom: 15,
	 		zoomControl : true, 
	        zoomControlOpt: { style : 'SMALL', position: 'TOP_RIGHT' },
	 		panControl : false,
	 		scrollwheel: false
	      });


		map.addMarker({
	 		lat: 10.234253400000007,
	 		lng: -68.00564200000001,
			title: 'Hotel Hesperia',
			infoWindow: {
			content: '<p>Av. Salvador Feo la Cruz, naguanagua Av 168 Salvador Feo La Cruz, Valencia 02005</p>'
			 }
		});
		
		var x = Math.floor((Math.random()*1)+1);
		//alert("url(assets/front/images/sliderImages/"+x+".jpg) no-repeat scroll 0 0px #fafafa");
		$('#teaser').css('background',"url(assets/front/images/sliderImages/"+x+".jpg) no-repeat scroll 0 0px #fafafa");
		//$('#teaser').css('background-repeat',"no-repeat");
		$('#teaser').css('background-attachment',"fixed");
		$('#teaser').css('background-position',"top");
		//$('#teaser').css('background-size',"80px 60px");
			
	});
//---------------------------------- End gmap setup -----------------------------------------//
//]]>
</script>


<!-- Google analytics -->


<!-- End google analytics -->


</body>
</html>