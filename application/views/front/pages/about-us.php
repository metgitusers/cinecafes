<!--
<section class="inner-banner-section">
	<img src="<?=base_url('public/assets/image/KALI_ANNKHEA_BANNER.jpg')?>">
	<div class="overlay">
                    		<div class="logo_area"><a href="index.php" class="logo"><img src="assets/img/logo.png" alt=""></a></div>
                    		
                    	</div>
	
</section>
-->

<style>
.about_txt p strong
	{
		color: #faad40;
	}
	.about_txt ul li
	{
		color: #fff;
	}
</style>


<div class="features-sec">
	<div class="container">
	<?php if(!empty($list)){
      foreach ($list as $key => $value) {
      
      ?>
		<h3><?=$value['page_name']?></h3>
		 <?php }} ?> 
	</div>
</div>

	
	<section id="about_page" class="inner_page feature-cont">
  <div class="container">
   
   <div class="row">
    <?php if(!empty($list)){
      foreach ($list as $key => $value) {
      
      ?>
<!--
      		<div class="col-sm-12 headline">
          <h1 style="text-align: center;"><?=$value['page_name']?></h1>
        </div>
-->
          
          <div class="about_txt">
           

            <p style="color:#FFF;"><?=$value['description']?></p>
            
          </div>
          
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
			       <img src="<?=base_url('public/assets/img/welcome_img.jpg')?>" alt="">
          </div>
          
      
         <?php }} ?> 
          
    </div> 
    
  </div>
</section>
 