<?php include 'admin_header.php';
extract($_GET);


if (isset($_POST['purchase'])) {
	extract($_POST);


$qq="SELECT * FROM `tbl_purchase_master` WHERE `Vendor_id`='$vendor' AND `Pur_status`='pending'";
$r=select($qq);
if(sizeof($r)>0){
	$pur_master_id=$r[0]['Pur_master_id'];
	$qr="SELECT * FROM `tbl_purchase_child`  WHERE  Item_id='$item' AND Cost_price='$cost' and Pur_master_id='$pur_master_id'";
	$res=select($qr);
	if (sizeof($res)>0) {
		$q4="update tbl_purchase_child set  Pur_qty=Pur_qty+'$quantity' where Pur_child_id='".$res[0]['Pur_child_id']."'";
		update($q4);
		$q6="update tbl_purchase_master set Pur_tot_amt=Pur_tot_amt+'$total' where Pur_master_id='$pur_master_id' ";
			update($q6);

		}
		else{

			$q1="insert into tbl_purchase_child values(null,'$pur_master_id','$item','$quantity','$cost') ";
  			insert($q1);	
  			$q61="update tbl_purchase_master set Pur_tot_amt=Pur_tot_amt+'$total' where Pur_master_id='$pur_master_id' ";
			update($q61);
			$ip=$cost*0.10;
  			$qi="update tbl_item set Sell_price=$cost+$ip where Item_id=$item";
  			update($qi);
		}
	}
else{

	$q6="insert into tbl_purchase_master values(null,'0','$vendor',curdate(),'pending','$total') ";
   $cmid=insert($q6);
   $q1="insert into tbl_purchase_child values(null,'$cmid','$item','$quantity','$cost') ";
  insert($q1);
  $ip=$cost*0.10;
  $qi="update tbl_item set Sell_price=$cost+$ip where Item_id=$item";
  update($qi);

}



$q3="update tbl_item set Item_stock=Item_stock+'$quantity' where Item_id='$item'";
  update($q3);
 alert('Item Added');
return redirect('admin_manage_purchase.php');







// $qr="SELECT * FROM `tbl_purchase_child`  WHERE  item_id='$item' AND cost_price='$cost'";
// $res=select($qr);
// if (sizeof($res)>0) {
// $q4="update tbl_purchase_child set  quantity=quantity+'$quantity' where cost_price='$cost'";
// update($q4);
//    alert('Sucessfully');
//    return redirect('admin_managepurchase.php');
// }else{




// 	echo$q2="select * from tbl_purchase_master where vendor_id='$vendor' and status='pending'";
// 	$res=select($q2);
// 	if (sizeof($res)>0) {
// 		$cmid=$res[0]['pur_master_id'];
// 	}else{

// 	echo$q6="insert into tbl_purchase_master values(null,'$cid','$vendor','$total',curdate(),'pending') ";
//    $cmid=insert($q6);
//    echo$q1="insert into tbl_purchase_child values(null,'$cmid','$item','$cost','$quantity') ";
//   insert($q1);
	

//  //   alert('Sucessfully');
//  // return redirect('admin_managepurchase.php');
// }



// $q4="select * from tbl_purchase_child where item_id='$item' and pur_master_id='$cmid' ";
//   $res2=select($q4);

//   if (sizeof($res2)>0) {
//   	$cdid=$res2[0]['pur_child_id'];

//   	$q5="update tbl_purchase_child set quantity=quantity+'$quantity', cost_price=cost_price+'$cost' where pur_child_id='$cdid' ";
//   	update($q5);
  	
//   }else{

// 	$q1="insert into tbl_purchase_child values(null,'$cmid','$item','$cost','$quantity')";
// 	insert($q1);
// 	}

// 	$q6="update tbl_purchase_master set tot_amount=tot_amount+'$total' where pur_master_id='$cmid' ";
// 	update($q6);

// 	$q3="update tbl_item set stock=stock+'$quantity' where item_id='$item'";
//    update($q3);
//  // alert('Sucessfully');
//  // return redirect('admin_managepurchase.php');

// }
    
	





}

if (isset($_GET['id'])) 
{
	$qr="update tbl_purchase_master set Pur_status='Paid' where Pur_master_id='$id' ";
	update($qr);
	alert("Items Purchased..");
	return redirect("admin_manage_purchase.php");
}

 ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="height: 700px">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">


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
</div>
</section><!-- End Hero -->
<center>
	<h1 style="color: white;">View Purchase Cart</h1><br>
	<form>
		<table class="table" style="width: 700px;background: white;opacity: 0.85;">
			<tr>
				<th>No</th>
				<th>Vendor</th>
				<th>Item </th>
				<th>Quantity</th>
				<th>Cost Price</th>
				<!-- <th>total price</th> -->
				
				
				
				


				
			</tr>
			<?php 

     $qr="SELECT * FROM `tbl_purchase_master` INNER JOIN `tbl_purchase_child` USING(`Pur_master_id`) INNER JOIN `tbl_vendor` USING(`Vendor_id`) INNER JOIN tbl_item USING(Item_id) WHERE `tbl_purchase_master`.`Pur_status`='pending'";
     $ress=select($qr);
     $sino=1;

    foreach ($ress as $row) {?>
    	<tr>
    		<td><?php echo $sino++; ?></td>
    		<td><?php echo $row['Vendor_name'] ?></td>
    		<td><?php echo $row['Item_name'] ?></td>
    		<td><?php echo $row['Pur_qty'] ?></td>
    		<td><?php echo $row['Cost_price'] ?></td>
    		
    
    		
    		
    		

    	
    		
    		<!-- <td><a href="?did=<?php //echo $row['member_id'] ?>">delete</a></td>
    		<td><a href="?uid=<?php //echo $row['member_id'] ?>">update</a></td> -->
    	</tr>
    <?php }




			 ?>
			 <?php
			 if(sizeof($ress)>0)
			 {
			 	?>
			 	<tr>
			 		<td colspan="5" align="right">Grand Total : <?php echo $ress[0]['Pur_tot_amt'] ?>/-</td>
			 	</tr>
			 	<tr>
			 		<td colspan="5" align="right"><a href="?id=<?php echo $ress[0]['Pur_master_id'] ?>"><b>Confirm Purchase</b></a></td>
			 	</tr>
			 	<?php
			 }  ?>
		</table>
	</form>
	        <a class="btn btn-danger" href="admin_purchase_view.php"><b>View Purchase</b></a>

</center>
<?php include 'footer.php' ?>