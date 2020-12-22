<!--Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Review/Rating</h1>

	<!--  <p align="right"><a href="" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add</span></a></p> -->

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
				<table class="table table-bordered" id="myRating" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="8">Sl No.</th>
							<!--  <th width="25">User ID</th> -->
							<th width="15">Cafe</th>
							<th width="15">User Name</th>
							<th width="25">Email</th>
							<th class="no-sort">Mobile</th>
							<th class="no-sort">Service Rating</th>
							<th class="no-sort">Quality Rating</th>
							<th class="no-sort">Review comment</th>
							<!-- <th class="no-sort" width="25">Status</th> -->
							<!--  <th class="no-sort" width="25">Action</th> -->
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th width="8">Sl No.</th>
							<!--  <th width="25">User ID</th> -->
							<th width="15">Cafe</th>
							<th width="15">User Name</th>
							<th width="25">Email</th>
							<th class="no-sort">Mobile</th>
							<th class="no-sort">Service Rating</th>
							<th class="no-sort">Quality Rating</th>
							<th class="no-sort">Review comment</th>
							<!-- <th class="no-sort" width="25">Status</th> -->
							<!-- <th class="no-sort" width="25">Action</th> -->
						</tr>
					</tfoot>
					<tbody>
						<?php if(!empty($list)){ $i=1;?>
						<?php foreach($list as $row){ ?>
						<tr>
							<td>
								<?php echo $i;?>
							</td>
							<!--  <td><?php// echo $row['user_id'];?></td> -->
							<td>
								<?php echo $row['cafe_name'];?>
							</td>
							<td>
								<?php echo $row['name'];?>
							</td>
							<td>
								<a href="mailto:<?php echo $row['email'];?>">
									<?php echo $row['email'];?>
								</a>
							</td>
							<td>
								<?php echo $row['mobile'];?>
							</td>
							<td>

						<?php if($row['service_rating']==1){?> <i class="fa fa-star" aria-hidden="true"></i>
								
<?php }else if($row['service_rating']==2){ ?> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
<?php }else if($row['service_rating']==3){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
<?php }else if($row['service_rating']==4){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
<?php }else if($row['service_rating']==5){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
<?php } ?>
							</td>
							<td>


						<?php if($row['quality_rating']==1){?> <i class="fa fa-star" aria-hidden="true"></i>
								<?php }else if($row['quality_rating']==2){ ?> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
								<?php }else if($row['quality_rating']==3){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
								<?php }else if($row['quality_rating']==4){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
								<?php }else if($row['quality_rating']==5){ ?><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
								<?php } ?>
							</td>
							<td>
								<?php echo $row['review_content'];?>
							</td>
							<!-- <td>
								<?php 
                   $buttonActive = (($row['status'] == 1)?'block':'none');
                   $buttonInActive = (($row['status'] == 0)?'block':'none');
                   echo '<a href="javaScript:void(0)" title="Active" style="text-decoration: none;display:'.$buttonActive.'" id="activeBtn'.$row['rating_id'].'" onclick="activeInactiveRating(\''.$row['rating_id'].'\',0);" ><p style="color:green;font-size: 15px;"> Active</p></a>
                  <a href="javaScript:void(0)" title="In active" style="text-decoration: none;display:'.$buttonInActive.'" id="inactiveBtn'.$row['rating_id'].'" onclick="activeInactiveRating(\''.$row['rating_id'].'\',1);" ><p style="color:red;font-size: 15px;">  Inactive</p></a>';
                   ?>
							</td> -->
							<!-- <td><?php echo date('d-m-Y', strtotime($row['created_ts']));?></td> -->

						</tr>

						<?php $i++;
                      } ?>
						<?php }else{ ?>
						<tr>
							<td colspan="8">No Record Found</td>

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