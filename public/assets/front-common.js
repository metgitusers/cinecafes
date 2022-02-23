var jc;
$(document).on('submit','#sign_in',function(event) {
    // alert($(this).data('action'));
	event.preventDefault();
	            $.ajax({
                url: baseUrl+$(this).data('action'),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function() {
                    jc = $.alert({
                        icon: 'fa fa-spinner fa-spin',
                        title: 'Working!',
                        type: 'dark',
                        content: 'Sit back, we are processing your request!',
                        buttons:{
                            okay: {
                                text: 'okay',
                                btnClass: 'hide',
                                action: function(){
                                }
                            },
                        }
                    });
                },
                success: function (msg) {
                jc.close();
                  if(msg.status)
                  {
                  	$.alert({
                        title: 'Success',
                        content: msg.message,
                        type: 'green',
                        typeAnimated: true,
                        buttons: {
                            confirm: function () {
                                if(msg.redirect !=""){
                                window.location.replace(baseUrl+msg.redirect);
                                }
                            },
                        }
                    });

                    
                  }
                  else
                  {
                  	 $.alert({
                        title: 'Error',
                        content: msg.message,
                        type: 'red',
                        typeAnimated: true,
                    }); 
                  }
                },
               
  
              });

            
});

$(document).ready(function(){

$(document).on("click", ".change-p-status", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    var id = $(this).attr("data-id");
    var indexKey = $(this).attr("data-key-id");
    var table = $(this).attr("data-table");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    indexKey: indexKey,
                    table: table,
                    status: status,
                };
        

            if (id && table) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "Index/changeStatus",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            if (status == 3) {
                                $.alert({
                                    title: 'Success',
                                    content: "Data deleted successfully",
                                    type: 'blue',
                                    typeAnimated: true,
                                   
                                });
                                setTimeout(function(){
                                  location.reload();
                                  
                                }, 1550);
                            }else{
                                if (status == 0) {
                                    $("#" + id).attr("data-status", "1"); 
                                    $("#" + id).removeClass("badge-primary");
                                    $("#" + id).addClass("badge-danger");
                                    $("#" + id).html("Inactive");
                                } else {
                                    $("#" + id).attr("data-status", "0");
                                    $("#" + id).removeClass("badge-danger");
                                    $("#" + id).addClass("badge-primary");
                                    $("#" + id).html("Active");
                                }
                                $.alert({
                                    title: 'Success',
                                    content: res.status.message,
                                    type: 'blue',
                                    typeAnimated: true,
                                   
                                });
                            }
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.status.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
                $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
});



$(document).on("click", ".change-p-approve", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    var id = $(this).attr("data-id");
    var indexKey = $(this).attr("data-key-id");
    var table = $(this).attr("data-table");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this  ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    indexKey: indexKey,
                    table: table,
                    status: status,
                };
        

            if (id && table) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "Index/changeApprove",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            if (status == 0) {
                                $("#approve" + id).attr("data-status", "1"); 
                                $("#approve" + id).removeClass("badge-primary");
                                $("#approve" + id).addClass("badge-danger");
                                $("#approve" + id).html("Unapproved");
                            } else {
                                $("#approve" + id).attr("data-status", "0");
                                $("#approve" + id).removeClass("badge-danger");
                                $("#approve" + id).addClass("badge-primary");
                                $("#approve" + id).html("Approved");
                            }
                            $.alert({
                                title: 'Success',
                                content: res.status.message,
                                type: 'blue',
                                typeAnimated: true,
                               
                            });
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.status.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
              $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
  });
$(document).on("click", ".change-r-openClosed", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    var id = $(this).attr("data-id");
    var qId = $(this).attr("data-qid");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this  ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    qId:qId
                };
        

            if (id) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "FrontController/changereward",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            $.alert({
                                title: 'Success',
                                content: res.status.message,
                                type: 'blue',
                                typeAnimated: true,
                               
                            });
                            setTimeout(function(){ location.reload();},1500)
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.status.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
                $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
  });
$(document).on("click", ".change-p-openClosed", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    var id = $(this).attr("data-id");
    var indexKey = $(this).attr("data-key-id");
    var table = $(this).attr("data-table");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this  ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    indexKey: indexKey,
                    table: table,
                    status: status,
                };
        

            if (id && table) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "FrontController/changeOpenClosed",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            if (status == 0) {
                                $("#" + id).attr("data-status", "1"); 
                                $("#" + id).removeClass("badge-primary");
                                $("#" + id).addClass("badge-danger");
                                $("#" + id).html("Closed");
                            } else {
                                $("#" + id).attr("data-status", "0");
                                $("#" + id).removeClass("badge-danger");
                                $("#" + id).addClass("badge-primary");
                                $("#" + id).html("Open");
                            }
                            $.alert({
                                title: 'Success',
                                content: res.status.message,
                                type: 'blue',
                                typeAnimated: true,
                               
                            });
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.status.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
                $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
  });
$(document).on("click", ".change-p-feature", function(e) {
    e.preventDefault();
    var status = $(this).attr("data-status");
    var id = $(this).attr("data-id");
    var indexKey = $(this).attr("data-key-id");
    var table = $(this).attr("data-table");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this  ?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    indexKey: indexKey,
                    table: table,
                    status: status,
                };
        

            if (id && table) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "Index/changeFeatured",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        if (res.status.error_code == 0) {
                            if (status == 0) {
                                $("#feature" + id).attr("data-status", "1"); 
                                $("#feature" + id).removeClass("badge-primary");
                                $("#feature" + id).addClass("badge-danger");
                                $("#feature" + id).html("Unfeatured");
                            } else {
                                $("#feature" + id).attr("data-status", "0");
                                $("#feature" + id).removeClass("badge-danger");
                                $("#feature" + id).addClass("badge-primary");
                                $("#feature" + id).html("featured");
                            }
                            $.alert({
                                title: 'Success',
                                content: res.status.message,
                                type: 'blue',
                                typeAnimated: true,
                               
                            });
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.status.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
                $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
  });
});

$(document).ready(function() {
        $('#end_on').change(function(argument) {

            var startDate = $('#start_on').val();
            var endDate = $(this).val();
            if ((Date.parse(startDate) > Date.parse(endDate))) {
              
                $.alert({
                        title: 'Warning',
                        content: 'End date should be greater than Start date',
                        type: 'orange',
                        typeAnimated: true,
                    }); 
                $(this).val('').focus();
            }
        });
});

$(document).on("click", ".image-delete", function(e) {
    e.preventDefault();
    var oldImage = $(this).attr("data-oldimage");
    var id = $(this).attr("data-id");
    var indexKey = $(this).attr("data-key");
    var table = $(this).attr("data-table");
    var path =$(this).attr("data-path");
    $.confirm({
        icon: 'fa fa-spinner fa-spin',
        title: 'Confirm!',
        content: 'Are you sure want to do this?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            confirm: function () { 
                let dataJson = {
                    id: id,
                    indexKey: indexKey,
                    table: table,
                    oldImage: oldImage,
                    path: path,
                };
        

            if (id && table) {

                $.ajax({
                    type: "POST",
                    url: baseUrl + "Index/deleteImage",
                    data: dataJson,
                    dataType:"JSON",
                    success: function(res) {
                        // console.log(res);
                        if(res.status){
                            $.alert({
                                title: 'Success',
                                content: res.message,
                                type: 'green',
                                typeAnimated: true,
                               
                            });
                            setTimeout(function(){
                                  location.reload();
                                  
                                }, 1550);
                        }else{
                            $.alert({
                                title: 'Error',
                                content: res.message,
                                type: 'red',
                                typeAnimated: true,
                            }); 
                        }
                    }

          
                });
            }

                
            },
            cancel: function () {
                $.alert({
                    title: 'Canceled',
                    type: 'purple',
                    typeAnimated: true,
                }); 
            }
          
        }
    });
   
});
$(document).on("click", ".checkIfChecked", function(e) {
    if($(this).prop('checked') == true){
        $(this).val('1');
    }else if($(this).prop('checked') == false){
        $(this).val('0');
    }
});

$(document).ready(function() {

   $('#end_date').change(function() {
      var startDate = $('#start_date').val();
      var endDate = $(this).val();
      if ((Date.parse(startDate) > Date.parse(endDate))) {
           $.alert({
                   icon: 'fa fa-warning',
                   title: 'Warning!',
                   content: 'End date should be greater than Start date',
                  type: 'orange',
                  typeAnimated: true,
               });
           $(this).val('').focus();
           return false;
         }
   });

});

$(function() {
    $('#ownerApprove').hide();
    $(".checkAll").click(function(){
        checkwhat  = $(this).data("checkwhat");
        if(this.checked){
            $('#ownerApprove').show();
        } else {
            $('#ownerApprove').hide();
        }
        $('input:checkbox.'+checkwhat).not(this).prop('checked', this.checked);        
    });
    $(".chkSelect").click(function(){
        //checkwhat  = $(this).data("checkwhat");
        if(this.checked){
            $('#ownerApprove').show();
        } else {
            $('#ownerApprove').hide();
        }
        //$('input:checkbox.'+checkwhat).not(this).prop('checked', this.checked);
        $(this).prop('checked', this.checked);
        /*let c = $('.chkSelect').prop('checked');
        alert(c);*/
    });
});

/*$(function() {
    $(".chkSelect").click(function(){
        //checkwhat  = $(this).data("checkwhat");
        $("input[type='checkbox']").prop('checked', true);
        let b = $('.chkSelect').prop('checked');
        alert(b);
    });
});

*/

