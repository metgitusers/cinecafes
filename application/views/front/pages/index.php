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

<div class="awesome-exper">
	<div class="container">
		<h1>Awesome Experience</h1>
		<h6>Caféplex entertainment pvt. ltd. Brings one of a kind facility cine cafes, where you can enjoy your favorite movie or tv show with your favorite food in a luxury sitting.</h6>
		<div class="row">
			<?php foreach ($home_section as $key => $value) {
				
			 ?>
			<div class="col-md-3">
				<div class="experince-card">
					<img src="<?=FRONTFILEPATH.'backendadmin/public/upload_images/banner/'.$value['image']?>">
					<h3><?=$value['title']?></h3>
					<p><?=$value['content']?> </p>
				</div>
			</div>
			<?php } ?>
			<!-- <div class="col-md-3">
				<div class="experince-card">
					<img src="<?=base_url('public/assets/image/icon-2.png')?>">
					<h3>Delicious Food</h3>
					<p>Watch your favourite OTT movies, OTT </p>
				</div>
			</div> -->
			<!-- <div class="col-md-3">
				<div class="experince-card">
					<img src="<?=base_url('public/assets/image/icon-3.png')?>">
					<h3>Eclectic & Innovative</h3>
					<p>Watch your favourite OTT movies, OTT </p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="experince-card">
					<img src="<?=base_url('public/assets/image/icon-4.png')?>">
					<h3>Family Friendly</h3>
					<p>Watch your favourite OTT movies, OTT </p>
				</div>
			</div> -->
		</div>
	</div>
</div>
<!-- <div class="know-more">
	<div class="container">
		<div class="know-more-overlay">
			<div class="row align-items-center">
				<div class="col-md-9">
					<h3>Introducing an exclusive loyalty program that pays you back!</h3>
					<ul>
						<li><a href="#">Know More</a></li>
						<li><a href="#">Already A Member?</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<img src="<?//=base_url('public/assets/image/logo.png')?>">
				</div>
			</div>
		</div>
	</div>
</div> -->
<div class="gallerry-tab">
	<div class="container">
		<nav>
		  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ambience</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Food</a>
		  </div>
		</nav>
	</div>
		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  	<ul>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/1.png')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/1.png')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/2.jfif')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/2.jfif')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/9.jfif')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/9.jfif')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/18.jfif')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/18.jfif')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/41.jpeg')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/41.jpeg')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/40.jpeg')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/40.jpeg')?>">
					</a>
		  		</li>
		  	</ul>
		  	<div class="vi-more">
		  		<a href="<?=base_url('gallery')?>">View More</a>
		  	</div>
		  </div>
		  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
		  	<ul>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/1.png')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/1.png')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/2.jfif')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/2.jfif')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/9.jfif')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/9.jfif')?>">
					</a>
		  		</li>
		  		
		  	</ul>
		  </div>
		  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
		  	<ul>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/40.jpeg')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/40.jpeg')?>">
					</a>
		  		</li>
		  		<li>
		  			<a href="<?=base_url('public/assets/gal_image/41.jpeg')?>" data-fancybox="gallery">
					  <img src="<?=base_url('public/assets/gal_image/41.jpeg')?>">
					</a>
		  		</li>
		  		
		  	</ul>
		  </div>
		</div>
	
</div>
<div class="download-app">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<h2>Download Our App Now</h2>
				<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra </p> -->
				<a href="https://apps.apple.com/in/app/cine-cafes/id1543208686" target="_blank"><img src="<?=base_url('public/assets/image/app-store.png')?>"></a>
				<a href="https://play.google.com/store/apps/details?id=com.cinecafe&hl=en" target="_blank"><img src="<?=base_url('public/assets/image/play-store.png')?>"></a>
			</div>
			<div class="col-md-6">
				<div class="app-img text-right">
					<img src="<?=base_url('public/assets/image/mobile.png')?>">
				</div>
			</div>
		</div>
	</div>
</div>