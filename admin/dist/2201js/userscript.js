jQuery(document).ready(function ($) {
    var users_list_table = jQuery('#users_list_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "name"},
            {"data": "reg_email"},
            {"data": "reg_phone"},
            {"data": "device_type"},
            {"data": "reg_created"},
            {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/usersprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        // "paging": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_users"});
        }
    });

    /* Edit Users start*/
    jQuery(document).on('click','.edit_users',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/usersprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_users&id='+id,
            success: function(response) {
                jQuery('#edit_users_form #user_id').val(id);
                jQuery('#edit_users_form .reg_fname').val(response[0].reg_fname);
                jQuery('#edit_users_form .reg_lname').val(response[0].reg_lname);
                $("input[name=status][value=" + response[0].is_active + "]").attr('checked', 'checked');
                jQuery('#EditUsersModal').modal('show');
            }
        });
    });
    jQuery('#edit_users_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        jQuery.ajax({
            url: 'process/usersprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=update_users',
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
    /* Edit Users End*/

    /* Delete Users start*/
    jQuery(document).on('click','.delete_users',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteUsersBtn').attr('data-id',id);
        jQuery('#deleteUsersModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteUsersBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/usersprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_users',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteUsersModal').modal('hide');
                    users_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Users end*/
});