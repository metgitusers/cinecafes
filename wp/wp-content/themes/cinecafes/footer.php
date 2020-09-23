<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */

?>

<footer id="contact">
	<div id="big_footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 headline">
			<a href="#banner_area" class="arrow_dwn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow_up.jpg" alt=""></a>
			<h4><a href="index.php"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/footer_logo.png" alt=""></a></h4>

			</div>
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12">
				<div class="col-sm-12">
					<ul class="footer_list">
						<li class="active"><a href="index.php">Home</a></li>
		    <li><a href="#about">About Us</a></li>
		    <li><a href="#gallery">Gallery</a></li>
		    <li class="drop-left"><a href="" type="button" data-toggle="modal" data-target="#ContactModal">Contact Us</a></li>
		    <li class="drop-left"><a href="" type="button" data-toggle="modal" data-target="#TermsModal">T & C</a></li>
		    <li class="drop-left"><a href="" type="button" data-toggle="modal" data-target="#ConditionsModal">Cancellation policy</a></li>
		    <li class="drop-left"><a href="" type="button" data-toggle="modal" data-target="#PrivacyModal">Privacy Policy</a></li>
		    <li class="drop-left"><a href="https://cinecafes.com/wp/checkout" class="pyu">Pay Now</a></li>
					</ul>
					<ul class="add_con_list">
						<!--<li><a href=""><i class="fa fa-map-marker"></i> 118 Main abcd Road</a></li>-->
						<li><a href="tel:+918100001001"><i class="fa fa-phone"></i>+91 81000 01001</a></li>
					</ul>
					
					<ul class="ftr_social_list">
					  <li><a href="https://www.facebook.com/CineCafes/" target="_blank"><i class="fa fa-facebook"></i></a></li>
					  <li><a href="https://twitter.com/CafesCine" target="_blank"><i class="fa fa-twitter"></i></a></li>
					  
					  <li><a href="https://www.instagram.com/cinecafes/" target="_blank"><i class="fa fa-instagram"></i></a></li>
					</ul>
					
				</div>
				<div class="col-sm-12 copy_text">
					<p>&copy; 2020 <a href="">Cine Cafes</a>. All rights reserved. Design by <a href="https://www.fitser.com/" target="_blank">Fitser</a>.</p>
				</div>
				
			</div>
			
			
			</div>
		</div>
	</div>
</footer>

<!-- Modal -->
<div class="modal fade" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
		<span id="msg_succ"></span>
		<span id="msg_err"></span>
      </div>
      <div class="modal-body" id="contact_page">
                  <div class="col-lg-6 col-md-6 mrg30B">
            <div class="row" id="contact_form1">
              
              <form action="" method="post">
                <div class="col-sm-6"> 
                  <div class="form-group">
                    <label>First Name</label>
                    <input id="cinecafes_fname" type="text" class="form-control" placeholder="First Name" required>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input id="cinecafes_lname" type="text" class="form-control" placeholder="Last Name">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Subject</label>
                    <input id="cinecafes_subject" type="text" class="form-control" placeholder="Subject">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Email</label> <span class="err_msg" id="error_email"></span>
                    <input id="cinecafes_email" type="text" class="form-control" placeholder="Email">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Message</label> <span class="err_msg" id="error_msg"></span>
                    <textarea id="cinecafes_msg" class="form-control" name="" id="" cols="" rows="5" placeholder="Enter Message"></textarea>
                  </div>
				  
				  
				
			
				<div class="form-group">
                    <div class="g-recaptcha" id="cinecafes_captcha" data-type="image" data-sitekey="6LfCstsUAAAAAKRYBjnCM6s5sbiXOJWIryW1w_FP"></div>
                    
                  </div>
			
			
				  
                  <div class="form-group">
                    <button id="cinecafes_submit" class="btn btn-black">Submit</button>
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-6 mrg30B">
          	
          	
           <div class="row contact_txt">
           	
           	<div class="col-sm-12">
           		 
            
           
            
            <table width="100%" border="0">
                <tbody>
                <!--<tr>
					<td width="2%"><p><i class="fa fa-map-marker"></i></p></td>
                    <td width="84%"><p><span>Address:</span> 118 Main abcd Road</p></td>
                  </tr>-->
                  <tr>
                    <td width="85"><p><i class="fa fa-map-marker"></i><span>Address:</span></p></td>
                    <td><p>ECOSPACE, ESNT 3A0501, BLOCK 3A,<br>
                    
5TH FLOOR PLOT NO. IIF/11,<br>

KOLKATA, WEST BENGAL – 700160</p></td>
                  </tr>
                <tr>
                    <td width="85"><p><i class="fa fa-phone"></i><span>Phone:</span></p></td>
                    <td><p> <a href="tel:+918100001001">+91 81000 01001</a> </p></td>
                  </tr>
                   <tr>
                    <td width="85"><p><i class="fa fa-envelope"></i><span>Email:</span></p></td>
                    <td><p><a href="mailto:info@cinecafes.com">info@cinecafes.com</a></p></td>
                  </tr>
                 
                
              </tbody>
              </table>

           	</div>
           	
           	<div class="col-sm-12">
           		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.814202942848!2d88.48884361443429!3d22.586051338169998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a020b58f22b8549%3A0xbcadc875b3213b2d!2sMet%20Technologies%20Private%20Limited!5e0!3m2!1sen!2sin!4v1598348303828!5m2!1sen!2sin" width="100%" height="240" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
           	</div>
           	
           </div>
          
      
          </div>
          <div class="clearfix"></div>

      </div>
      
    </div>
  </div>
</div>
<div class="modal fade" id="TermsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
		<span id="msg_succ"></span>
		<span id="msg_err"></span>
      </div>
      <div class="modal-body" id="contact_page">
              
              <h4>General Conditions</h4>
              <p>Cine Cafes will do everything possible to ensure the operating times of the cafes are true to the advertisements. However due to circumstances beyond Cine Cafes control there may be times that a booking has to be cancelled or rescheduled at a different time. In this instance the user may be given a refund of the hours booked only. The mode of refund shall be at the sole discretion of Cine Cafes. If any booking is cancelled or cancellation is done from the management of Cine Cafes then the formalities for the same will be taken in to consideration. The user agrees not to bring in any action against Cine Cafes in such instance.</p>
              <p>The user who has booked for a movie certified as 'A', must provide Cine Cafes with the relevant proof of entitlement upon entry to the cafe.</p>
              <h4>Warranties and Indemnification</h4>
              <p>The user represents that he/she is of sufficient legal age to use this service, and he/she possess the legal right and ability to create binding obligations for any liability he/she may incur as a result of the use of this service.</p>
              <p>The user understands that he/she is financially responsible for all uses of this service by him/her and those using his/her login information. The user will supervise all usage of the booking facility under his/her name or account.</p>
              <p>The user warrants that all information supplied by him/her and members of his/her household in using the booking facility are true and accurate.</p>
          <div class="clearfix"></div>

      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="PrivacyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Privacy Policy</h4>
		<span id="msg_succ"></span>
		<span id="msg_err"></span>
      </div>
      <div class="modal-body" id="contact_page">
              
              <h4>INTRODUCTION</h4>
              <p>Your privacy is important to CineCafes.com. We recognize that when you choose to provide us with information about yourself, you trust us to act in a responsible manner. This information helps us improve your movie going experience with better content, services and opportunities. This policy tells you about the information gathering and dissemination that we conduct. As we continue to grow, this policy may change, so please check back periodically for updates</p>
              <h4>THE INFORMATION WE COLLECT</h4>
              <p>We ask our users to register when they use the CineCafes.com. site and services (collectively, the "Service"). Through our online registration process, we collect a variety of information about the user, which may include, among other things, name of the person registering, location, gender, phone number, email address, user name and password. CineCafes.com may also request and collect other information from time to time.</p>
              <p>We automatically track information related to use of the Service. This information may include, among other things, URL tracking information, what browser the user is using, the user's IP address, pages and ads viewed by a user and selections or other actions taken on the Service. We may track usage through cookies. A cookie is a small data file written to a user's hard drive. Cookies may be used to, among other things, allow automated log-in and may contain information such as a Login ID or other information about preferences or Internet use. Third party advertisers that we work with may also place cookies on browsers of users of our Service.</p>
              <p>We also collect information about your movie preferences. For example, we may collect, among other things, information such as what movies you purchase tickets to or what theatres you attend. We may save information sent or posted to the Service. For example, we may save messages posted in our chat rooms or other message areas or feedback left for other users. We may collect correspondence, such as emails or letters, sent to us. We may collect user responses to online polls, ads, surveys, electronic newsletters and questionnaires.</p>
              <h4>DELETION OF INFORMATION AND RECORDS</h4>
              <p>While CineCafes.com. may track and store information, CineCafes.com. shall not be obligated to do so and may delete any information and records, in whole or in part, at any time</p>
              <h5><big>What we use the information for :</big></h5>
              <p>We use the demographic information to enhance your user experience by, among other things, delivering you content that is relevant to your interests. We may use the contact information you provide us to notify you of new services or special deals that we or our partners are offering, to distribute movie related information to you or to conduct surveys or other similar activities. When you register with us, you may choose to opt-out of receiving these notices or mailings from CineCafes.com at the time of registration.</p>
              <p>CineCafes.com does not sell or rent personal information about its customers to any third parties at this time. CineCafes.com does, however, perform statistical analyses of customer usage in order to measure interest in, and use of, the various parts of the Company's web site, and the Company may share that information with current and prospective advertisers, and other interested third parties. This information is aggregated data only (such as statistics), and contains no personally identifiable information whatsoever.</p>
              <p>CineCafes.com. strives to protect the personally identifiable information of the users.</p>
              <p>CineCafes.com. may disclose the personally identifiable information only on:</p>
              <p>expressed authorisation of the user to do so<br>
              the provision of the requested service demands so<br>
              requirements to comply with the governing law<br>
              opportunity to add value to the user
              
              </p>
              <p>However, CineCafes.com may share aggregated statistical information about the use of the CineCafes.com. web site with partners and associates for the purpose of research and analysis. Even in these cases, pvrcinemas.com. will strive to protect the individual users' personally identifiable information.</p>
              <p>Please note that CineCafes.com may sell, share or transfer personally identifiable information about its customers with any successor in interest (e.g. if the Company is sold to a third party). Additionally, in certain cases, pvrcinemas.com may be required to disclose your personally identifiable information when the law requires it, or in response to any demand by law enforcement authorities in connection with a criminal investigation, or civil or administrative authorities in connection with a pending civil case or administrative investigation.</p>
              <p>CineCafes.com. users should also be aware that if they voluntarily disclose personal information in any chat areas or bulletin boards within the pvrcinemas.com web site, that information might be collected and disseminated by third-parties, and result in, among other things, unsolicited inquiries, messages, and offers from third parties. This third-party conduct is out of the control of the Company.</p>
              <h4>SECURITY</h4>
              <p>CineCafes.com. has implemented security measures to protect against the loss, misuse and alteration of the information under our control. We protect the secure areas of our Site with a firewall. Although CineCafes.com has implemented adequate security measures, the site has contracted Verisign to provide an extra assurance of security. Although, the site is completely virus-free, the User is advised to employ virus scans for extra security, as CineCafes.com is not liable for any virus picked up at the time of transmission.</p>
              <h4>CHOICE/OPT-OUT</h4>
              <p>CineCafes.com. allows users the option to opt-out of receiving communications from us and our partners at registration. If you decide later to opt-out you can contact us by sending e-mail to <a href="mailto:info@cinecafes.com">info@cinecafes.com</a>.</p>
              <h4>GENERAL INFORMATION</h4>
              <p>Please note that CineCafes.com tries its best to collect data from the most authentic source. However, at any stage, pvrcinemas.com is not liable for any loss, monetary or otherwise, resulting from the usage of their data.</p>
              <h4>QUESTIONS</h4>
              <p>If you have any questions about this privacy statement, you can email us at <a href="mailto:info@cinecafes.com">info@cinecafes.com</a>.</p>
              <h4>CineCafe’s LOGO</h4>
              <p>CineCafe’s is a registered trademark of <big>CAFEPLEX ENTERTAINMENT PRIVATE LIMITED</big></p>
              
          <div class="clearfix"></div>

      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="ConditionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancellation Policy</h4>
		<span id="msg_succ"></span>
		<span id="msg_err"></span>
      </div>
      <div class="modal-body" id="contact_page">
              <p><b>The booking shall be deemed to be cancelled in the following circumstances: -</b></p>
              <ul>
                  <li>The booking is valid only for the viewing at a specified Cine Cafes. The booking shall become valueless and non-refundable if not used on the date specified on its face.</li>
                  <li>If, in the opinion of a representative of the Cine Cafes, the user is in breach of these Online Booking Terms or is under the influence of drugs or alcohol, or that it is necessary for the safety or comfort or security of other customers or for the protection of property, the representative reserves the right to refuse the entry or request the Customer to leave the cafe and may if necessary physically remove the Customer from the cafe or physically restrain the Customer.
The customer has an option to cancel online on cinecafes mobile App on the terms as mentioned herein-below. However, no ticket and F& B cancellation will be entertained once patron enters the cafe premises.
</li>
              </ul>
              <ul class="cancellation_list">
                  <li>No cancellation will be allowed within 20 minutes of booked time.</li>
                  <li>For bookings cancelled 2 hours before start time, 75% of ticket value and 100% of F&B value will be refunded</li>
                  <li>For bookings cancelled from 20 mins to 2 hours before show start time, 50% of ticket value, 100% of F&B value will be refunded</li>
                  <li>In case of F&B booking (without ticket) through any mode, there is no cancellation available.</li>
                  <li>No refund will be given for booking done through or amount paid by Gift card/Voucher/Promo. Also booking cancellation cannot be applied/clubbed on a booking done through or an offer given by us or facilitate for business partner.</li>
                  <li>No partial cancellation is allowed. The patron will have to cancel the complete transaction.</li>
                  <li>Convenience fee and taxes applicable thereon will not be refunded in case of cancellation</li>
                  <li>The refund for the cancelled ticket will be processed in minimum 7 working days.</li>
                  
              </ul>
              
          <div class="clearfix"></div>

      </div>
      
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript --> 
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.1.11.3.min.js"></script> 
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/bootstrap.min.js"></script> 
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/owl.carousel.js"></script> 	
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/theme.js"></script> 
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/stellarnav.min.js"></script>
<!-- For Gallery-->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/simple-lightbox.js"></script> 
<script src='https://www.google.com/recaptcha/api.js' async defer></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.stellarnav').stellarNav({
				theme: 'dark'
			});
		});
	</script>
	
	<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
		  
		  
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
		  
      });
    } // End if
  });
});
</script>

<script>
	$(function(){
		var $gallery = $('.gallery a').simpleLightbox();

		$gallery.on('show.simplelightbox', function(){
			console.log('Requested for showing');
		})
		.on('shown.simplelightbox', function(){
			console.log('Shown');
		})
		.on('close.simplelightbox', function(){
			console.log('Requested for closing');
		})
		.on('closed.simplelightbox', function(){
			console.log('Closed');
		})
		.on('change.simplelightbox', function(){
			console.log('Requested for change');
		})
		.on('next.simplelightbox', function(){
			console.log('Requested for next');
		})
		.on('prev.simplelightbox', function(){
			console.log('Requested for prev');
		})
		.on('nextImageLoaded.simplelightbox', function(){
			console.log('Next image loaded');
		})
		.on('prevImageLoaded.simplelightbox', function(){
			console.log('Prev image loaded');
		})
		.on('changed.simplelightbox', function(){
			console.log('Image changed');
		})
		.on('nextDone.simplelightbox', function(){
			console.log('Image changed to next');
		})
		.on('prevDone.simplelightbox', function(){
			console.log('Image changed to prev');
		})
		.on('error.simplelightbox', function(e){
			console.log('No image found, go to the next/prev');
			console.log(e);
		});
	});
	
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
	
$(document).ready(function(){
	
	$('#cinecafes_submit').click(function(e){
		e.preventDefault();
		//alert('submit');
		
		$('.form-control').removeClass('required_field');
		
		var cinecafes_fname = $('#cinecafes_fname').val();
		var cinecafes_lname = $('#cinecafes_lname').val();
		var cinecafes_subject = $('#cinecafes_subject').val();
		var cinecafes_email = $('#cinecafes_email').val();
		var cinecafes_msg = $('#cinecafes_msg').val();
		var g_recaptcha_response = $('#g-recaptcha-response').val();
		
		var is_submit = 0;
		
		if(cinecafes_msg.trim() == ''){
			$('#error_msg').html('This Field is Required');
			$('#cinecafes_msg').addClass('required_field');
			$('#cinecafes_msg').focus();
		} else {
			$('#error_msg').html('');
			$('#cinecafes_msg').removeClass('required_field');
			is_submit++;
		}
		
		if(cinecafes_email == ''){
			$('#error_email').html('This Field is Required');
			$('#cinecafes_email').addClass('required_field');
			$('#cinecafes_email').focus();
		} else if(!validateEmail(cinecafes_email)) {
			$('#error_email').html('Invalid Email Id');
			$('#cinecafes_email').addClass('required_field');
			$('#cinecafes_email').focus();
		} else {
			$('#error_email').html('');
			$('#cinecafes_email').removeClass('required_field');
			is_submit++;
		}
		
		
		
		if(is_submit == 2){
			
			
			
			$.ajax({
			  method: "POST",
			  url: "ajax.php",
			  data: { 'action' : 'form_submit_act', 'fname' : cinecafes_fname, 'lname' : cinecafes_lname, 'subject' : cinecafes_subject, 'email' : cinecafes_email, 'msg' : cinecafes_msg, 'recaptcha' : g_recaptcha_response },
			  success: function(result) { 
								//$("#succ").html(result); 
								
								if(result == 'success'){
									$("#msg_err").html('');
									$("#msg_succ").html('Thank you for contacting us. We will contact you shortly.');
									
									$('#cinecafes_fname').val('');
									$('#cinecafes_lname').val('');
									$('#cinecafes_subject').val('');
									$('#cinecafes_email').val('');
									$('#cinecafes_msg').val('');
									grecaptcha.reset();
								} else if(result == 'captcha') {
									$("#msg_succ").html('');
									$("#msg_err").html('Please Check the Captcha');
								} else {
									$("#msg_succ").html('');
									$("#msg_err").html('Sorry! There is some Problem.');
								}
								
							}
			  //dataType: "script"
			});
			
			
			
		}
		
		
	});
	
});	
</script>

<style>
.err_msg{color:red;}
.required_field{border:1px solid red;}
#msg_succ{color:green;}
#msg_err{color:red;}
</style>
<?php wp_footer(); ?>

</body>
</html>
