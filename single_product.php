<?php
include 'public_header.php';
extract($_GET);
// $q="SELECT * FROM tbl_item WHERE Item_id='$id'";
// $res=select($q);
// $q2="INSERT INTO tbl_cart_master VALUES(null,'',)"
// $q2="update tbl_item set Item_stock=Item_stock+'$prod_qty' where Item_id='$id'";
// update($q2);
?>
<script type="text/javascript">
	function TextOnTextChange()
	{
		var x =document.getElementById("qty").value;
		var y =document.getElementById("amt").value;
		document.getElementById("t_amt").value = x * y;
	}
</script>
<div class="banner-info text-left">
	<center>
	<font color="red">
	<h1 style="margin-top: -2em">Product Details</h1><br>
<form method="post" style="width: 500px;text-align: left;">
								<div>
									<img src="<?php echo $img?>" height="450" width="100">
								</div>
								<div style="color: transparent; ">
								<br><br>
								<h4 style="font-family:Arial;color: red;">Item Description</h3>
								<p style="font-family:Arial; font-size: 20px;color: red"><?php echo $desc ?></p>
								<br>
								</div>
								Quantity : <input id="qty" name="prod_qty" type="text" onchange="TextOnTextChange()"  class="form-control"><br><br>
								Amount : <input id="amt" name="prod_amt" type="textarea" value="<?php echo $amt?>" class="form-control"><br><br>
								Total Amount : <input type="text"  id="t_amt" class="form-control"><br><br>
								<input type="submit" name="Make_order" value="Make Order" class="btn btn-danger">

</form>
</font>
</center>
</div>
<?php
include 'footer.php';
?>
