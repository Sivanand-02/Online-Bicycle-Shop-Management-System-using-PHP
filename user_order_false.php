<?php 
include 'user_header.php';
 ?>

<center><br><br>
	<h1 style="color: #fff">Order Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.7;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Item Image</th>
			<th>Date</th>
			<th>Total Amount</th>
		</tr>

		<?php 
			$q="SELECT * FROM tbl_order INNER JOIN tbl_cart_master USING(Cart_master_id) INNER JOIN tbl_cart_child USING(Cart_master_id)  INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_customer USING(Cust_id) GROUP BY Cart_master_id";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Cust_fname']; echo " "; echo $row['Cust_lname']; ?></td>
						<td><img src="<?php echo $row['Item_image']; ?>" style="width: 150px"></td>
						<td><?php echo $row['Order_date']; ?></td>
						<td><?php echo $row['Cart_tot_amt']; ?></td>
        				</tr>
        			<?php 
                        }
                           }?>
	</table>
</center>

 <?php
 include 'footer.php';
 ?>