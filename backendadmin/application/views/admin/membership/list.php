<div class="main-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success_msg')) : ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $this->session->flashdata('success_msg') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_msg')) : ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $this->session->flashdata('error_msg') ?>
                </div>
            <?php endif ?>
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="page-title-wrap">
                                    <h4 class="card-title">Club Member List</h4>
                                    <!--<a class="title_btn t_btn_list" href="<?= base_url(); ?>admin/membership/add"><span><i class="fa fa-plus" aria-hidden="true"></i></span> Add Member</a>-->    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <form class="form">
                                        <div class="form-body">
                                            <!--<h4 class="form-section">
                                                <i class="icon-user"></i> Personal Details</h4>-->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="staff_tab_area">
                                                        <ul class="nav nav-tabs" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link tab_acvt_inacvt active" data-toggle="tab" href="#active_user">Active Membership Owner</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link tab_acvt_inacvt" data-toggle="tab" href="#inactive_user">Inactive Membership Owner</a>
                                                            </li>
                                                        <!--    <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab" href="#trash_user">Trash Driver</a>
                                                            </li> -->
                                                        </ul>
                                                        <div class="" style="margin-top:10px">
                                                            <form id="bond_report_form" action="" method="Post" class="form custom_form_style">
                                                              <div class="form-body">
                                                                <div class="user_permission_top">
                                                                  <div class="row" style="background-color:#000;padding:10px 10px 5px 10px; margin-left: 0;">                            
                                                                    <!-- <div class="col-sm-3">
                                                                      <div class="form-group" style="margin-bottom: 0;">
                                                                          <label>Registration date</label>
                                                                          <div class="settlement_inline">
                                                                            <select id="registration_filter" class="js-select2" name="registration_filter" data-show-subtext="true" data-live-search="true">
                                                                              <option value="">Select</option>
                                                                              <option value="1">All</option>
                                                                              <option value="2">Weekly</option>
                                                                              <option value="3">Monthly</option>
                                                                              <option value="4">Quarterly</option>
                                                                              <option value="5">Yearly</option>
                                                                            </select>
                                                                          </div>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                      <div class="form-group" style="margin-bottom: 0;">
                                                                          <label>Expiry date</label>
                                                                          <div class="settlement_inline">
                                                                            <select id="expiry_filter" class="js-select2" name="expiry_filter" data-show-subtext="true" data-live-search="true">
                                                                              <option value="">Select</option>
                                                                              <option value="1">All</option>
                                                                              <option value="2">Weekly</option>
                                                                              <option value="3">Monthly</option>
                                                                              <option value="4">Quarterly</option>
                                                                              <option value="5">Yearly</option>
                                                                            </select>
                                                                          </div>
                                                                      </div>
                                                                    </div> -->
                                                                    <div class="col-sm-5">
                                                                      <div class="form-group" style="margin-bottom: 0;">
                                                                          <label>Membership name</label>
                                                                          <div class="settlement_inline" style="display: inline-block;
    margin-left: 15px;">
                                                                            <select id="membership_name" class="js-select2" name="membership_name" data-show-subtext="true" data-live-search="true">
                                                                              <option value="">Select</option>
                                                                              <option value="">All</option>
                                                                              <?php if(!empty($membership_list)): ?>
                                                                              <?php   foreach($membership_list as $mlist): ?>
                                                                                        <option value="<?php echo $mlist['package_id'];?>"><?php echo $mlist['package_name'];?></option>
                                                                              <?php   endforeach; ?>
                                                                              <?php endif; ?>
                                                                            </select>
                                                                          </div>
                                                                      </div>
                                                                    </div>                                                                   
                                                                    <div class="col-md-3" style="">
                                                                      <div class="form-group">
                                                                        <button type="button" class="btn btn-success pull-left" id="search_btn">
                                                                          <i class="fa fa-search" aria-hidden="true"></i> GO
                                                                        </button>
                                                                      </div>
                                                                    </div>                            
                                                                  </div>
                                                                </div>
                                                              </div>                      
                                                            </form>                                              
                                                        </div>
                                                        <div class="tab-content" id="pckg_purchased_list" style="margin-top: -13px;!important">
                                                      <div id="active_user" class="tab-pane active"><br>
                                                      <div class="table-responsive custom_table_area export_table_area">
                                                          <table class="table table-striped table-bordered export_btn_dt c_table_style pckg_purchased_report_table">
                                                              <thead>
                                                                  <tr>
                                                                      <th>SL No.</th>
                                                                      <th>Membership Id</th>                                                                               
                                                                      <th>Name</th>
                                                                      <th>Mobile</th>
                                                                      <th>Email</th>
                                                                      <th>Membership Name</th>
                                                                      <th>Registered on</th>
                                                                      <th>Membership type</th>
                                                                      <th>Source</th>
                                                                      <th>Expiry Date</th>                                                                               
                                                                      <!-- <th>Status</th> -->
                                                                  </tr>
                                                              </thead>
                                                                <tbody>
                                                                      <?php if (!empty($active_membership_list)) { ?>
                                                                      <?php     foreach ($active_membership_list as $key => $actv_mem) { ?>
                                                                      <tr>
                                                                          <td><?= $key + 1 ?></td>
                                                                          <td><?= $actv_mem['membership_no'] ?></td>                                                                                       
                                                                          <td class="name_space"><?= ucfirst($actv_mem['full_name'])?></td>
                                                                          <td><?= $actv_mem['mobile'] ?></td>
                                                                          <td><?= $actv_mem['email'] ?></td>
                                                                          <td><?= $actv_mem['package_name'] ?></td>
                                                                          <td><?= date('d/m/Y', strtotime($actv_mem['buy_on'])) ?></td>
                                                                          <td><?= ucfirst($actv_mem['package_type_name']) ?></td>
                                                                          <?php if($actv_mem['added_form'] == "admin"): 
                                                                                  $added_form  = 'Offline';
                                                                                elseif($actv_mem['added_form'] == "front"): 
                                                                                  $added_form  = 'App';
                                                                                else: 
                                                                                  $added_form  = 'Web';
                                                                                endif; 
                                                                          ?>
                                                                          <td><?= $added_form; ?></td>
                                                                          <?php if($actv_mem['expiry_date'] !='0000-00-00'): $expiry_date =  date('d/m/Y', strtotime($actv_mem['expiry_date']));else: $expiry_date =''; endif;?>
                                                                          <td><?= $expiry_date ?></td>                                                                                    
                                                                          <!-- <td class="action_td text-center">
                                                                              <button class="btn" style="pointer-events: none;background-color: #28D094">Active</button>
                                                                          </td> -->
                                                                      </tr>
                                                                  <?php 
                                                                  } } else { ?>
                                                                    <tr>
                                                                        <td colspan="10" style="text-align:center;">No Data Available</td>
                                                                    </tr>

                                                              <?php  } ?>
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                  </div>
                                                  <div id="inactive_user" class="tab-pane fade"><br>
                                                      <div class="table-responsive custom_table_area">
                                                          <table class="table table-striped table-bordered export_btn_dt c_table_style pckg_purchased_report_table">
                                                              <thead>
                                                                  <tr>
                                                                      <th>SL No.</th>
                                                                      <th>Membership Id</th>                                                                               
                                                                      <th>Name</th>
                                                                      <th>Mobile</th>
                                                                      <th>Email</th>
                                                                      <th>Membership Name</th>
                                                                      <th>Registered on</th>
                                                                      <th>Membership type</th>
                                                                      <th>Source</th>
                                                                      <th>Expiry Date</th>                                                                               
                                                                      <!-- <th>Status</th> -->
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                                  <?php if (!empty($inactive_membership_list)) { ?>
                                                                  <?php     foreach ($inactive_membership_list as $key => $inactv_mem) { ?>
                                                                  <tr>
                                                                      <td><?= $key + 1 ?></td>
                                                                      <td><?= $inactv_mem['membership_no'] ?></td>                                                                                        
                                                                      <td class="name_space"><?= ucfirst($inactv_mem['full_name']) ?></td>
                                                                      <td><?= $inactv_mem['mobile'] ?></td>
                                                                      <td><?= $inactv_mem['email'] ?></td>
                                                                      <td><?= $inactv_mem['package_name'] ?></td>
                                                                      <td><?= date('d/m/Y', strtotime($inactv_mem['buy_on'])) ?></td>
                                                                      <td><?= ucfirst($inactv_mem['package_type_name']) ?></td>
                                                                      <?php if($actv_mem['added_form'] == "admin"): 
                                                                              $added_form  = 'Offline';
                                                                            elseif($actv_mem['added_form'] == "front"): 
                                                                              $added_form  = 'App';
                                                                            else: 
                                                                              $added_form  = 'Web';
                                                                            endif; 
                                                                      ?>
                                                                      <td><?= $added_form; ?></td>
                                                                      <?php if($inactv_mem['expiry_date'] !='0000-00-00'): $expiry_date =  date('d/m/Y', strtotime($inactv_mem['expiry_date']));else: $expiry_date =''; endif;?>
                                                                      <td><?= $expiry_date ?></td>                                                                                    
                                                                      <!-- <td class="action_td text-center">
                                                                          <button class="btn btn-warning" style="pointer-events: none;">Inactive</button>
                                                                      </td> -->
                                                                  </tr>
                                                              <?php 
                                                              } } else { ?>
                                                                <tr>
                                                                    <td colspan="10" style="text-align:center;">No Data Available</td>
                                                                </tr>

                                                          <?php  } ?>

                                                              </tbody>
                                                          </table>
                                                      </div>
                                                  </div>
 
                                                        </div>
                                                    </div>
                                                  </div>
                                               </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    membershipPopulateData();
    var now = new Date();
    var date = now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate();  
    $('.pckg_purchased_report_table').DataTable({
      pageLength: 10,
      dom: 'Bfrtip',
      buttons: [{
          extend: 'excel',        
          text: '<i class="fa fa-download" aria-hidden="true"></i>',
          tag:  'span',
          filename: 'membership_package_purchased_report_' + date,
          exportOptions: {
                  columns: [0,1,2,3,4,5,6,7,8,9]
          }
        }
        //'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
});
$(document).on('click','#search_btn',function(event){
    event.preventDefault();
    membershipPopulateData();
    
});

  function membershipPopulateData(){
    var registration_filter   = $("#registration_filter").val();
    var expiry_filter         = $("#expiry_filter").val();
    var membership_name       = $("#membership_name").val();
    var cnt   = 0;    
      $.ajax({
          type: "POST",
          url: '<?php echo base_url('admin/membership/filterSearch')?>',
          data:{registration_filter,expiry_filter,membership_name},
          dataType:'json',
          success: function(response){  
          //alert(response);
            var active_tab   = $(".tab_acvt_inacvt.active").attr('href');
           //alert(active_tab);        
            $("#pckg_purchased_list").html(response['html']);
            if(active_tab == '#active_user'){
                $("#active_user").addClass("active");
                $("#active_user").removeClass("fade");
                $("#inactive_user").addClass("fade");
                $("#inactive_user").removeClass("active");
                
            }
            else{
                $("#active_user").removeClass("active");
                $("#active_user").addClass("fade");
                $("#inactive_user").addClass("active");
                $("#inactive_user").removeClass("fade");
                //$("#events_list").html(response['html']);
            }
            var now = new Date();
            var date = now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate();  
            $('.pckg_purchased_report_table').DataTable({
              pageLength: 10,
              dom: 'Bfrtip',
              buttons: [{
                  extend: 'excel',
                  text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export',
                  tag:  'span',
                  filename: 'membership_package_purchased_report_' + date,
                  exportOptions: {
                          columns: [0,1,2,3,4,5,6,7,8,9]
                  }
                }
                //'copy', 'csv', 'excel', 'pdf', 'print'
              ]
            });   
          },
          error:function(response){
            $.alert({
             type: 'red',
             title: 'Alert!',
             content: 'error',
            });
          }
      });
}
</script>