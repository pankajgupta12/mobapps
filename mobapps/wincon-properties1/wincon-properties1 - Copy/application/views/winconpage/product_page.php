<?php  // print_r($propertiedetails); ?>
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
			<div class="featured-properties product_page_layout wow fadeInUp inner-page-fix product_page" style="visibility: visible; animation-name: fadeInUp;">
				<div class="container">
	        		<div class="row" id="mixitUp_item_product">
	        			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mix land villa" style="display: inline-block;" data-bound="">
	        				<div class="single-item">
						<?php   	
						$properties_Imgdata = explode(",",$propertiedetails->properties_img);
						$properties_id = base64_encode(base64_encode($propertiedetails->properties_id));
						
						?>
	        					<div class="img-holder">
	        						<img src="<?php echo base_url(); ?>files/propertiesfile/<?php echo $properties_Imgdata[0]; ?>" alt="House" />
	        						<div class="opacity tran3s"><a class="myImg"><span><i class="fa fa-chain" aria-hidden="true"></i></span></a></div>
	        					</div> <!-- /.img-holder -->        					
	        				</div> <!-- /.single-item -->
							<div class="thumb">	
							<?php $i =0; foreach($properties_Imgdata as $key=>$value) { ?>
								<div class="img-holders" <?php if($i == 0) { ?> style="display:none;"<?php } ?>>	
									<img class="myImg" src="<?php echo base_url(); ?>files/propertiesfile/<?php echo $value; ?>" alt="House">	
								</div>	
                             <?php  $i++; } ?>								
								
							</div>							
	        			</div>						
						<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
							<div class="single-item"> 
								<h6 class="p-color-bg"><?php echo ucfirst($propertiedetails->property_name);  ?><span><a href="#">Edit</a>&nbsp;|&nbsp;<a style="cursor:pointer;"onclick="return deleteproperties('<?php echo $properties_id; ?>');">Delete</a></span></h6>
								
								<span><b>Price:</b> <?php echo $propertiedetails->property_price;  ?></span>
								
								<div class="text">	
									<p><?php echo $propertiedetails->description; ?></p>
									<ul>
										<li><i class="fa fa-bed" aria-hidden="true"></i> 
										  <span><?php echo $propertiedetails->property_bathroom;  ?></span> Bedroom
										</li>
										<li>
										  <i class="fa fa-inbox" aria-hidden="true"></i> <span><?php echo $propertiedetails->property_size;  ?></span> Size
										</li>
										<li>
										 <i class="fa fa-table" aria-hidden="true"></i><span><?php echo $propertiedetails->property_sqft;  ?></span>Sq|Ft
										</li>
									</ul>
									
									<span><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $propertiedetails->property_address;  ?></span>
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
					
					
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 add_pop_up" id="property_list" style="display:none;">	
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 add_property">	
			 <span id="remove_pop"><i class="fa fa-times" aria-hidden="true">&nbsp;</i></span>	
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 add_property_details">	
			 <h4>Add Property</h4>		
				<form name="add_properties" method="post" id="add_properties" enctype="multipart/form-data">			
					<div class="col-lg-6 col-md-6 col-sm-6 left">		
						<div class="left_image">			
						<img class="left-img" id="bigimage" src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" />
							<div class="upload_image">	
								<ul class="option_img" id="main_img1">
								
								 </ul>
								<ul class="option_img" id="optionimage">
									<li class="main_img3"><img src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" /></li>
									<li class="main_img3"><img src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" /></li>
									<li class="main_img3"><img src="<?php echo base_url(); ?>files/images/home/imgpsh_fullsize.png" /></li>					
								</ul>
								<ul class="upload_options">
								<li id="uploadicon">
										<label for="uploadimage"><img src="<?php echo base_url(); ?>files/images/image_add.png" /></label>
										<input id="uploadimage" accept="image/*" onChange="profileimagevalidation(this.value);preview(this);" type="file" name="properties_image[]" style="display:none;" multiple />
									</li>
								</ul>
							</div>		
						</div>						
					</div>						
					<div class="col-lg-6 col-md-6 col-sm-6 right">		
						<div class="right_image">	
								<div class="text_details">			
									<label>Select Property:<em>*</em></label>
										<select name="property_type" id="property_type">	
										   <option value="">Select Property</option>	
											<?php 
											  foreach($property as $key=>$propertylist)  {
											 ?>									
												<option value="<?php echo $key;  ?>"><?php echo $propertylist  ?></option>
											<?php } ?>										
										</select>	
								</div>
								
									<div class="text_details"><label>Property Name:<em>*</em></label>
									   <input placeholder="Property Name" type="text" name="property_name" id="property_name" />
									</div>
								 
								 <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
								 
								<div class="text_details"><label>Property Price:<em>*</em></label>
								   <input placeholder="Property price" onkeyup="integersOnly(this)" type="text" id="property_price" name="property_price" />
								</div>		
								
								<div class="text_details">
								 <label>Property Size:<em>*</em></label>		
									<div class="right_size">					
										<div class="size_select">				
											<select  name="property_size" id="property_size">								
												<option value="">Size</option>		
												<?php for($size =6; $size<12;$size++) {  ?>											
												<option value="<?php echo $size;  ?>"><?php echo $size;  ?></option>	
												<?php  } ?>		
											</select>			
										</div>	
										
										<div class="size_select">		
											<select name="property_bathroom" id="property_bathroom">				
											<option value="">Bedroom</option>	
												<?php for($bedroom =1; $bedroom<6;$bedroom++) {  ?>											
												<option value="<?php echo $bedroom;  ?>"><?php echo $bedroom;  ?></option>	
												<?php  } ?>		
											</select>			
										</div>	
										
										<div class="size_select">		
											<select name="property_sqft" id="property_sqft">				
												<option value="">SQ/FT</option>	
												 <?php for($sqft =1; $sqft<6;$sqft++) {
													 $sqsum = $sqft * 100;
												 ?>											
													<option value="<?php echo $sqsum;  ?>"><?php echo $sqsum;  ?></option>	
												<?php  } ?>	
											</select>				
										</div>					
									</div>
								</div>		
								
								<div class="text_details">
									<label>Property Address:<em>*</em></label>
									<textarea placeholder="Property Address" name="property_address" id="property_address"></textarea>
								</div>	
								
								<div class="text_details">			
									<label>Property Discription:</label>
									<textarea placeholder="Property Discription"  name="property_description" id="property_description"></textarea>
								</div>	
								
								<div class="submit_btn">		
									<input class="left" type="submit" id="submit" name="submit" value="Submit" />	
									<input class="right" type="reset" name="reset" value="Reset" />		
								</div>					
									
						</div>					
					</div>									
				  </div>
				</form>						
			</div>					
			</div>				
					
					
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
		
		<script>
			function deleteproperties(id) {
				var ask = window.confirm("Are you sure you want to delete this properties?");
				if (ask) {
					//window.alert("This post was successfully deleted.");

					document.location.href = '<?php echo base_url(); ?>wincon/delete_property/'+id;

				}
			}
	    </script>