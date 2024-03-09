<?php 
include 'admin_header.php';
 ?>
<center>
						<h1 style="color: #fff">Purchase Details</h1><br>
						<table class="table" style="width: 1300px;color: black;background: white;opacity: 0.7;">
						<tr>
						<th>Sl no.</th>
						<th>Item Name</th>
						<th>Vendor Name</th>
						<th>Cost Price</th>
						<th>Date</th>
						<th>Quantity</th>
						</tr>

						<?php 
				 $q="SELECT * FROM tbl_purchase_child INNER JOIN tbl_purchase_master USING(Pur_master_id) INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_vendor USING(Vendor_id) where Pur_status='Paid'";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Item_name']; ?></td>
						<td><?php echo $row['Vendor_name']; ?></td>
						<td><?php echo $row['Cost_price']; ?></td>
						<td><?php echo $row['Pur_date']; ?></td>
						<td><?php echo $row['Pur_qty']; ?></td>
					
					<?php } ?>
					</tr>
				<?php
			}
			?>	
				</table>
			</center>
			
<?php 
include 'footer.php' ?>