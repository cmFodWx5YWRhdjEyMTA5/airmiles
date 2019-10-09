jQuery(document).ready(function ($) {
    var clients_list_table = jQuery('#clients_list_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "icon"},
            {"data": "title"},
            {"data": "titlearabic"},
            {"data": "image"},
			{"data": "language"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/howtotutorialprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        // "paging": true,
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
    /* Edit clients start*/
    jQuery(document).on('click','.edit_Clients',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/howtotutorialprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_Clients&id='+id,
            success: function(response) {
                
                jQuery('#EditreferralsModal #user_id').val(id);
                jQuery('#EditreferralsModal #title').val(response.title);
                jQuery('#EditreferralsModal #titlearabic').val(response.titlearabic);
                 jQuery('#EditreferralsModal #language').val(response.language);

                jQuery('#EditreferralsModal #imgsrc').val(response.icon);
                
                document.getElementById("logoimageuploaded").src="../img/howtotutorial/"+response.icon;

                jQuery('#EditreferralsModal #imgsrc1').val(response.image);
                
                document.getElementById("imageuploaded").src="../img/howtotutorial/"+response.image;
                
                
                
                jQuery('#EditreferralsModal').modal('show');
            }
        });
    });
    
    jQuery('#add_client_form').submit(function(event){
        event.preventDefault();

     
        jQuery.ajax({
            url: 'process/howtotutorialprocess.php?action=create_Clients',
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
            url: 'process/howtotutorialprocess.php?action=update_Clients',
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
            url: 'process/howtotutorialprocess.php',
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

