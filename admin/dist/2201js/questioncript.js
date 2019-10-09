jQuery(document).ready(function ($) {
    var question_table = jQuery('#question_table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false,
        "columns": [
            {"data": "sr"},
            {"data": "question"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']],
        "sAjaxSource": "process/questionprocess.php",

        "bProcessing": true,
        "bServerSide": true,
        // "paging": true,
        "iDisplayLength": 10,

        "fnPreDrawCallback": function (oSettings) {
            //logged_in_or_not();
        },
        "fnServerParams": function (aoData) {
            aoData.push({"name": "action", "value": "get_Question"});
        }
    });
    
    /* Add Main Menu Start*/
    jQuery(document).on('click','.add_question',function(){
        jQuery('#AddQuestionModal').modal('show');
    });
    jQuery('#add_question_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();
        jQuery.ajax({
            url: "process/questionprocess.php?action=add_Question",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    jQuery('#AddQuestionModal').modal('hide');
                    question_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /* Add Main Menu End*/

    /* Edit Main Menu start*/
    jQuery(document).on('click','.edit_question',function(e){
        e.preventDefault();

        var id = $(this).data('id');
        if(!id) { return; }

        jQuery.ajax({
            url: 'process/questionprocess.php?action=edit_Question&id='+id,
            type: 'POST',
            dataType: 'json',
            data: 'action=edit_Question&id='+id,
            success: function(response) {
				// console.log(response);
               jQuery('#edit_question_form #question_id').val(id);
               jQuery('#edit_question_form .question_name').val(response.question);

               jQuery('#EditQuestionModal').modal('show');
            }
        });
    });
    jQuery('#edit_question_form').submit(function(event){
        event.preventDefault();
        var $formData = jQuery(this).serialize();
        jQuery.ajax({
            url: "process/questionprocess.php?action=update_Question",
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(response) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                     question_table.draw();

                    // location.reload();
                } else {
                    toastr['error'](response.msg, '');
                }
                jQuery('#EditQuestionModal').modal('hide');
            }
        });
    });
    /* Edit Main Menu End*/
    
    /* Delete Main Menu start*/ 
    jQuery(document).on('click','.delete_question',function(e){
        console.log("here");
        e.preventDefault();
        var id = $(this).data('id');
        jQuery('#confirmDeleteQuestionBtn').attr('data-id',id);
        jQuery('#DeleteQuestionModal').modal('show');
    });
    jQuery(document).on('click', '#confirmDeleteQuestionBtn', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id) { return; }
        jQuery.ajax({
            url: 'process/questionprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete_Question',
                id: id
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                    toastr['success'](response.msg, '');
                    $('#DeleteQuestionModal').modal('hide');
                    question_table.draw();
                } else {
                    toastr['error'](response.msg, '');
                }
            }
        });
    });
    /*Delete Main Menu end*/
});