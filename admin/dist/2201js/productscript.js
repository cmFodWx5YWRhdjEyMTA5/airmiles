jQuery(document).ready(function ($) {
    var product_list_table = jQuery('#product_list_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "name"},
            {"data": "sub_menu_name"},
            {"data": "saller"},
            {"data": "product_name"},
            {"data": "product_price"},
            {"data": "num_bottle"},
            {"data": "is_active"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/productprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        // "paging": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_product"});
        }
    });

    /* Add Product Start*/
    jQuery(document).on('click','.add_product',function(){
        jQuery('#AddProductModal').modal('show');
    });
    jQuery('#add_product_form').submit(function(event){
        event.preventDefault();

        jQuery.ajax({
            url: "process/productprocess.php?action=add_product",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddProductModal').modal('hide');
                    product_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Add Product End*/

    /* Edit Product start*/
    jQuery(document).on('click','.edit_product',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/productprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_product&id='+id,
            success: function(response) {
                jQuery('#edit_product_form #product_id').val(id);
                jQuery('#edit_product_form #edit_menu').val(response[0].menu_id);

                //fill sub menu
                jQuery.ajax({
                    url: 'process/productprocess.php',
                    data: "action=get_sub_menu&menu=" + response[0].menu_id,
                    type: 'POST',
                    dataType: 'json',
                    async:false,
                    success: function (response) {
                        jQuery("#edit_sub_menu").html(response);
                    }
                });

                jQuery('#edit_product_form #edit_sub_menu').val(response[0].sub_menu_id);
                jQuery('#edit_product_form #saller').val(response[0].saller_id);
                jQuery('#edit_product_form #product_name').val(response[0].product_name);
                jQuery('#edit_product_form #product_title').val(response[0].product_title);
                jQuery('#edit_product_form #product_tag').val(response[0].product_tag);
                jQuery('#edit_product_form #product_price').val(response[0].product_price);
                jQuery('#edit_product_form #num_bottle').val(response[0].num_bottle);
                jQuery('#edit_product_form #product_desc').val(response[0].desc);
                $("input[name=status][value=" + response[0].is_active + "]").attr('checked', 'checked');
                jQuery('#EditProductModal').modal('show');
            }
        });
    });
    jQuery('#edit_product_form').submit(function(event){
        event.preventDefault();

        jQuery.ajax({
            url: "process/productprocess.php?action=update_product",
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
    /* Edit Product End*/

    /* Delete Product start*/
    jQuery(document).on('click','.delete_product',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteProductBtn').attr('data-id',id);
        jQuery('#deleteProductModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteProductBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/productprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_product',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#deleteProductModal').modal('hide');
                    product_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Product end*/

    jQuery(document).on('change', '#menu', function (event) {
        var menu = jQuery('#menu option:selected').val();
        jQuery.ajax({
            url: 'process/productprocess.php',
            data: "action=get_sub_menu&menu=" + menu,
            type: 'POST',
            dataType: 'json',
            async:false,
            success: function (response) {
                jQuery("#sub_menu").html(response);
            }
        });
    });

    jQuery(document).on('change', '#edit_menu', function (event) {
        var menu = jQuery('#edit_menu option:selected').val();
        jQuery.ajax({
            url: 'process/productprocess.php',
            data: "action=get_sub_menu&menu=" + menu,
            type: 'POST',
            dataType: 'json',
            async:false,
            success: function (response) {
                jQuery("#edit_sub_menu").html(response);
            }
        });
    });

    /* Edit Product Image start*/
    jQuery(document).on('click','.view_product',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/productprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=view_product&id='+id,
            success: function(response) {
                jQuery('#view_product_form #product_id').val(id);
                jQuery('#pic').html(response);
                jQuery('#ViewProductImagesModal').modal('show');
            }
        });
    });
    jQuery('#view_product_form').submit(function(event){
        event.preventDefault();

        jQuery.ajax({
            url: "process/productprocess.php?action=upload_product_img",
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
    /* Edit Product Image End*/

    /* Delete Product Image start*/
    jQuery(document).on('click','.delete_product_img',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteProductImageBtn').attr('data-id',id);
        jQuery('#deleteProductImageModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteProductImageBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/productprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_product_image',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#deleteProductImageModal').modal('hide');
                    jQuery('#ViewProductImagesModal').modal('hide');
                    product_list_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Product Image end*/
});