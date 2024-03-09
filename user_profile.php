<?php 
include 'user_header.php';

$cusid=$_SESSION['Cust_id'];
extract($_GET);

  $q="select * from tbl_customer where Cust_id='$cusid'";
  $res=select($q);

if (isset($_POST['update'])) {
    extract($_POST);

    echo $q="update tbl_customer set Cust_fname='$fname',Cust_lname='$lname',Cust_phone='$phno',Cust_street='$C_street',Cust_dist='$District',Cust_pin='$pincode',Cust_city='$city' where Cust_id='$cusid' ";
    update($q);
    return redirect('user_home.php');
}

?>

<div class="banner-info text-left" >
	<font color="red">
	<h1 style="margin-top: -2em;">My Profile</h1><br>

	<form method="post" style="width: 500px;">
		
			First Name : <input type="text" required="" name="fname" value="<?php echo $res[0]['Cust_fname'] ?>" maxlength="20" class="form-control"><br>

			Last Name
			<input type="text" required="" value="<?php echo $res[0]['Cust_lname'] ?>" name="lname" maxlength="20" class="form-control" ><br>

            Phone number
            <input type="number" value="<?php echo $res[0]['Cust_phone'] ?>" required="" name="phno" class="form-control" ><br>

			City
			<input type="text" required="" name="city" value="<?php echo $res[0]['Cust_city'] ?>" class="form-control" ><br>

            Street Name
            <input type="text" value="<?php echo $res[0]['Cust_street'] ?>" required="" name="C_street" class="form-control" ><br>
        
			District
			<select name="District" id="district" class="form-control" >
				<option value="Select">Select Option</option>
				<option value="Ernakulam">Ernakulam</option>
                <option value="TVM">Trivandrum</option>
                <option value="TCR">Thrissur</option>
                <option value="Alappuzha">Alappuzha</option>
                <option value="Kasaragod">Kasaragod</option>
                <option value="Kozhikode">Kozhikode</option>
                <option value="Kannur">Kannur</option>
                <option value="Wayanad">Wayanad</option>
                <option value="Palakkad">Palakkad</option>
                <option value="Idukki">Idukki</option>
                <option value="Kottayam">Kottayam</option>
                <option value="Pathanamthitta">Pathanamthitta</option>
                <option value="Malappuram">Malappuram</option>
                <option value="Kollam">Kollam</option>
			</select><br>

			Pin Code
			<input type="number" pattern=[0-9]{6} required="" value="<?php echo $res[0]['Cust_pin'] ?>" name="pincode" class="form-control" ><br>
		
			<td colspan="2"><center><input type="submit" name="update" value="Update" class="btn btn-success"></center>
			
		
	
</form>
</font>
</div
<?php 
include 'footer.php' 
?>