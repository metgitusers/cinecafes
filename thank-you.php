<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="assets/img/favicon.ico">
<title>Cine Cafes</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">


<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="all" href="assets/css/stellarnav.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

<!-- for Gallery-->
<link href="assets/css/simplelightbox.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/demo.css" rel="stylesheet" type="text/css">



<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body role="document">
<!-- Navbar Start -->

<header>
	<div class="header_top c">
		<div class="container">
			<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 header_left">
				<div class="row">
					<div class="top_contact">
					<ul class="con_list">
						<li><a href="tel:9181000 01001 "><i class="fa fa-phone"></i> Call +91 7827633006</a></li>
						<!--<li><a href=""><i class="fa fa-map-marker"></i> 118 Main abcd Road</a></li>-->
					</ul>
				</div>
				</div>
			</div> 
			<div class="col-lg-6 col-md-6 col-sm-6 header_right">
				<div class="row">
				<div class="header_right">
				<!--<div class="be_franshise"><a class="blink_me" href=""  data-toggle="modal" data-target="#be_franshise_panel"><img src="assets/img/befranchise.png" alt="">be a franchise</a></div>	-->				
				<div class="social_area">
            <ul class="social-network social-circle">
              <li><a href="https://www.facebook.com/CineCafes/" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/CafesCine" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              
              <li><a href="https://www.instagram.com/cinecafes/" class="instagram" title="instagram"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
          </div>

				</div>
			</div>

		
			</div>
		</div>
	</div>
	
</header>

<section class="welcome_area" id="about">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 wel_com_txt">
				<div class="row">
					<h3 style="color: green; text-align: center; font-size: 30px;">Thank You For Contcat With Us </h3>
			    </div>
			</div>
		</div>
	</div>
	
</section>
<footer id="contact">
	<div id="big_footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 headline">
			
			<h4><a href="index.php"><img src="assets/img/footer_logo.png" alt=""></a></h4>

			</div>
			
				<div class="col-sm-12 copy_text">
					<p>&copy; 2020 <a href="">Cine Cafes</a>. All rights reserved. Design by <a href="https://www.fitser.com/" target="_blank">Fitser</a>.</p>
				</div>
				
			</div>
			
			
			</div>
		</div>
	</div>
</footer>
<!-- Bootstrap core JavaScript --> 
<script src="assets/js/jquery.1.11.3.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/owl.carousel.js"></script> 	
<script src="assets/js/theme.js"></script> 
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript" src="assets/js/stellarnav.min.js"></script>
<!-- For Gallery-->
<script type="text/javascript" src="assets/js/simple-lightbox.js"></script> 
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.stellarnav').stellarNav({
				theme: 'dark'
			});
		});
	</script>


<!-- Bootstrap core JavaScript --> 
<script src="assets/js/jquery-3.4.1.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/theme.js"></script> 
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 



<script>
	var videoPlayButton,
	videoWrapper = document.getElementsByClassName('video-wrapper')[0],
    video = document.getElementsByTagName('video')[0],
    videoMethods = {
        renderVideoPlayButton: function() {
            if (videoWrapper.contains(video)) {
				this.formatVideoPlayButton()
                video.classList.add('has-media-controls-hidden')
                videoPlayButton = document.getElementsByClassName('video-overlay-play-button')[0]
                videoPlayButton.addEventListener('click', this.hideVideoPlayButton)
            }
        },

        formatVideoPlayButton: function() {
            videoWrapper.insertAdjacentHTML('beforeend', '\
                <svg class="video-overlay-play-button" viewBox="0 0 200 200" alt="Play video">                    <circle cx="100" cy="100" r="90" fill="none" stroke-width="9" stroke="#fff"></circle>                    <polygon points="70, 55 70, 145 145, 100" fill="none" stroke-width="11" stroke="#fff"></polygon>                </svg>\
            ')
        },

        hideVideoPlayButton: function() {
            video.play()
            videoPlayButton.classList.add('is-hidden')
            video.classList.remove('has-media-controls-hidden')
            video.setAttribute('controls', 'controls')
        }
	}

videoMethods.renderVideoPlayButton()
</script>
	
</body>
</html>
