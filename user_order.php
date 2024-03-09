<?php 
include 'user_header.php';
include 'random_functions.php';

 $cid=$_SESSION['Cust_id'];
extract($_GET);
?>
<form method="post">
		<center><br><br><br>
		<h1 style="margin-top: 25px;color: white;">My Orders</h1><br><br>
		<table class="table" style="width: 900px;color: black;background: white;opacity: 0.85;">
			<tr>
				<th>Sl No</th>
				<!-- <th>Name</th> -->
				<th>Item Image</th>
				<th>Item Details</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Product Status</th>
				
			</tr>

			<?php 
				//$q0="SELECT * FROM `tbl_cart_master` INNER JOIN `tbl_cart_child` USING(`Cart_master_id`) INNER JOIN `tbl_customer` USING(Cust_id) INNER JOIN `tbl_item` USING(`Item_id`) where Cust_id='$cid' and Cart_status='Paid'";
				$q0="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING (`Cust_id`) INNER JOIN `tbl_item` USING (Item_id) where Cust_id='$cid' and Cart_status='Paid'  ";
     //$res=select($q);
				$temp=select($q0);
				$si=1;
				if(sizeof($temp)>0){
					foreach($temp as $t)
					{
						?>
						<tr>
							<td><?php echo $si++ ?></td>
<!-- 							<td><?php //echo $t['Cust_fname']; ?></td>
 -->						<td><img src="<?php echo $t['Item_image'] ?>" style="width: 100px; height: 120px;"></td>
						<td style="vertical-align: middle;"><?php echo $t['Item_name'] ?></td>
						<td style="vertical-align: middle;"><?php echo getOldProductPrice($t['Item_id'],$t['Order_id']); ?></td>
						<td style="vertical-align: middle;"><?php echo $t['Cart_qty'] ?></td>
						<td style="vertical-align: middle;"><?php echo $t['Cart_status'] ?></td>						
						<td style="vertical-align: middle;"><a href="user_invoice1.php?cmid=<?php echo $t['Cart_master_id'] ?>&id=<?php echo $t['Item_id']; ?>&date=<?php echo $t['Cart_date'] ?>&oid=<?php echo $t['Order_id'] ?>" class="btn btn-danger">Invoice</a></td>

						</tr>

							
						<?php
					} ?>
					
                    <?php
                } ?>
     
        </table><br>
    </center>
</form>
<?php include 'footer.php'?>