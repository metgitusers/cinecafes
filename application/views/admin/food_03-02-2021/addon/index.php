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
                                    <h4 class="card-title">Item Addon List</h4>
                                    <a class="add_bttn title_btn t_btn_list" href="<?= base_url('admin/food/addon/add'); ?>">
                                    <span><i class="fa fa-plus" aria-hidden="true"></i></span> Add New Addon</a>
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
                                                        <div id="active_user" class="tab-pane active"><br>
                                                            <div class="table-responsive custom_table_area">
                                                                <table class="table table-striped table-bordered dom-jQuery-events c_table_style" id="food_dataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>SL No.</th>                                                                                
                                                                            <th>Item Name</th>
                                                                            <th>Name</th>                                                                         
                                                                            <th>Price</th>                                                                         
                                                                            <th>Description</th>                                                                         
                                                                            <th>Status</th>                                                                             
                                                                            <th class="action_bttn name_space">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
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
$(document).ready(function(){
    drawTable();
})
function drawTable(){
    let dataJson = {
        source: 'WEB'
    };
    $.ajax({
        type: "POST",
        url: "<?=base_url('api/get-addons')?>",
        data: JSON.stringify(dataJson),
        datType: 'JOSN',
        success: function(res) {
            if (res.status.error_code == 0) {
                $("#food_dataTable").dataTable().fnDestroy();
                $('tbody').html('');
                $('tbody').html(res.response.data);
                $('#food_dataTable').DataTable({
                    //destroy: true,
                    //order: [1, 'asc'],
                });
            } else {
                console.log(res.message);
            }
        },
    });
}
</script>