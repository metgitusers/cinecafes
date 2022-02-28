<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" href="assets/image/cursor-img.png">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/css/bootstrap.min.css')?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/css/slick.css')?>">
<link rel="stylesheet" type="text/css" media="all" href="<?=base_url('public/assets/css/stellarnav.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/css/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/css/style.css')?>">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css"> -->
<link rel="stylesheet" type="text/css" href="<?=base_url('public/assets/css/responsive.css')?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/sweetalert2.min.css') ?>">
<title><?=$title?></title>
</head>

<body>

<header class="main-header">
  <div class="container-fluid">
    <div class="row align-items-center">
      <div class="col-md-4">
        <div class="logo">
          <a href="<?=site_url('User')?>">
            <img src="<?=base_url('public/assets/image/logo.png')?>" alt="logo">
          </a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="right-bar">
          <div class="top-header">
           <div class="phone">
              <span><i class="fas fa-phone-square-alt"></i> Booking Enquiry : <a href="tel:+91 8100786623"> +91 81007 86623</a></span>
              <span><i class="fas fa-phone-square-alt"></i> Franchise Enquiry : <a href="tel:+91 6290821850"> +91 62908 21850</a></span>
            </div>
            <!-- <div class="search-movie">
              <span><i class="fas fa-search"></i></span>
              <input type="text" class="form-control" autocomplete="off" placeholder="Search Movies">
              <button class="caret-d"><i class="fas fa-sort-down"></i></button>
              <div class="search-list">
                <ul>
                  <li>
                    <div class="list-ed">
                      <a href="#">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="list-m-img">
                              <img src="<?=base_url('public/assets/image/1.jpg')?>">
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="list-m-cont">
                              <h3>spiderman no way home</h3>
                              <ul>
                                <li>Tamil</li>
                                <li>English</li>
                                <li>Hindi</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </li>
                  <li>
                    <div class="list-ed">
                      <a href="#">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="list-m-img">
                              <img src="<?=base_url('public/assets/image/1.jpg')?>">
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="list-m-cont">
                              <h3>spiderman no way home</h3>
                              <ul>
                                <li>Tamil</li>
                                <li>English</li>
                                <li>Hindi</li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div> -->
            <div class="search-location">
            <span><i class="fas fa-location-arrow"></i></span>
              <input type="text" class="form-control" value="Kolkata">
              <button class="caret-s" data-toggle="modal" data-target="#locationModal"><i class="fas fa-sort-down"></i></button>
            </div>
            <!--<div class="nav-b">
              <label id="menuToggle" onclick="openNav()">
                <span></span>
                <span></span>
                <span></span>
              </label>
            </div>-->
          </div>
          <div class="nav-header">
            <div class="stellarnav">
              <ul>
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><a href="<?=base_url('public/assets/pdf/Cine cafe menu_8.2.22.pdf')?>">MENU</a></li>
                <li><a href="#">FEATURES</a></li>
                <li><a href="<?=base_url('gallery')?>">GALLERY</a></li>
                <li><a href="#">CONTACT</a></li>
                <!--<li><a href="#">BOOK NOW</a></li>-->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
