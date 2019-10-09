jQuery(document).ready(function ($) {
    var clients_list_table = jQuery('#clients_list_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "firstname"},
            {"data": "lastname"},
            {"data": "email"},
            {"data": "phonenumber"},
            {"data": "employeeid"},
            // {"data": "question3"},
            // {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/userprocess.php",

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





    /* Delete clients start*/
    
    jQuery(document).on('click','.delete_Clients',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#deleteid').val(id);
        jQuery('#deletereferralsModal').modal('show');
    });
    jQuery(document).on('click','.delete',function(e){
        e.preventDefault();
        var id = $(this).data('id');
       
        jQuery('#deleteimgModal #deleteid').val(id);
        jQuery('#deleteimgModal').modal('show');
    });



    
    jQuery(document).on('click', '#confirmDeletereferralsBtn', function(e) {
        e.preventDefault();
        var id =  jQuery('#deleteid').val();
        
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/userprocess.php',
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

jQuery(document).on('click', '#confirmDeleteimgBtn', function(e) {
        e.preventDefault();
        var id =  jQuery('#deleteimgModal #deleteid').val();
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/propertyimageprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_Clients',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteimgModal').modal('hide');
            } else {
                    toastr['error'](response.msg, '');
                }
            }
        });


  });

});

