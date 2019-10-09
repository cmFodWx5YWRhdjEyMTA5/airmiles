<script type="text/javascript">
	function fnClickProcessTransaction(){
		document.transactionInfoForm.submit();
	}

</script>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<form action="bankHosted/HostedPaymentCoreSubmit.php" id="transactionInfoForm" method="post" name="transactionInfoForm" METHOD="POST">
				<div class="form-group row">
					<label for="ActionLbl" class="col-sm-3 col-form-label">Action</label>
					<div class="col-sm-3">
						<select class="form-control" name="action">
							<option selected="selected" value="1">Purchase</option>
							<option value="4">Authorize</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="ActionLbl" class="col-sm-3 col-form-label">Amount</label>
					<div class="col-sm-3">
						<input type="text" name="userid" id="userid" value="122">
						<input type="text" name="productid" id="productid" value="2">
						<input type="text" name="price" id="price" value="1.20">
						<input type="text" name="isoab" id="isoab" value="1">

						<input type="text" class="form-control" size="20" name="amount" value="0.100" />
					</div>
				</div>
				<div class="form-group row">
					<label for="udf1Lbl" class="col-sm-3 col-form-label">Udf 1</label>
					<div class="col-sm-3">
						<input size="20" name="udf1"  type="text" class="form-control" value="user defined field 11111" />
					</div>
				</div>

				<div class="form-group row">
					<label for="udf2Lbl" class="col-sm-3 col-form-label">Udf 2</label>
					<div class="col-sm-3">
						<input size="20" name="udf2"  type="text" class="form-control" value="user defined field 2222" />
					</div>
				</div>
				<div class="form-group row">
					<label for="udf3Lbl" class="col-sm-3 col-form-label">Udf 3</label>
					<div class="col-sm-3">
						<input size="20" name="udf3"  type="text" class="form-control" name="udf3" value="user defined field 3333" />
					</div>
				</div>
				<div class="form-group row">
					<label for="udf4Lbl" class="col-sm-3 col-form-label">Udf 4</label>
					<div class="col-sm-3">
						<input size="20" name="udf4"  type="text" class="form-control" name="udf4" value="user defined field 4444" />
					</div>
				</div>
				<div class="form-group row">
					<label for="udf5Lbl" class="col-sm-3 col-form-label">Udf 5</label>
					<div class="col-sm-3">
						<input size="20" name="udf5"  type="text" class="form-control" name="udf5" value="user defined field 55555" />
					</div>
				</div>
				<div class="form-group row">
					<label for="trackId" class="col-sm-3 col-form-label">Track Id</label>
					<div class="col-sm-3">
						<input size="20" name="trackId"  type="text" class="form-control" value="<?php echo getToken(17) ?>" />
					</div>
				</div>
				<div class="form-group row">
					<label for="expireDateLbl" class="col-sm-3 col-form-label"></label>
					<div class="col-sm-4">
						<button onclick="fnClickProcessTransaction();" type="button" class="btn btn-default">Process</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>