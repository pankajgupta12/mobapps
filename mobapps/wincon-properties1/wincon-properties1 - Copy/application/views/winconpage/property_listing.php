<?php 

  function limit_text($text, $len) {
        if (strlen($text) < $len) {
            return $text;
        }
        $text_words = explode(' ', $text);
        $out = null;


        foreach ($text_words as $word) {
            if ((strlen($word) > $len) && $out == null) {

                return substr($word, 0, $len) . ".....";
            }
            if ((strlen($out) + strlen($word)) > $len) {
                return $out . "...";
            }
            $out.=" " . $word;
        }
        return $out;
    }

?>
<!-- Page Banner ______________________ -->
			<div class="page-banner">
				<div class="opacity">
					<div class="conatiner">
						<h3>Property Listing</h3>
						<span></span>
					</div>
				</div> <!-- /.opacity -->
			</div> <!-- /.page-banner -->


			<!-- Page Breadcrumb __________________ -->
			<div class="page-breadcrum">
				<div class="container">
					<ul>
						<li><a href="#">Home</a></li>
						<li>/</li>
						<li class="active">property listing</li>
					</ul>
				</div> <!-- /.container -->
			</div> <!-- /.page-breadcrum -->

			<!-- Featured Properties ________________ -->
			<div class="featured-properties wow fadeInUp inner-page-fix" style="visibility: visible; animation-name: fadeInUp;">
				<div class="container">
							
					<div class="mixitUp-menu">
	        			<ul>
                      <?php if(!empty($property_type)){ ?>
	        				<li class="filter tran3s active" data-filter="all">All</li>
						<?php 
						  
						    foreach($property_type as $key=>$propertytypedata)  {
							   
								if($propertytypedata->property_type == '1'){
									$property_typedata = "Apartments";
								}else if($propertytypedata->property_type == '2'){
									$property_typedata = "Land/Plot";
								}else if($propertytypedata->property_type == '3'){
									$property_typedata = "Residential";
								}else if($propertytypedata->property_type == '4'){
									$property_typedata = "Villa";
								}
						 ?>	
	        				<li class="filter tran3s active" data-filter=".<?php echo $propertytypedata->property_type; ?>"><?php echo $property_typedata; ?></li>
						  <?php  } }else {?>
						  <li class="filter tran3s active" style="background: #03867c;color: #fff;">Comming Soon..</li>
						  <?php } ?>
	        			</ul>
						
						<ul class="add_menu">	
						  <li class="add_property_list active" id="add_property_btn">
						    <i class="fa fa-building-o" aria-hidden="true">&nbsp;</i> Add property list
						  </li>							
						</ul>
						
	        		</div> <!-- End of .mixitUp-menu -->

					<?php // print_r($property_data); ?>
					
					
	        		<div class="row" id="mixitUp-item">
					  <?php 
					    if(!empty($property_data)){
					    $j = 0; 
					foreach($property_data as $property_listing) {
					    $properties_Imgdata = explode(",",$property_listing->properties_img);
					 
					 //$data['property'] = array('1'=>'Apartments','2'=>'Land/Plot','3'=>'Residential','4'=>'Villa');

					   if($property_listing->property_type == 1){
							$show = "1";
						}else if($property_listing->property_type == 2){
							$show = "2";
						}else if($property_listing->property_type == 3){
							$show = "3";
						}else if($property_listing->property_type == 4){
							$show = "4";
						}
					  $properties_id = base64_encode(base64_encode(base64_encode($property_listing->properties_id)));
					    ?>
	        			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mix <?php echo $show; ?>" style="display: inline-block;" data-bound="">
						
	        				<div class="single-item">
	        					<div class="img-holder">
	        						<img src="<?php echo base_url(); ?>files/propertiesfile/<?php echo $properties_Imgdata[0]; ?>" alt="House">
	        						<div class="opacity tran3s"><a href="<?php echo base_url('wincon/product_page/'.$properties_id); ?>"><span><i class="fa fa-chain" aria-hidden="true"></i></span></a></div>
	        					</div> <!-- /.img-holder -->
	        					<h6 class="p-color-bg"><a href="#"><?php echo limit_text(ucfirst($property_listing->property_name),10); ?></a><span><?php echo $property_listing->property_price; ?></span></h6>
	        					<div class="text">
	        						<p><?php echo limit_text($property_listing->description,40); ?> </p>
	        						<ul>
	        							<li><i class="fa fa-bed" aria-hidden="true"></i> <span><?php echo $property_listing->property_bathroom; ?></span>bedroom</li>
	        							<li><i class="fa fa-inbox" aria-hidden="true"></i> <span><?php echo $property_listing->property_size; ?></span>Size</li>
	        							<li><i class="fa fa-table" aria-hidden="true"></i><span><?php echo $property_listing->property_sqft; ?></span>Sq/Ft</li>
	        						</ul>
	        						<span><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $property_listing->property_address; ?></span>
	        					</div>
	        				</div> <!-- /.single-item -->
	        			</div>
						<?php $j++; } }else { ?>
						
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 commingsoon" style="display: inline-block;" data-bound="">
	        				 <p>You have no property list..<p>
	        			</div>
						<?php } ?>	
						
	        		</div> <!-- /#mixitUp-item -->
				</div> 
			</div> <!-- /.featured-properties -->	
		
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 add_pop_up" id="add_property" style="display:none;">	
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

			
			<script>
			
			 $(document).ready(function (e){
				$("#add_properties").on('submit',(function(e){
				e.preventDefault();
				 var url = '<?php echo base_url(); ?>wincon/add_properties';
				$.ajax({
							url: url,
							type: "POST",
							dataType: 'json',
							data:  new FormData(this),
							contentType: false,
							cache: false,
							processData:false,
				
				         success: function(resp){
								  if(resp.done==='success'){
								       location.reload();
									   // $('#msg').show();
							       } else {
								   //alert(resp);
								  $.each(resp, function(i, v) {
									 // console.log(i + " => " + v); 
								  // alert(i + " => " + v);
									  var msg = '<span class="error_msg" style="color:red" for="'+i+'">'+v+'</span>';
									 
									  $('input[id="' + i + '"], select[name="' + i + '"],textarea[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').after(msg);
									  
								  });
								  var keys = Object.keys(resp);
								  $('input[name="'+keys[0]+'"]').focus();
							  }
							  return false;
				        },
				      error: function(){} 	        
				    });
				
			  }
			));
        });
			
					
			function resetErrors() {
				$('form input, form select').removeClass('inputTxtError');
				$('span.error_msg').remove();
			} 
		
		   
		   var integer_only_warned = false;
				function integersOnly(obj) {
					var value_entered = obj.value;
					if (!integer_only_warned) {
						if (value_entered.indexOf(".") > -1) {
							alert('Please enter an integer only. No decimal places.');
							integer_only_warned = true;
							obj.value = value_entered.replace(/[^0-9]/g,'');
						}
					}
					obj.value = value_entered.replace(/[^0-9]/g,'');        
                }
				
		function readURLs(input) {
		var files = $('#uploadimage')[0].files; //where files would be the id of your multi file input
//or use document.getElementById('files').files;
  //alert(files);
				for (var i = 0, f; f = files[i]; i++) {

					var reader = new FileReader();

					reader.onload = function (e) {
						$('#main_img'+i)
						.attr('src', e.target.result)
						.css("display","block");
					};

					reader.readAsDataURL(f);

				}
		}
		
	    window.preview = function (input) {
			
			//alert(input.files);
					if (input.files && input.files[0]) {
						$(input.files).each(function () {
							var reader = new FileReader();
							reader.readAsDataURL(this);
							reader.onload = function (e) {
								/* $('#main_img1').attr('id','');
								$('#main_img1').attr('id','main_img1'); */
								//$('#main_img1 li').remove(); 
								$("#main_img1").append("<li><img src='" + e.target.result + "'></li>");
								$('#bigimage').hide();
								//$('.main_img3').hide();
								$("ul").find(".main_img3").hide();
								// var id = $("ul#someList li:first").attr("id"); uploadicon 
							}
						});
					}
				}
	
			
		function profileimagevalidation(file) {
			  
			      imgpath1=document.getElementById('uploadimage');
				 
				  //var imagename =  imgpath1.files[0].name;
				 //  alert(imagename);
				 var totalimage = imgpath1.files.length;
			if(totalimage < 6) {
				  
				   /*   if(files.length > 10){
				   alert("you can select max 10 files."); */
					var ext = file.split(".");
					ext = ext[ext.length-1].toLowerCase();      
					var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

					if (arrayExtensions.lastIndexOf(ext) == -1) {
						alert("Wrong extension type.");
						 $("#uploadimage").val("");
					}
					
					imgpath=document.getElementById('uploadimage');
				//	alert(imgpath);
					var img=imgpath.files[0].size;
					var imagesize = img/1024;
					if(imagesize > 2048) {
						alert("Your properties image  under 2MB in size");
						 $("#uploadimage").val("");
					}
		    }else {
				 alert("you can select max 5 files.");
				  $("#uploadimage").val("");
			}
		}	
    </script>
		