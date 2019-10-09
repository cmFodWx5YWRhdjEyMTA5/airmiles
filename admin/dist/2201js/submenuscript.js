jQuery(document).ready(function ($) {
    var sub_menu_table = jQuery('#sub_menu_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "menu_name"},
            {"data": "sub_menu_name"},
            {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/submenuprocess.php",
        "bProcessing": true,
        "bServerSide": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_sub_menu"});
        }
    });

    /*Add Sub Menu Start*/
    jQuery(document).on('click','.add_sub_menu',function(){
        jQuery('#AddSubMenuModal').modal('show');
    });
    jQuery('#add_sub_menu_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        /*jQuery.ajax({
            url: 'process/submenuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=add_sub_menu',
            success: function(response, textStatus, xhr) {
                //called when successful
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddSubMenuModal').modal('hide');
                    sub_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });*/

        jQuery.ajax({
            url: "process/submenuprocess.php?action=add_sub_menu",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddSubMenuModal').modal('hide');
                    sub_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });

    });
    /* Add Sub Menu End*/

    /* Edit Sub Menu start*/
    jQuery(document).on('click','.edit_sub_menu',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/submenuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_sub_menu&id='+id,
            success: function(response) {
                jQuery('#edit_sub_menu_form #sub_menu_id').val(id);
                jQuery('#edit_sub_menu_form #menu').val(response[0].menu_id);
                jQuery('#edit_sub_menu_form .sub_menu_name').val(response[0].sub_menu_name);
                if(response[0].image!=""){
                    jQuery("#edit_sub_menu_form #thumbSubMenuImage").attr('src',response[0].image);
                }
                $("input[name=status][value=" + response[0].is_active + "]").attr('checked', 'checked');
                jQuery('#EditSubMenuModal').modal('show');
            }
        });
    });
    jQuery('#edit_sub_menu_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        /*jQuery.ajax({
            url: 'process/submenuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=update_sub_menu',
            async:false,
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    location.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });*/

        jQuery.ajax({
            url: "process/submenuprocess.php?action=update_sub_menu",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    location.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Edit Sub Menu End*/

    /* Delete Sub Menu start*/
    jQuery(document).on('click','.delete_sub_menu',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteSubMenuBtn').attr('data-id',id);
        jQuery('#deleteSubMenuModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteSubMenuBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/submenuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_sub_menu',
                id: id
            },
            success: function(response, textStatus, xhr) {
                //called when successful
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteSubMenuModal').modal('hide');
                    sub_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Sub Menu end*/
});