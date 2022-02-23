<style>
    .wrapper {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 400px;
    margin: 50vh auto 0;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    }

    .switch_box {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    max-width: 200px;
    min-width: 200px;
    height: 200px;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    }

    /* Switch 1 Specific Styles Start */

    .box_1 {
    background: #eee;
    }

    input[type="checkbox"].switch_1 {
    font-size: 30px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 60px;
    height: 30px;
    background: #ddd;
    border-radius: 3em;
    position: relative;
    cursor: pointer;
    outline: none;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    }

    input[type="checkbox"].switch_1:checked {
    background: #056b05;
    }

    input[type="checkbox"].switch_1:after {
    position: absolute;
    content: "";
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #F68310;
    -webkit-box-shadow: 0 0 0.25em rgba(0, 0, 0, 0.3);
    box-shadow: 0 0 0.25em rgba(0, 0, 0, 0.3);
    -webkit-transform: scale(0.7);
    transform: scale(0.7);
    left: 0;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    }

    input[type="checkbox"].switch_1:checked:after {
        left: calc(100% - 1em);
    }
    .toggleappaccess{
       text-align:center;
       padding:250px 0;
    }
    /* Switch 1 Specific Style End */
</style>
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
            <h1 class="h3 mb-2 text-gray-800">App Access for Food</h1>
            <p align="right">
                <!-- <a href="<?php echo base_url('admin/food/addon/add'); ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add New Food Addon</span>
                </a> -->
            </p>

            <p><span class="text"></span></a></p> 
            <div class="clearfix"></div>
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="page-title-wrap card-header">
                                <h4 class="card-title">Would you like to grant food access in entire App?</h4>
                            </div>
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="">
                                        <div class="toggleappaccess_1" >
                                            <span>Enable food access in entire App</span>
                                            <?php
                                                $checked = '';
                                                if($details){
                                                    $checked = $details[0]->is_active==1?'checked':'';
                                                }
                                            ?>
                                            <input type="checkbox" class="switch_1" value="1" <?=$checked?>>
                                            
                                        </div>
                                        <div class="toggleappaccess_1" >
                                            <span>Enable food Cart Order</span>
                                            <?php
                                                $checked = '';
                                                if($details){
                                                    $checked = $details[0]->is_active==1?'checked':'';
                                                }
                                            ?>
                                            <input type="checkbox" class="switch_1" value="1" <?=$checked?>>
                                            
                                        </div>
                                    </div>
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
    $('.switch_1').on('change', function(){
        let v = $(this).prop('checked') == true?1:0;
        Swal.fire({
        title: "Are you sure to change App Access?",
        type: "warning",
        showCancelButton: true, // true or false  
        confirmButtonColor: "#dd6b55",
        cancelButtonColor: "#48cab2",
        confirmButtonText: "Yes !!!", 
    }).then((result) => {

        if (!result.value) {
            $('.switch_1').prop('checked', v==1?false:true);
            return false;
        }
        else{
            let dataJson = {
                status: v
            };
            $.ajax({
                type: "POST",
                url: "<?=base_url('food/api/updateFoodAccess')?>",
                data: JSON.stringify(dataJson),
                success: function(res) {
                    console.log(res);
                    if (res.status.error_code == 0) {
                        swalAlert(res.status.message, "success");
                    } else {
                        swalAlert(res.status.message, "warning");
                    }
                },
            });
          }
      });
    })
})
</script>