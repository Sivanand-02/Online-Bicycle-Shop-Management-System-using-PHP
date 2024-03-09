<?php 
include 'staff_header.php';

if(isset($_POST['v_submit'])){
	extract($_POST);
	$qv="INSERT INTO tbl_vendor VALUES(null,'$staff_id','$v_name','$v_gno','$v_city','$v_district','$v_pin','$v_phno','1')";
	insert($qv);
}

if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_vendor set Vendor_status='0' where Vendor_id='$did'";
	update($q);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_vendor set Vendor_status='1' where Vendor_id='$uid'";
	update($q);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_vendor where Vendor_id='$upid'";
    $res=select($q);

        
}

if (isset($_POST['update'])) {
    extract($_POST);

    $q="update tbl_vendor set Vendor_name='$v_name',Vendor_gno='$v_gno',Vendor_phone='$v_phno',Vendor_city='$v_city',Vendor_dist='$v_district',Vendor_pin='$v_pin' where Vendor_id='$upid'";
    update($q);
    return redirect('staff_vendor.php');
}
?>

 <div class="banner-info text-left">
							<font color=red>
								<h1 style="margin-top: -2em">Add vendor</h1><br>
							<form method="post" style="width: 500px;">

								<?php if (isset($_GET['upid'])) { ?>

								Vendor Name : <input type="text" name="v_name" required maxlength="20" value="<?php echo $res[0]['Vendor_name']?>" class="form-control"><br><br>
								Vendor Godown Number : <input type="text" name="v_gno" required maxlength="20" value="<?php echo $res[0]['Vendor_gno']?>" class="form-control"><br><br>
								Phone number: <input type="text" required name="v_phno" pattern=[0-9]{10} value="<?php echo $res[0]['Vendor_phone']?>" class="form-control"><br><br>
								City : <input type="text" name="v_city" required maxlength="20" value="<?php echo $res[0]['Vendor_city']?>" class="form-control"><br><br>
								District : <select name="v_district" required value="<?php echo $res[0]['Vendor_dist']?>" class="form-control">
									<option>Ernakulam</option>
									<option>Thrissur</option>
									<option>Kottayam</option>
									<option>Trivandrum</option>
									</select>
									<br><br>
								Pincode : <input type="text" name="v_pin" required pattern=[0-9]{6} value="<?php echo $res[0]['Vendor_pin']?>" class="form-control"><br><br>
								<input type="submit" name="update" value="Update" class="btn btn-danger">

								<?php }else{ ?>

								Vendor Name : <input type="text" name="v_name" required maxlength="20" class="form-control"><br><br>
								Vendor Godown Number : <input type="text" name="v_gno" required maxlength="20" class="form-control"><br><br>
								Phone number: <input type="text" required name="v_phno" pattern=[0-9]{10} class="form-control"><br><br>
								City : <input type="text" name="v_city" required maxlength="20" class="form-control"><br><br>
								District : <select name="v_district" class="form-control">
									<option>Ernakulam</option>
									<option>Thrissur</option>
									<option>Kottayam</option>
									<option>Trivandrum</option>
									</select>
									<br><br>
								Pincode : <input type="text" name="v_pin" required pattern=[0-9]{6} class="form-control"><br><br>
								<input type="submit" name="v_submit" value="Add vendor" class="btn btn-danger">
								<?php } ?>
							</form>
							</font>
						</div>
						<br><br>
	<center>
	<h1 style="color: #fff">Vendor Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Vendor Name</th>
			<th>Vendor Godown No.</th>
			<th>Phone number</th>
			<th>City</th>
			<th>District</th>
			<th>Pincode</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
		<?php 
			$q="SELECT * FROM tbl_vendor";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0)	{
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Vendor_name']; ?></td>
						<td><?php echo $row['Vendor_gno']; ?></td>
						<td><?php echo $row['Vendor_phone']; ?></td>
						<td><?php echo $row['Vendor_city']; ?></td>
						<td><?php echo $row['Vendor_dist']; ?></td>
						<td><?php echo $row['Vendor_pin']; ?></td>

					<?php if($row['Vendor_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Vendor_id'] ?>">Deactivate</a></td>
                	<?php } 
                 		else if($row['Vendor_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Vendor_id'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Vendor_id'] ?>">Update</a></td>
        				</tr>
        				<?php 
                        }
                           }?>					
        </table>
</center>
<?php 
include 'footer.php';
?>