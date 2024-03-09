<?php
include 'public_header.php'
?>

<div class="banner-info text-left">
		<font color=red> 
			<h1 style="margin-top: -2em">Enter Card details</h1><br>
			<form method="post" style="width: 500px;">
			Card Number : <input type="text" name="card_no" class="form-control"><br><br>
			Card Holder Name : <input type="text" name="card_name" class='form-control'><br><br>
			CVV : <input type="text" name="cvv" class="form-control"><br><br>
			Expiry date : <input type="text" name="exp_date" class="form-control"><br><br>
			<input type="submit" name="pay" value="Pay" class="btn btn-danger">
		</font>