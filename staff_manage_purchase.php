<?php
	include 'staff_header.php';
	$staff_id=$_SESSION['Staff_id'];
	if(isset($_POST['purchase'])) 
{
	extract($_POST);
	//$q3="select * from tbl_purchasemaster where Sup_id='$sup_id' and Status='pending' ";
	//$w=select($q3);
	//if(sizeof($w)>0)
	//{
		//$prmid=$w[0]['PMaster_id'];
		//$q4="select * from tbl_purchasechild where PMaster_id='$prmid' and Item_id='$Item_id'";
		//$e=select($q4);
		//if(sizeof($e)>0)
		//{
			//$q5="update tbl_purchasemaster set PTotal_Amt=PTotal_Amt+'$total' where PMaster_id='$prmid'";
			//update($q5);
			//$q6="update tbl_purchasechild set PQuantity=PQuantity+'$quantity',Cost_Price='$price' where Item_id='$Item_id'";
			//update($q6);
			//$ty="update tbl_item set Item_Stock=Item_Stock+'$quantity' where Item_id='$Item_id'";
			//update($ty);
			//alert("Purchase Added");
			//return redirect('purchase.php');
		//}else{
			//$q78="update tbl_purchasemaster set PTotal_Amt=PTotal_Amt+'$total' where PMaster_id='$prmid'";
			//update($q78);
			//$q2="insert into tbl_purchasechild values(null,'$prmid','$Item_id','$quantity','$price')";
			//insert($q2);
			//$ty="update tbl_item set Item_Stock=Item_Stock+'$quantity' where Item_id='$Item_id'";
			//update($ty);
			//alert("Purchase Added");
			//return redirect('purchase.php');
		//}
	//}else
	//{
			$sql = "select * from tbl_purchase_master where Pur_status='pending'";
			$master = $con->query($sql)->fetch_assoc();

			if($master){
				$t2="insert into tbl_purchase_child values(null,'{$master['Pur_master_id']}','$item','$quantity','$cost',". ( $cost + ($cost * 0.20) ) . ")";
				insert($t2);
			} else {
				$t1="insert into tbl_purchase_master values(null,'$staff_id','$vendor',CURRENT_TIMESTAMP(),'pending','$total')";
				$id=insert($t1);
				echo $t2="insert into tbl_purchase_child values(null,'$id','$item','$quantity','$cost',". ( $cost + ($cost * 0.20) ) . ")";
			
				insert($t2);
			}
		//$ty="update tbl_item set Item_Stock=Item_Stock+'$quantity' where Item_id='$Item_id'";
        //update($ty);
		// alert("Purchase Addedd");
		// $qr="update `tbl_item` set Item_Stock=Item_Stock+$quantity where Item_id=$Item_id";
		// update($qr);
		// return redirect('purchase_div.php');
	//}
	
}
 if(isset($_POST['confirm']))
 {
	extract($_POST);
	$rt="update tbl_purchase_master set Pur_status='paid' where Pur_master_id='$pmid'";
	update($rt);
	alert("Purchase Successfull");
	return redirect("staff_manage_purchase.php");
 }
?>

<script type="text/javascript">
	function TextOnTextChange()
	{
		var x =document.getElementById("p_amount").value;
		var y =document.getElementById("p_qnty").value;
		document.getElementById("t_amount").value = x * y;
	}

</script>


<center>
<h1 style="color: white;">Manage Purchase</h1><br>
<form method="post" >
	<table class="table" style="width: 1300px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Vendor</th>
			<td><select name="vendor" class="form-control">
				<option>Select</option>
				<?php 

				$q="select * from tbl_vendor where Vendor_status='1'";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['Vendor_id'] ?>"><?php echo $row['Vendor_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
		<tr>
			<th>Item</th>
			<td><select name="item" class="form-control">
				<option>Select</option>
				<?php 

				$q="select * from tbl_item";
				$res=select($q);
				foreach ($res as $row) {
					?>
					<option value="<?php echo $row['Item_id'] ?>"><?php echo $row['Item_name'] ?></option>
				<?php 
			}
				 ?>
			</select></td>
		</tr>
	
		<tr>
			<th>Cost Price</th>
			<td><input type="number" required=""  id="p_amount" class="form-control" name="cost"></td>
		</tr>
		

		<tr>
			<th>Quantity</th>
			<td><input type="number" required="" class="form-control"   id="p_qnty" onchange="TextOnTextChange()" name="quantity"></td>
		</tr>
		

		<tr>
			<th>Total</th>
			<td><input type="number" required="" class="form-control" id="t_amount" name="total"></td>
		</tr>

		<td align="center" colspan="2"><input type="submit" name="purchase" value="Add purchase" class="btn btn-danger"></td>
	</table>
</form>
</center>

<!-- </section> --><!-- End Hero -->
<center>
	<br><br><br><br>
	<h1 style="color: white;">View Purchase Cart</h1><br>
	<form method="POST">
		<table class="table" style="width: 900px;background: white;opacity: 0.85;">
			<tr>
				<th>No</th>
				<th>Vendor</th>
				<th>Item </th>
				<th>Quantity</th>
				<th>Cost Price</th>
				<th>Sell Price</th>
				<th>Date</th>
			</tr>
			<?php 

     $qr="SELECT * FROM `tbl_purchase_master` INNER JOIN `tbl_purchase_child` USING(`Pur_master_id`) INNER JOIN `tbl_vendor` USING(`Vendor_id`) INNER JOIN tbl_item USING(Item_id) WHERE `tbl_purchase_master`.`Pur_status`='pending'";
     $ress=select($qr);
     $sino=1;
     $total=0;
    foreach ($ress as $row) {?>
    	<tr>
    		<?php $total+=$row['Cost_price'] * $row['Pur_qty']?>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['Vendor_name'] ?></td>
    		<td><?php echo $row['Item_name'] ?></td>
    		<td><?php echo $row['Pur_qty'] ?></td>
    		<td><?php echo $row['Cost_price'] ?></td>
    		<td><?php echo $row['Sell_price'] ?></td>
    		<td><?php echo $row['Pur_date'] ?></td>
    		
    
    		
    		
    		

    	
    		
    		<!-- <td><a href="?did=<?php //echo $row['member_id'] ?>">delete</a></td>
    		<td><a href="?uid=<?php //echo $row['member_id'] ?>">update</a></td> -->
    	</tr>
    <?php }




			 ?>
			 <?php
			 if(sizeof($ress)>0)
			 {
			 	?>
			 	<!-- <tr>
			 		<td colspan="5" align="right">Grand Total : <?php echo $ress[0]['Pur_tot_amt'] ?>/-</td>
			 	</tr>
			 	<tr>
			 		<td colspan="5" align="right"><a href="?id=<?php echo $ress[0]['Pur_master_id'] ?>"><b>Confirm Purchase</b></a></td>
			 	</tr> -->
			<tr>
				<td><input type="hidden" name="pmid" value="<?php echo $ress[0]['Pur_master_id']?>"></td>
				<td style="padding-top: 20px;"><span style="font-size: 20px;color:red">Total: <?php echo $total ?></span></td>
				<td colspan="5" align="right"><input type="submit" class="btn btn-success" name="confirm" value="Confirm Purchase"></td>
			 </tr>			 	
			 	<?php
			 }  ?>
		</table>
	</form>
	<br>
	        <a class="btn btn-danger" href="staff_purchase_view.php"><b>View Purchase</b></a>&nbsp;&nbsp;&nbsp;
	        <a class="btn btn-danger" href="purchase_report.php"><b>Print Report</b></a>


</center>
<?php include 'footer.php' ?>