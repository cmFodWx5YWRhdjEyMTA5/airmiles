jQuery(document).ready(function ($) {
    var saller_list_table = jQuery('#saller_list_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "name"},
            {"data": "user_name"},
            {"data": "password"},
            {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/sallerprocess.php",
        "bProcessing": true,
        "bServerSide": true,
        "iDisplayLength": 10,
        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_saller"});
        }
    });

    /* Add Saller Start*/
    jQuery(document).on('click','.add_saller',function(){
        jQuery('#AddSallerModal').modal('show');
    });
    jQuery('#add_saller_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        jQuery.ajax({
            url: 'process/sallerprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=add_saller',
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddSallerModal').modal('hide');
                    saller_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Add Saller End*/

    /* Edit Saller start*/
    jQuery(document).on('click','.edit_saller',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/sallerprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_saller&id='+id,
            success: function(response) {
                jQuery('#edit_saller_form #saller_id').val(id);
                jQuery('#edit_saller_form .full_name').val(response[0].name);
                jQuery('#edit_saller_form .user_name').val(response[0].user_name);
                $("input[name=status][value=" + response[0].is_active + "]").attr('checked', 'checked');
                jQuery('#EditSallerModal').modal('show');
            }
        });
    });
    jQuery('#edit_saller_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        jQuery.ajax({
            url: 'process/sallerprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=update_saller',
            async:false,
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    location.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Edit Saller End*/

    /* Delete Saller start*/
    jQuery(document).on('click','.delete_saller',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteSallerBtn').attr('data-id',id);
        jQuery('#deleteSallerModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteSallerBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/sallerprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_saller',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteSallerModal').modal('hide');
                    saller_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Saller end*/
});