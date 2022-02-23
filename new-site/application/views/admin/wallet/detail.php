<!--Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Wallet Transaction </h1>

<p align="right"><a href="<?php echo base_url();?>admin/wallet" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    </span>
                    <span class="text">Back </span></a></p>
<div class="clearfix"></div>
           <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Listing</h6>
            </div>
            <div class="card-body table_panel">
               <?php if ($this->session->flashdata('success_message')) : ?>
                <div class="alert alert-success" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('success_message') ?>
                </div>
            <?php endif ?>
            <?php if ($this->session->flashdata('error_message')) : ?>
                <div class="alert alert-danger" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                  <?php echo $this->session->flashdata('error_message') ?>
                </div>
            <?php endif ?>
             
              <div class="table-responsive">
                <table class="table table-bordered" id="myTransactionhistory" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sl No.</th>
                      <th>Transaction ID</th>
                      <th>Transaction date</th>
                      <th>Transaction Details</th>
                      
                      <th>Amount</th>
                      <th>Customer Details</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Sl No.</th>
                      <th>Transaction ID</th>
                      <th>Transaction date</th>
                      <th>Transaction Details</th>
                      
                      <th>Amount</th>
                      <th>Customer Details</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if(!empty($list)){ $i=1;?>
                    <?php foreach($list as $row){ 
                      $arrow="";
                      $color="";
                      if($row['add_wallet']==1)
                      {
                        $arrow='<i class="fa fa-arrow-up" style="color:green"></i>';
                        $color="green";
                      }
                      else
                      {
                        $arrow='<i class="fa fa-arrow-down" style="color:red"></i>';
                        $color="red";
                      }
                      ?>
                      <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $row['transaction_id'];?></td>
                      <td><?php echo date('d-m-Y H:i', strtotime($row['transaction_date']));?></td>
                      <td>
                        <?php 
                        echo $row['transaction_type'];
                        $content="";
                        if($row['transaction_type']=='Reservation')////reservation content
                        {
                          if($row['cafe_name']!='')
                          {
                            $content.= $row['cafe_name'];
                          }
                          if($row['reservation_date']!=''&& $row['reservation_time']!='')
                          {
                            $content.= " at ".$row['reservation_date']." ".$row['reservation_time'];
                          }
                        }

                        if($row['transaction_type']=='Reservation')////Package content
                        {
                          if($row['package_name']!='')
                          {
                            $content.= $row['package_name'];
                          }
                          
                        }
                        echo "<br>".$content;
                        ?>
                          
                        </td>
                      
                                     
                      <td style="color:<?php echo $color; ?>"><?php echo $arrow." Rs.".' '.$row['amount']; ?> </td>
                     
                      <td><?php echo $row['name'];?>
                      <br><a href="mailto:<?php echo $row['email'];?>"><?php echo $row['email'];?></a>
                      <br><?php echo $row['mobile'];?></td>  
                    
                     
                    </tr>
                   
                    <?php $i++;
                      } ?>
                    <?php }else{ ?>
                     <tr>
                        <td colspan="12">No Transaction Found</td>
                          
                      </tr>
                      <?php } ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content-->

