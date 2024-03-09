
<?php 
include 'public_header.php';
 ?>
<?php
if(isset($_POST['c_submit'])){
	extract($_POST);
	$q="SELECT * FROM tbl_customer WHERE Username='$c_email'";
	$res=select($q);
	if(sizeof($res)>0)
	{
		alert("User Already exists");
		return redirect("customer_register.php");
	}
	$q1="INSERT INTO tbl_login VALUES('$c_email','$c_password','customer','1')";
	insert($q1);
	$q2="INSERT INTO tbl_customer VALUES(NULL,'$c_email','$c_fname','$c_lname','$c_city','$c_District','$c_pin','$c_street','$c_phno','$c_dob','$c_gender','1')";
	insert($q2);
	return redirect('index.php');
	}

?>
		<div class="banner-info text-left">
							<font color=red>
								<h1 style="margin-top: -2em">Sign up</h1><br>
							<form method="post" style="width: 500px;">
								First Name : <input type="text" name="c_fname" required maxlength="20" class="form-control" required=""><br><br>
								Last Name : <input type="text" name="c_lname" required maxlength="20" class="form-control"><br><br>
								Gender : <br><br><div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input type="radio" name="c_gender" style="width:12px" value="Male" class="form-control">Male</div><br><div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input type="radio" name="c_gender" style="width:12px" value="Female" class="form-control" required="">Female,</div><br><div style="display: flex; flex-direction: row-reverse; justify-content: space-between; width: 50%"><input type="radio" name="c_gender" style="width:12px" value="Others" class="form-control">Others</div><br><br>
								Phone number: <input type="text" name="c_phno" pattern=[0-9]{10} class="form-control" required=""><br><br>
								Date of birth : <input type="date" name="c_dob" class="form-control" required="" ><br><br>
								Email : <input type="email" name="c_email" maxlength="30" class="form-control" required="" ><br><br>
								Password : <input type="Password" name="c_password" maxlength="20" class="form-control"required=""><br><br>
								City : <input type="text" name="c_city" maxlength="20" class="form-control" required=""><br><br>
								Street : <input type="text" name="c_street" required maxlenth="20" class="form-control"><br><br>
								District : <select name="c_District" class="form-control" required="">
									<option>Ernakulam</option>
									<option>Thrissur</option>
									<option>Kottayam</option>
									<option>Trivandrum</option>
									</select>
									<br><br>

								Pincode : <input type="text" name="c_pin" pattern=[0-9]{6} class="form-control"><br><br>
								<input type="submit" name="c_submit" value="Sign up" class="btn btn-danger">

							</form>
							</font>
						</div>
<?php 
include 'footer.php';
 ?>