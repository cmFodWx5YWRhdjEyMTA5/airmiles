jQuery(document).ready(function ($) {
    var main_menu_table = jQuery('#main_menu_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "name"},
            {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/menuprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        // "paging": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_category"});
        }
    });
    
    /* Add Main Menu Start*/
    jQuery(document).on('click','.add_main_menu',function(){
        jQuery('#AddMainMenuModal').modal('show');
    });
    jQuery('#add_main_menu_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        /*jQuery.ajax({
            url: 'process/menuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=add_main_menu',
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddMainMenuModal').modal('hide');
                    main_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });*/

        jQuery.ajax({
            url: "process/menuprocess.php?action=add_main_menu",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddMainMenuModal').modal('hide');
                    main_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Add Main Menu End*/

    /* Edit Main Menu start*/
    jQuery(document).on('click','.edit_main_menu',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/menuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_main_menu&id='+id,
            success: function(response) {
               jQuery('#edit_main_menu_form #menu_id').val(id);
               jQuery('#edit_main_menu_form .menu_main_name').val(response[0].name);
               if(response[0].image!=""){
                   jQuery("#edit_main_menu_form #thumbMenuImage").attr('src',response[0].image);
               }
               $("input[name=status][value=" + response[0].is_active + "]").attr('checked', 'checked');
               jQuery('#EditMainMenuModal').modal('show');
            }
        });
    });
    jQuery('#edit_main_menu_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();

        /*jQuery.ajax({
            url: 'process/menuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: $formData + '&action=update_main_menu',
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
            url: "process/menuprocess.php?action=update_main_menu",
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
    /* Edit Main Menu End*/
    
    /* Delete Main Menu start*/ 
    jQuery(document).on('click','.delete_main_menu',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteMainMenuBtn').attr('data-id',id);
        jQuery('#deleteMainMenuModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteMainMenuBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/menuprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_main_menu',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteMainMenuModal').modal('hide');
                    main_menu_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Main Menu end*/
});