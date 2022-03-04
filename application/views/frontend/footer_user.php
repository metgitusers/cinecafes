<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="footer-logo">
          <a href="#">
            <img src="<?=base_url('public/assets/image/logo.png')?>">
          </a>
        </div>
        <div class="footer-menu">
          <ul>
            <li><a href="#">HOME</a></li>
            <li><a href="#">MOVIES</a></li>
            <li><a href="#">TV SHOWS</a></li>
            <li><a href="#">FEATURES</a></li>
            <li><a href="#">GALLERY</a></li>
            <li><a href="#">CONTACT</a></li>
          </ul>
        </div>
        
      </div>
      <div class="col-md-12 col-lg-4">
        <div class="get-letest">
          <h5>Get the freshest news from us</h5>
          <form action="#">
            <div class="subscribe-form">
              <input type="email" class="form-control" placeholder="Your email address…">
              <button class="subsbtn">Subscribe</button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="footer-menu-2">
          <ul>
             <li><a href="<?=base_url('User/about-us')?>">About Us</a></li>
            <li><a href="<?=base_url('User/terms-condition')?>">Terms & Conditions</a></li>
            <li><a href="<?=base_url('User/privacy-policy')?>">Privacy Policy</a></li>
            <li><a href="#">Sitemap</a></li>
          </ul>
          <p>© Cine Cafe 2021. All right reserved</p>
        </div>
      </div>
    </div>
  </div>
  
</footer>
<ul class="social-icon">
  <li><a href="https://www.facebook.com/cinecafes" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
  <li><a href="https://www.linkedin.com/company/cine-cafes/mycompany/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
  <li><a href="https://www.instagram.com/cinecafes" target="_blank"><i class="fab fa-instagram"></i></a></li>
</ul>
<div class="francise-form">
  <h2 data-toggle="modal" data-target="#myModal">Franchise</h2>
</div>
<div class="modal francise-modal right fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <form id="contact" data-action="contactMail" method ="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Contact Information</h4>
        </div>
        <div class="modal-body">
         
            <div class="row">
            
                <div class="col-sm-6 form-group">
                <input type="text" class="form-control" placeholder="First Name" name="first_name">
            </div>
                <div class="col-sm-6 form-group">
                <input type="text" class="form-control" placeholder="Last Name" name="last_name">
            </div>
                <div class="col-sm-6 form-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
            </div>
               <div class="col-sm-6 form-group">
                <input type="number" class="form-control" placeholder="Phone Number" name="phone_no">
            </div>
                <div class="col-sm-12 form-group">
                  <textarea class="form-control" rows="5" placeholder="Message" name="message"></textarea>
                </div>

                <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>" style="padding-top:10px;margin-left: 15px;">
                  
                </div>

                
                
        </div>
          </div>
          <div class="succ_msg"></div>
          <div class="error_msg"></div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
      
    </div>
  </div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>

<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5>Popular City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <ul>
            <li>
              <a href="#">
                <img src="<?=base_url('public/assets/image/location.png')?>">
                <label>Kolkata</label>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?=base_url('public/assets/image/location.png')?>">
                <label>Mumbai</label>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?=base_url('public/assets/image/location.png')?>">
                <label>Delhi</label>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?=base_url('public/assets/image/location.png')?>">
                <label>Hydrabad</label>
              </a>
            </li>
            <li>
              <a href="#">
                <img src="<?=base_url('assets/image/location.png')?>">
                <label>Chennai</label>
              </a>
            </li>
          </ul> 
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?=base_url('public/assets/js/bootstrap.min.js')?>"></script> 
<script type="text/javascript" src="<?=base_url('public/assets/js/bootstrap.bundle.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script type="text/javascript" src="<?=base_url('public/assets/js/slick.min.js')?>"></script>  
<script type="text/javascript" src="<?=base_url('assets/js/stellarnav.min.js')?>"></script>
<!-- <script src="<?=base_url('public/assets/front-common.js')?>"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script> -->
<!-- <script src="<?=base_url('public/assets/sweetalert2.all.min.js')?>"></script> -->
<script src="<?=base_url('public/assets/js/theme.js')?>"></script> 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>
        var baseUrl='<?=base_url()?>';
</script>

<script>
  

  
  
function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("menuToggle").classList.add('active');
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  document.getElementById("menuToggle").classList.remove('active');
} 
</script>

<script type="text/javascript">
  $(document).ready(function() {
    
  
  $(document).on('submit','#contact',function(event) {
    //alert("click");
  event.preventDefault();
  //alert("hi");
              $.ajax({
                url: baseUrl+$(this).data('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (resp) {
                  console.log(resp);
                //jc.close();
                  if(resp.status)
                  {
                    //window.location.href = resp.redirect;
                    
                    //test2
                    $('#contact')[0].reset();
                    $('.succ_msg').html('<div class="alert alert-success">' + resp.message + '</div>');

                    
                    setTimeout(function(){window.location.href = resp.redirect;
                    /*$(".succ_msg").hide();*/
        }, 2000);
                    //$('#myModal').hide();

                    
                  }
                  else
                  {
                    $('.error_msg').html('<div class="alert alert-danger">' + resp.message + '</div>');
                    setTimeout(function(){
                      $(".error_msg").hide();
                    /**/
        }, 2000);
                    

                    /*$('.err_msg').css("color","red");*/
                  }
                }
               
  
              });

            
});
});

</script>


</body>

</html>
