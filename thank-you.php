<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="assets/img/favicon.ico">
<title>Smart Systems</title>

<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">


</head>

<body role="document" class="home_bg">
<!-- Navbar Start -->
<section id="banner_area">
	<div class="container">
		<div class="row">
						<div class="col-md-12">
							<div class="row"><a href="index.php" class="logo_area"><img src="assets/img/logo.png" alt=""></a></div>
						</div>
						<div class="clearfix"></div>
		</div>
	</div>
</section>

<section class="security_sec">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-1">
				<div class="row">
					<h3>Thank You For Contcat With Us </h3>
			    </div>
			</div>
		</div>
	</div>
	
</section>
<footer>
	<div class="copy_footer">
		<div class="container">
		<p> &copy; Copyright 2020 <a href="">Smart Systems Technologies Inc</a>. All Rights Reserved.</p>
	</div>
	</div>
</footer>




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
