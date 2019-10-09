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
            {"data": "image"},
            {"data": "cardname"},
   
            {"data": "referralcount"},
            {"data": "campaign_id"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/referralcardsprocess.php",

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
         jQuery.ajax({
            url: 'process/categoryprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=getcategory',
            success: function(response) {

                 jQuery('#AddclientModal #categoryid').html(response);
            }
        });
      
    /* Edit clients start*/
    jQuery(document).on('click','.edit_Clients',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/referralcardsprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_Clients&id='+id,
            success: function(response) {
                 jQuery('#EditreferralsModal #user_id').val(id);
                //jQuery('#EditreferralsModal #username').val(response.username);
                  var mid = response.categoryid;   
            jQuery.ajax({
            url: 'process/categoryprocess.php',
            type: 'POST',
            dataType: 'json',
            data: 'action=getcategory1&id='+mid,
            success: function(response) {

                 jQuery('#EditreferralsModal #categoryid').html(response);
            }
        });
                jQuery('#EditreferralsModal #user_id').val(id);
                jQuery('#EditreferralsModal #cardname').val(response.cardname);
                jQuery('#EditreferralsModal #cardnamearabic').val(response.cardnamearabic);
                jQuery('#EditreferralsModal #termscondition').val(response.termscondition);
                jQuery('#EditreferralsModal #termsconditionarabic').val(response.termsconditionarabic);
                jQuery('#EditreferralsModal #referralcount').val(response.referralcount);
                jQuery('#EditreferralsModal #actualprice').val(response.actualprice);
                jQuery('#EditreferralsModal #pricecurrency').val(response.pricecurrency);
                jQuery('#EditreferralsModal #campaign_id').val(response.campaign_id);
                jQuery('#EditreferralsModal #campaign_name').val(response.campaign_name);
             
                jQuery('#EditreferralsModal #imgsrc').val(response.image);
                
                document.getElementById("logoimageuploaded").src="../img/referralcards/"+response.image;
                

                jQuery('#EditreferralsModal #imgsrc1').val(response.featuredimage);
                
                document.getElementById("featuredimageuploaded").src="../img/referralcards/"+response.featuredimage;
                
                
                
                jQuery('#EditreferralsModal').modal('show');
            }
        });
    });
    
    jQuery('#add_client_form').submit(function(event){
        event.preventDefault();

     
        jQuery.ajax({
            url: 'process/referralcardsprocess.php?action=create_Clients',
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
            url: 'process/referralcardsprocess.php?action=update_Clients',
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
            url: 'process/referralcardsprocess.php',
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

