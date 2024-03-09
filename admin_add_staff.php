<?php 
include 'admin_header.php';

if(isset($_POST['s_submit'])){
	extract($_POST);
	$q1="INSERT INTO tbl_login VALUES('$s_email','$s_password','staff',1)";
	insert($q1);
}

if(isset($_POST['s_submit'])){
	extract($_POST);
	$q2="INSERT INTO tbl_staff VALUES(NULL,'$s_email','$s_fname','$s_lname','$s_city','$s_District','$s_pincode','$s_street','$s_phno','$s_gender','$s_dob',curdate(),'1')";
	insert($q2);
}
if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_staff set Staff_status='0' where Username='$did'";
	update($q);
$q2="update tbl_login set login_status='0' where Username='$did'";
	update($q2);
$q1="update tbl_login set login_type='Inactive' where Username='$did'";
	update($q1);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_staff set Staff_status='1' where Username='$uid'";
	update($q);
$q2="update tbl_login set 	='1' where Username='$uid'";
	update($q2);
$q1="update tbl_login set login_type='staff' where Username='$uid'";
	update($q1);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_staff where Staff_id='$upid'";
    $res=select($q);   
}

if (isset($_POST['update'])) {
    extract($_POST);

    $q="update tbl_staff set Staff_fname='$s_fname',Staff_lname='$s_lname',Staff_phone='$s_phno',Staff_dob='$s_dob',Staff_dist='$s_District',Staff_city='$s_city',Staff_pin='$s_pincode',Staff_street='$s_street' where Staff_id='$upid'";
    update($q);
    return redirect('admin_add_staff.php');
}

?>



<div class="banner-info text-left">
							<font color=red>
								<?php if (isset($_GET['upid'])) { ?>

								<h1 style="margin-top: -2em">Edit Staff</h1><br>
							<form method="post" style="width: 500px;">

 								First Name : <input type="text" name="s_fname" required maxlenth="15" value="<?php echo $res[0]['Staff_fname']?>" class="form-control"><br><br>
								Last Name : <input type="text" name="s_lname" required maxlenth="15" value="<?php echo $res[0]['Staff_lname']?>" class="form-control"><br><br>
								Phone number: <input type="text" name="s_phno" required pattern=[0-9]{10} value="<?php echo $res[0]['Staff_phone']?>" class="form-control"><br><br>
								Date of birth : <input type="date" name="s_dob" required value="<?php echo $res[0]['Staff_dob']?>" class="form-control"><br><br>
								District : <select name="s_District" required value="<?php echo $res[0]['Staff_dist'] ?>" class="form-control">
									<option>Ernakulam</option>
									<option>Thrissur</option>
									<option>Kottayam</option>
									<option>Trivandrum</option>
									</select>
									<br><br>
								City : <input type="text" name="s_city" required maxlength="20" value="<?php echo $res[0]['Staff_city']?>"class="form-control"><br><br>
								Pincode : <input type="text" name="s_pincode" required pattern=[0-9]{6} value="<?php echo $res[0]['Staff_pin']?>" class="form-control"><br><br>
								Street : <input type="text" name="s_street" required maxlength="20" value="<?php echo $res[0]['Staff_street'] ?>" class="form-control"><br><br>

								<input type="submit" name="update" value="Update" class="btn btn-danger">

                                <?php }else{ ?>

								<h1 style="margin-top: -2em">Add Staff</h1><br>
								<form method="post" style="width: 500px;">                                
                                First Name : <input type="text" name="s_fname" required maxlenth="15" class="form-control"><br><br>
								Last Name : <input type="text" name="s_lname" required maxlenth="15" class="form-control"><br><br>
								Gender : <br><br><div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input type="radio" name="s_gender" style="width:12px" value="Male" class="form-control">Male</div><br><div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input style="width:12px" type="radio" name="s_gender" value="Female" class="form-control">Female</div><br>
								<div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input style="width:12px" type="radio" name="s_gender" value="Others" class="form-control">Others</div>	<br><br>
								Phone number: <input type="text" name="s_phno" required pattern=[0-9]{10} class="form-control"><br><br>
								Email : <input type="email" name="s_email" required maxlength="40" class="form-control"><br><br>
								Password : <input type="password" name="s_password" required maxlength="20" class="form-control"><br><br>
								Date of birth : <input type="date" name="s_dob" required class="form-control"><br><br>
								District : <select name="s_District" class="form-control">
									<option>Ernakulam</option>
									<option>Thrissur</option>
									<option>Kottayam</option>
									<option>Trivandrum</option>
									</select>
									<br><br>
								City : <input type="text" name="s_city" required maxlenth="20" class="form-control"><br><br>
								Street : <input type="text" name="s_street" required maxlenth="20" class="form-control"><br><br>
								Pincode : <input type="text" name="s_pincode" required pattern=[0-9]{6} maxlength="6" class="form-control"><br><br>

								<input type="submit" name="s_submit" value="Add staff" class="btn btn-danger">
											
								<?php } ?>
							</form>
							</font>
</div>
<br><br>
<center>
	<h1 style="color: #fff">Staff Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Phone number</th>
			<th>Gender</th>
			<th>Join date</th>
			<th>Date of Birth</th>
			<th>District</th>
			<th>City</th>
			<th>Street</th>
			<th>Pincode</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
		<?php 
			$q="SELECT * FROM tbl_staff inner join tbl_login using(Username)";
			$re=select($q);
			if(sizeof($re)>0)	{
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Staff_fname']; ?></td>
						<td><?php echo $row['Staff_lname']; ?></td>
						<td><?php echo $row['Staff_phone']; ?></td>
						<td><?php echo $row['Staff_gender']; ?></td>
						<td><?php echo $row['Staff_join']; ?></td>
						<td><?php echo $row['Staff_dob']; ?></td>
						<td><?php echo $row['Staff_dist']; ?></td>
						<td><?php echo $row['Staff_city']; ?></td>
						<td><?php echo $row['Staff_street']; ?></td>
						<td><?php echo $row['Staff_pin']; ?></td>

<?php if($row['Staff_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Username'] ?>">Deactivate</a></td>
                	<?php } 
                 		else if($row['Staff_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Username'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Staff_id'] ?>">Update</a></td>
        				</tr>
        				<?php 
                        }
                           }?>		
        						
					
        </table>
</center>
<?php 
include 'admin_footer.php';
?>