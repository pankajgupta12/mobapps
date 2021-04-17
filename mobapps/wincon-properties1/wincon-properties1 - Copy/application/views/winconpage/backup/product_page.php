	<!-- Page Banner ______________________ -->
			<div class="page-banner">
				<div class="opacity">
					<div class="conatiner">
						<h3>Property View</h3>
						<span></span>
					</div>
				</div> <!-- /.opacity -->
			</div> <!-- /.page-banner -->
			<!-- Featured Properties ________________ -->
			<div class="featured-properties wow fadeInUp inner-page-fix product_page" style="visibility: visible; animation-name: fadeInUp;">
				<div class="container">
	        		<div class="row" id="mixitUp-item">
	        			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mix land villa" style="display: inline-block;" data-bound="">
	        				<div class="single-item">
	        					<div class="img-holder">
	        						<img src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="House" />
	        						<div class="opacity tran3s"><a class="myImg"><span><i class="fa fa-chain" aria-hidden="true"></i></span></a></div>
	        					</div> <!-- /.img-holder -->        					
	        				</div> <!-- /.single-item -->
							<div class="thumb">	
								<div class="img-holders">	
									<img class="myImg" src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="House">	
								</div>				
								<div class="img-holders">	 
									<img class="myImg" src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="House">
								</div>	
								<div class="img-holders">	
									<img class="myImg" src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="House">
								</div>
							</div>							
	        			</div>						
						<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
							<div class="single-item"> 
								<h6 class="p-color-bg">Sweet Home</h6>
								<span><b>Price:</b> $16,000</span>
								<div class="text">								
								<p>Sweet Home is a 1989 survival horror role-playing video game developed and published by Capcom for the Family Computer. It is based on the Japanese. Free interior design software. Draw the plan of your home or office, test furniture layouts and visit the results in 3D. Sweet Home 3D download. Sweet Home 3D 2016-11-16 23:44:13 free download. Sweet Home 3D An interior design application to draw.</p>
								<ul>
								<li><i class="fa fa-bed" aria-hidden="true"></i> <span>6</span> bedroom</li>
								<li><i class="fa fa-inbox" aria-hidden="true"></i> <span>5</span> bathroom</li>
								<li><i class="fa fa-table" aria-hidden="true"></i><span>210</span>sqft</li>
								</ul>
								<span><i class="fa fa-map-marker" aria-hidden="true"></i> 1200 Anastasia Area Coral Gables, FL</span>
								</div>	        	
							</div> <!-- /.single-item -->	       
						</div>	
						
						<!-- The Modal -->
						<div id="myModal" class="modal">
							<span class="close">×</span>
								<div class="slider-section_product_page">
									  <img class="mySlides" src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="image1" />
									  <img class="mySlides" src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" alt="image2" />
									  <img class="mySlides" src="<?php echo base_url(); ?>files/images/home/2.jpg" alt="image3" />
									  <img class="mySlides" src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" alt="image2" />
									  <div class="control_icon">
										<a class="display-left" onclick="plusDivs(-1)">&#10094;</a>
										<a class="display-right" onclick="plusDivs(1)">&#10095;</a>
									  </div>
								</div>								
						</div>
						
						
	        		</div> <!-- /#mixitUp-item -->
				</div>
			</div> <!-- /.featured-properties -->	
			<script>
			var slideIndex = 1;
			showDivs(slideIndex);

			function plusDivs(n) {
				showDivs(slideIndex += n);
			}

			function showDivs(n) {
				var i;
				var x = document.getElementsByClassName("mySlides");
				if (n > x.length) {slideIndex = 1}
				if (n < 1) {slideIndex = x.length} ;
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";
				}
				x[slideIndex-1].style.display = "block";
			}
			</script>	