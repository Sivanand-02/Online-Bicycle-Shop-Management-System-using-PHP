<?php 
include 'admin_header.php';
if(isset($_POST['pur_submit'])){
	extract($_POST);
	 $q1="INSERT INTO tbl_purchase_master VALUES(NULL,'0','$pur_vendor_id',curdate())";
	$id=insert($q1);
	 $q2="INSERT INTO tbl_purchase_child VALUES(NULL,'$id','$pur_item_id','$pur_qty','$pur_cost')";
	insert($q2);
	$q3="UPDATE tbl_item SET Item_stock=Item_stock+'$pur_qty' WHERE Item_id='$pur_item_id'";
	update($q3);
	redirect('admin_manage_purchase.php');
}
 ?>
 <div class="banner-info text-left">
							<font color=red>
								<h1 style="margin-top: -2em"></h1><br>
							<form method="post" style="width: 500px;">
								Select Item:
								<select name="pur_item_id" class="form-control">
									<option>Select</option>
									<?php 
									$q="select * from tbl_item";
									$res=select($q);
									foreach ($res as $row) {?>
										<option value="<?php echo $row['Item_id'] ?>"><?php echo $row['Item_name'] ?></option>
									<?php }
									 ?>
								</select><br><br>
								Select Vendor:
								<select name="pur_vendor_id" class="form-control">
									<option>Select</option>
									<?php
									$q="select * from tbl_vendor where Vendor_status='1'";
									$res=select($q);
									foreach($res as $row) {?>
									<option value="<?php echo $row['Vendor_id']?>"><?php echo $row['Vendor_name']?></option>
								<?php }
								?>
								</select><br><br>
								Cost Price : <input type="text" name="pur_cost" class="form-control"><br><br>
								Quantity : <input type="text" name="pur_qty" class="form-control"><br><br>
								<input type="submit" name="pur_submit" value="Make Purchase" class="btn btn-danger">
							</form>
							</font>
						</div>
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
				 $q="SELECT * FROM tbl_purchase_child INNER JOIN tbl_purchase_master USING(Pur_master_id) INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_vendor USING(Vendor_id)";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Item_name']; ?></td>
						<td><?php echo $row['Vendor_name']; ?></td>
						<!-- <td><?php echo $row['Staff_fname']; ?></td> -->
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
include 'footer.php';
?>