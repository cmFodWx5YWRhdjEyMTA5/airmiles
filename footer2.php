
<script src="admin/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.password-validation-2.js"></script>
<script>
  $(document).ready(function() {
    $("#myPassword").passwordValidation({"confirmField": "#myConfirmPassword"}, function(element, valid, match, failedCases) {

      $("#errors").html("<pre>" + failedCases.join("\n") + "</pre>");
      
      if(valid){ $(element).css("border-bottom","2px solid green");
			   
			   
			   document.getElementById('errors').innerHTML="";
			   }
      if(!valid){ $(element).css("border-bottom","2px solid red");}

      if(valid && match){ $("#myConfirmPassword").css("border-bottom","2px solid green"); $('#frmsubmit').prop('disabled', false);
						
									   document.getElementById('errors').innerHTML="";

						}
      if(!valid || !match){ $("#myConfirmPassword").css("border-bottom","2px solid red"); $('#frmsubmit').prop('disabled', true);}
    });
  });
</script>

<!-- Bootstrap 3.3.7 -->

 <script>
    function validatePassword() {
       if(jQuery("#myPassword").val() == jQuery("#myConfirmPassword").val()){
       var user =  jQuery('#user').val();
       var myPassword =  jQuery('#myPassword').val();
       var myConfirmPassword =  jQuery('#myConfirmPassword').val();
        
       
        if(!user) { alert('Invalid Request!') }
        jQuery.ajax({
            url: 'admin/process/userprocess.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'update_password',
                user: user,
                myPassword: myPassword,
				language:2
            },
            success: function(response, textStatus, xhr) {
                if(response.status) {
                   alert(response.msg)
                } else {
                     alert(response.msg)
                }
            }
        });
           //submit using ajax
       
        }
        else{
          alert('!كلمة المرور وتأكيد كلمة المرور يجب أن تكون هي نفسها');
        }
    }
 
    </script>
</body>

</html>