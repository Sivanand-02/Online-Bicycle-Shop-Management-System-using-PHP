<?php 
include 'staff_header.php';
extract($_GET);
 ?>
<center><br><br>
	<h1 style="color: #fff">Customer Purchase Details</h1><br>
	<h5 style="color: red; text-align: left;">Customer : <?php echo $custname; ?></h4><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<!-- <th>Name</th> -->
			<th>Item</th>
			<th>Date</th>
			<th>Unit Price</th>
		</tr>

		<?php 
			 $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING (`Cust_id`) INNER JOIN `tbl_item` USING (Item_id) INNER JOIN tbl_purchase_child using (Item_id) WHERE Cust_id='$custid' and Cart_status='Paid'";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Item_name'] ?></td>
						<td><?php echo $row['Order_date']; ?></td>
						<td><?php echo $row['Sell_price']; ?></td>
        				</tr>
        			<?php 
                        }
                           }?>
	</table>
	
</center>
<?php
include 'footer.php';
?>