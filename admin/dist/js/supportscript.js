jQuery(document).ready(function ($) {
    var clients_list_table = jQuery('#clients_list_table').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "columns": [
            {"data": "sr"},           
            {"data": "email"},
            {"data": "phonenumber"},
            {"data": "message"},
            {"data": "isresolved"},
            {"data": "actions"}
        ],
        "dom": 'Bfrtip',
        "buttons": [
            'excel', 'pdf', 'pageLength'
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/supportprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        //"paging": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_clients"});
        }
    });
jQuery(document).on('click','.add_client',function(e){
        e.preventDefault();
        
         jQuery('#AddclientModal').modal('show');
    }); 
    jQuery(document).on('click','.edit_Clients',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }
 
        jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_Clients&id='+id,
            success: function(response) {
                
       
         jQuery('#EditreferralsModal #user_id').val(id);
                jQuery('#EditreferralsModal #name').val(response.name);
                jQuery('#EditreferralsModal #username').val(response.username);
             
                jQuery('#EditreferralsModal #password').val(response.password);
                jQuery('#EditreferralsModal #isactive').val(response.isactive);
              
                jQuery('#EditreferralsModal').modal('show');
            }
        });
    });
    
jQuery(document).on('click','.markisresolved1',function(e){
       e.preventDefault();
       var id = $(this).data('id');
        jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'markisresolved1',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    clients_list_table.ajax.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
      
    });
          jQuery(document).on('click','.markisresolved0',function(event){
       event.preventDefault();
       var id = $(this).data('id');
        jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'markisresolved0',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    clients_list_table.ajax.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
      
    });

    jQuery('#add_client_form').submit(function(event){
        event.preventDefault();

     
        jQuery.ajax({
            url: 'process/supportprocess.php?action=create_Clients',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
       
            contentType: false,

            cache: false,

            processData:false,
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    clients_list_table.ajax.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
        jQuery('#AddclientModal').modal('hide');
    });

    jQuery('#edit_referrals_form').submit(function(event){
        event.preventDefault();
      
       jQuery.ajax({
            url: 'process/supportprocess.php?action=update_Clients',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),     
            contentType: false,
            cache: false,
            processData:false,
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                       jQuery('#EditreferralsModal').modal('hide');
                      clients_list_table.ajax.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Edit clients End*/

    /* Delete clients start*/
    
    jQuery(document).on('click','.delete_Clients',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#deleteid').val(id);
        jQuery('#deletereferralsModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeletereferralsBtn', function(e) {
        e.preventDefault();
        var id =  jQuery('#deleteid').val();
        
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_Clients',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deletereferralsModal').modal('hide');
                    clients_list_table.ajax.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete clients end*/
});


/* view quesitons start*/
jQuery(document).on('click','.view_questions',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    // jQuery('#confirmDeleteclientsBtn').attr('data-id',id);
    
    jQuery.ajax({
            url: 'process/supportprocess.phpp',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_question_answer',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    jQuery('#viewclientsModal .modal-body').html(response.msg);
                    jQuery('#viewclientsModal').modal('show');
                    // toastr['success'](response.msg, '');
                    // $('#deleteclientsModal').modal('hide');
                    // clients_list_table.draw();
                } else {
                    // toastr['error'](response.msg, '');
                }
            }
        });
}); 

jQuery(document).on('click','.permission_Clients',function(e){
    e.preventDefault();
    var id = jQuery(this).data('id');
    var marked = jQuery(this).data('marked');
    // jQuery('#confirmDeleteclientsBtn').attr('data-id',id);
    
    jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'update_Clients_permission',
                id: id,
                marked: marked,
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                   toastr['success'](response.msg, '');
                   location.reload(); 
                   clients_list_table.draw();
                } else {
                   toastr['error'](response.msg, '');
                }
            }
        });
}); 

jQuery(document).on('click','.view_images',function(e){
    e.preventDefault();
    var id = $(this).data('id');
    // jQuery('#confirmDeleteclientsBtn').attr('data-id',id);
    
    jQuery.ajax({
            url: 'process/supportprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'get_images',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    jQuery('#viewImageModal .image_view_table tbody').html(response.msg);
                    jQuery('#viewImageModal').modal('show');
                    // toastr['success'](response.msg, '');
                    // $('#deleteclientsModal').modal('hide');
                    // clients_list_table.draw();
                } else {jQuery('#viewImageModal .image_view_table tbody').html(response.msg);
                    jQuery('#viewImageModal').modal('show');
                }
            }
        });
}); 
/* view quesitons end*/ 
