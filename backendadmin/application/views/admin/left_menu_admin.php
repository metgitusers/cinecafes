<!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('admin')?>">
        <img src="<?php echo base_url() ?>public/img/logo.png" alt="logo" />
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
     <!--  <li class="nav-item <?php if($this->uri->segment(1)=='index'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url().'index'; ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li> -->
       <li class="nav-item <?php if($this->uri->segment(2)=='dashboard'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
       <!-- Divider -->
      <hr class="sidebar-divider my-0">
     
       <!-- Nav Item - cafe -->
      <li class="nav-item <?php if($this->uri->segment(2)=='cafe'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/cafe'); ?>">
          <img src="<?=base_url('public/img/icon_2.png')?>" alt="icon">
          <span>Cafe</span></a>
          
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - cafe -->
      <li class="nav-item <?php if($this->uri->segment(2)=='setting'&&$this->uri->segment(2)=='price'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/setting/price'); ?>">
        <img src="<?=base_url('public/img/icon_3.png')?>" alt="icon">
          <span>Hourly Price</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
     
   
      
      <!-- <hr class="sidebar-divider my-0"> -->
       <!-- Nav Item - food  -->
       <!-- <li class="nav-item <?php if($this->uri->segment(2)=='foodcategory' || $this->uri->segment(2)=='food'){ echo "active"; }?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwoFood" aria-expanded="true" aria-controls="collapseTwo1">
          <i class="fas fa-fw fa-cog"></i>
          <span>Food</span>
        </a>
        <div id="collapseTwoFood" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            
              <a class="collapse-item <?php if($this->uri->segment(2)=='foodcategory'){ echo "active"; }?>" href="<?php echo base_url('admin/foodcategory'); ?>" >Food Category</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='food'){ echo "active"; }?>" href="<?php echo base_url('admin/food'); ?>" >Food</a>
              
            

          </div>
        </div>
      </li> -->
      
       <!-- Divider -->
      <hr class="sidebar-divider my-0">
      
       <!-- Nav Item - movie -->
       <li class="nav-item <?php if($this->uri->segment(2)=='moviecategory' || $this->uri->segment(2)=='movie'){ echo "active"; }?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwoMovie" aria-expanded="true" aria-controls="collapseTwo1">
        <img src="<?=base_url('public/img/icon_4.png')?>" alt="icon">
          <span>Movie</span>
        </a>
        <div id="collapseTwoMovie" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            
              <a class="collapse-item <?php if($this->uri->segment(2)=='moviecategory'){ echo "active"; }?>" href="<?php echo base_url('admin/moviecategory'); ?>" >Movie Category</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='movie'){ echo "active"; }?>" href="<?php echo base_url('admin/movie'); ?>" >Movie</a>
              
            

          </div>
        </div>
      </li>
      
       <!-- Divider -->
      <hr class="sidebar-divider my-0">
     
       <!-- Nav Item - room-->

      
       <li class="nav-item <?php if($this->uri->segment(2)=='roomtype' || $this->uri->segment(2)=='room'){ echo "active"; }?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwoRoom" aria-expanded="true" aria-controls="collapseTwoRoom">
        <img src="<?=base_url('public/img/icon_5.png')?>" alt="icon">
          <span>Room</span>
        </a>
        <div id="collapseTwoRoom" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            
              <a class="collapse-item <?php if($this->uri->segment(2)=='roomtype'){ echo "active"; }?>" href="<?php echo base_url('admin/roomtype'); ?>" >Room Type</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='room'){ echo "active"; }?>" href="<?php echo base_url('admin/room'); ?>" >Room</a>
              
            

          </div>
        </div>
      </li>
      
       <hr class="sidebar-divider my-0">
       <!-- Nav Item - coupon  -->
      <li class="nav-item <?php if($this->uri->segment(2)=='coupon'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/coupon'); ?>">
        <img src="<?=base_url('public/img/icon_6.png')?>" alt="icon">
          <span>Coupon</span></a>
      </li>
      <hr class="sidebar-divider my-0">
        <!-- Nav Item - media  -->
       <li class="nav-item <?php if($this->uri->segment(2)=='media'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/media'); ?>">
        <img src="<?=base_url('public/img/icon_7.png')?>" alt="icon">
          <span>Entertainment Media</span></a>
      </li> 
       <hr class="sidebar-divider my-0">
        <!-- Nav Item - banner  -->
       <li class="nav-item <?php if($this->uri->segment(2)=='banner'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/banner'); ?>">
        <img src="<?=base_url('public/img/icon_8.png')?>" alt="icon">
          <span>Banner</span></a>
      </li> 
       <hr class="sidebar-divider my-0">
        <!-- Nav Item - cms  -->
       <li class="nav-item <?php if($this->uri->segment(2)=='cms'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/cms'); ?>">
        <img src="<?=base_url('public/img/icon_9.png')?>" alt="icon">
          <span>Cms</span></a>
      </li> 
       <hr class="sidebar-divider my-0">
        <!-- Nav Item - review  -->
       <li class="nav-item <?php if($this->uri->segment(2)=='review'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/review'); ?>">
        <img src="<?=base_url('public/img/icon_10.png')?>" alt="icon">
          <span>Review</span></a>
      </li> 

      <li class="nav-item <?php if($this->uri->segment(2)=='membership'){ echo"active"; }?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <img src="<?=base_url('public/img/icon_11.png')?>" alt="icon">
          <span>Membership Package</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Members</h6>
              <a class="collapse-item <?php if($this->uri->segment(2)=='member' && $this->uri->segment(3)=='add'){ echo"active"; }?>" href="<?php echo base_url('admin/member/add'); ?>" >Add new Member</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='membership'){ echo"active"; }?>" href="<?php echo base_url('admin/membership'); ?>" >Members List</a>
              
            <h6 class="collapse-header">Membership Plan</h6>

              <a class="collapse-item <?php if($this->uri->segment(2)=='packagetype'){ echo"active"; }?>" href="<?php echo base_url('admin/packagetype'); ?>" >Package Type</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='package' && $this->uri->segment(3)=='add'){ echo"active"; }?>" href="<?php echo base_url('admin/package/add'); ?>" >Add new Membership plan</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='package' && $this->uri->segment(3)== ''){ echo"active"; }?>" href="<?php echo base_url('admin/package'); ?>" >List of Membership plan</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='PackageBenefit' && $this->uri->segment(2)=='add'){ echo"active"; }?>" href="<?php echo base_url('admin/PackageBenefit/add'); ?>" >Add new Membership Benifit</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='PackageBenefit'){ echo"active"; }?>" href="<?php echo base_url('admin/PackageBenefit'); ?>" >List of Membership Benifit</a>

          </div>
        </div>
      </li>

      <li class="nav-item <?php if($this->uri->segment(2)=='member'){ echo"active"; }?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo1">
        <img src="<?=base_url('public/img/icon_12.png')?>" alt="icon">
          <span>User</span>
        </a>
        <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            
              <a class="collapse-item <?php if($this->uri->segment(2)=='member' && $this->uri->segment(3)=='add'){ echo"active"; }?>" href="<?php echo base_url('admin/member/add'); ?>" >Add new User</a>
              <a class="collapse-item <?php if($this->uri->segment(2)=='member'){ echo"active"; }?>" href="<?php echo base_url('admin/member'); ?>" >All User</a>
              
            

          </div>
        </div>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
        <img src="<?=base_url('public/img/icon_13.png')?>" alt="icon">
          <span>Subadmin</span>
        </a>
        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            
              <a class="collapse-item" href="<?php echo base_url('admin/subadmin/add'); ?>" >Add new Subadmin</a>
              <a class="collapse-item" href="<?php echo base_url('admin/subadmin'); ?>" >All Subadmin</a>
              
            

          </div>
        </div>
      </li>
       <hr class="sidebar-divider my-0">
        <!-- Nav Item - wallet  -->
      <li class="nav-item <?php if($this->uri->segment(2)=='wallet'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/wallet'); ?>">
        <img src="<?=base_url('public/img/icon_14.png')?>" alt="icon">
          <span>Wallet</span></a>
      </li>
       <hr class="sidebar-divider my-0">
       <!-- Nav Item - reservation  -->
      <li class="nav-item <?php if($this->uri->segment(2)=='reservation'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/reservation'); ?>">
        <img src="<?=base_url('public/img/icon_15.png')?>" alt="icon">
          <span>Reservation</span></a>
      </li>
        <hr class="sidebar-divider my-0">
       <!-- Nav Item - transactionhistory  -->
      <li class="nav-item <?php if($this->uri->segment(2)=='transactionhistory'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/transactionhistory'); ?>">
        <img src="<?=base_url('public/img/icon_16.png')?>" alt="icon">
          <span>Transaction History</span></a>
      </li>
      <hr class="sidebar-divider my-0">
      <li class="nav-item <?php if($this->uri->segment(2)=='notification'){ echo"active"; }?>">
        <a class="nav-link" href="<?php echo base_url('admin/notification/offer'); ?>">
          <img src="<?=base_url('public/img/icon_17.png')?>" alt="icon">
          <span>Push Notification</span></a>
      </li>
      <!-- food application by cs -->      
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFood" aria-expanded="true" aria-controls="collapseTwo2">
        <img src="<?=base_url('public/img/icon_13.png')?>" alt="icon">
          <span>Food Gallery</span>
        </a>
        <div id="collapseFood" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" >
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='app-access')?'active':''?>" href="<?=base_url('admin/food/app-access')?>" ><img src="<?=base_url('public/img/icon_12.png')?>"> Food App Access</a>
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='category')?'active':''?>" href="<?=base_url('admin/food/category')?>"><img src="<?=base_url('public/admin_assets/images/food_category.png')?>"> Food Categories</a>
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='items')?'active':''?>" href="<?=base_url('admin/food/items')?>" ><img src="<?=base_url('public/admin_assets/images/food_item.png')?>"> Food Items</a>
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='addon')?'active':''?>" href="<?=base_url('admin/food/addon')?>" ><img src="<?=base_url('public/admin_assets/images/item_addon.png')?>"> Item Addons</a>
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='coupon')?'active':''?>" href="<?=base_url('admin/food/coupon')?>" ><img src="<?=base_url('public/admin_assets/images/item_coupon.png')?>"> Item Coupon</a>
              <a class="collapse-item <?= ($this->uri->segment(2)=='food' && $this->uri->segment(3)=='orders')?'active':''?>" href="<?=base_url('admin/food/orders')?>"><img src="<?=base_url('public/admin_assets/images/food_order.png')?>"> Orders</a>
							
          </div>
        </div>
      </li>
       <hr class="sidebar-divider my-0">
      

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    