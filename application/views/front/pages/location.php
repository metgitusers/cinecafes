<div class="banner">

	<div class="banner-left">
		<!-- <?php if($this->session->flashdata('success_message')) { ?>
              <h6 class="alert alert-success">
                  <?php echo $this->session->flashdata('success_message'); ?>
              </h6>
      <?php } ?> -->
		<div id="slider-for">
			<?php if($list){ foreach($list as $value){?>
		  	<div>
		  		<img src="<?=FRONTFILEPATH.'backendadmin/public/upload_images/banner/'.$value['banner_image']?>" />
		  	</div>
		  	<?php } }?>
		  <!-- <div>
		  	<img src="<?=base_url('assets/image/KALI_ANNKHEA_BANNER.jpg')?>" />
		  </div>
		  <div>
		  	<img src="<?=base_url('public/assets/image/deep-blue-sea-3.jpg')?>" />
		  </div>
		  <div>
		  	<img src="<?=base_url('public/assets/image/banner-img.jpg')?>" />
		  </div>
		  <div>
		  	<img src="<?=base_url('public/assets/image/pushpa_banner.jpg')?>" />
		  </div> -->
		</div>
	</div>
	
	<div class="shape-1">
		<img src="<?=base_url('public/assets/image/shape-1.png')?>">
	</div>
	<div class="shape-2">
		<img src="<?=base_url('public/assets/image/shape-2.png')?>">
	</div>
</div>



<div class="multiple-location">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="location-box">
					<h4>Cinecafe Sec V</h4>
					<p>
						SRIJAN CORPORATE PARK, Plot No GP 2, Retail Space, Street Number 4, Sector V, Bidhannagar, Kolkata, West Bengal 700091
					</p>
					<p><b>Phone :</b> <a href="tel:062908 21850">062908 21850</a></p>
					
					<p><b>Opens At :</b> 11.00 AM</p>
					<p><b>Closes At :</b> 10.00 PM</p>
					<a href="#">View Details</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="location-box">
					<h4>Cine Cafes Salt Lake Sector 2</h4>
					<p>
						 CG-193, CG Block, Sector II, Bidhannagar, Kolkata, West Bengal 700091
					</p>
					<p><b>Phone :</b> <a href="tel:081007 86623">081007 86623</a></p>
					
					<p><b>Opens At :</b> 11.00 AM</p>
					<p><b>Closes At :</b> 10.00 PM</p>
					<a href="#">View Details</a>
				</div>
			</div>
		</div>
	</div>
</div>


 