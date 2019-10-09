<html>
	<head>
    	<link href="../css/payments-inter.css" rel="stylesheet" type="text/css">
	    <style>
		    .clr {
		        overflow: hidden;
		    }
		    .mer-logo-wrap {
		        text-align: left;
		        padding-left: 35px;
		    }
		    .header-table {
		        width: 100%;
		    }
		    .header-table td {
		        vertical-align: middle;
		        width: 49.9%;
		    }
		    .mer-logo-wrap > img {
		        max-height: 75px;
		    }
		    .payz-logo-wrap {
		        text-align: right;
		        padding-right: 35px;
		    }
		    .norm-hd {
		        padding: 15px 0;
		        position: relative;
		        z-index: 1000;
		        border-bottom: 1px solid #e5e5e5;
		    }
		    
		    .success-info {
    			background: none repeat scroll 0 0 #dff2de;
    			border: 2px solid #468847;
    			color: #B94A48;
			}
			.success-info font{
				color: green;
			}
			.failure-info font{
				color: red;
			}
		</style>
		
	</head>
	<body>
        <div class="wrap" id="detect-iframe">
			<form name="formACS" id="formACS" action="../" method="POST" target="_parent">
        		<table class="info failure-info" >
				<tr>
					<td>
						<table align="center">
							<tr>
								<td colspan="2" align="center">
									<h2><B>Transaction Error Details </B></h2>
								</td>
							</tr>
								<td>ErrorText</td><td><?php echo isset($_GET['ErrorText']) ? $_GET['ErrorText'] : isset($_POST['ErrorText']) ? $_POST['ErrorText'] : "" ?></td>
							<tr>
							</tr>
							</table>
						</td>
					</tr>
				</table>
			<br>
        </form>
            <p class="no-re-warn return-flkp succ"><a class="btn btn-danger" onclick="document.getElementById('formACS').submit();" target="_parent">Click here</a> for go to Home page </p>
        </div>
        <script>
            if (!(self === window.top)) {
                var el = document.getElementById('detect-iframe');
                if (el) {
                    el.className += ' iframe';
                }
            }
        </script>

	</body>
</html>