<?php 
include 'admin_header.php';
 
if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_customer set Cust_status='0' where Username='$did'";
$q2="update tbl_login set login_status='0',login_type='Inactive' where Username='$did'";
	update($q);
	update($q2);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_customer set Cust_status='1' where Username='$uid'";
$q2="update tbl_login set login_status='1',login_type='customer' where Username='$uid'";
	update($q);
	update($q2);
}

?>	
<br><br>
	<div style="margin-left: 50px;">
	<form method="post" style="width: 300px;">
    <h2 style="color: white;">Search Customer</h2>
            <br>
            <input type="text"  class="form-control" required="" name="srcust"></td>
        <br>
  
          <input type="submit" class="btn btn-danger" name="searchcust" value="Search"></td>
    </form>
    </div>
<center>
    <br><br><br>
	<h1 style="color: #fff;">Customer Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Customer First Name</th>
			<th>Customer Last Name</th>
			<th>Customer City</th>
			<th>Customer District</th>
			<th>Customer Pincode</th>
			<th>Customer Street</th>
			<th>Customer Phone No.</th>
			<th>Customer Date of Birth</th>
			<th>Customer Gender</th>
			<th>View Purchase Details</th>
			<th>Status</th>
		</tr>
		<?php 
		if (isset($_POST['searchcust'])) {
                extract($_POST);
                 $q="select * from tbl_customer inner join tbl_login using(Username) where Cust_fname like '$srcust%' ";
            
            }
            else
            {

            $q="SELECT * FROM `tbl_customer`  inner join tbl_login using (Username) ";
             }
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0)	{
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Cust_fname']; ?></td>
						<td><?php echo $row['Cust_lname']; ?></td>
						<td><?php echo $row['Cust_city']; ?></td>
						<td><?php echo $row['Cust_dist']; ?></td>
						<td><?php echo $row['Cust_pin']; ?></td>
						<td><?php echo $row['Cust_street']; ?></td>
						<td><?php echo $row['Cust_phone']; ?></td>
						<td><?php echo $row['Cust_dob']; ?></td>
						<td><?php echo $row['Cust_gender']; ?></td>
						<td><a  class="btn btn-success"  href="view_single_cust.php?custid=<?php echo $row['Cust_id'] ?>&custname=<?php echo $row['Cust_fname'];?>">Purchase Details</a></td>
					
                       <?php if($row['Cust_status']=='1') { ?>
                    <td><a href="?did=<?php echo $row['Username'] ?>" class="btn btn-danger">Deactivate</a></td>
                <?php } 
                 else if($row['Cust_status']=='0') { ?>
                <td><a  class="btn btn-success"  href="?uid=<?php echo $row['Username'] ?>">Activate</a></td>
                <?php } ?>
                    </tr>
               <?php   } ?>

            <?php   }
            
         ?>				
        </table>
        <a class="btn btn-danger" href="user_report.php"><b>Print Report</b></a>
</center>

 <?php
 include 'footer.php';
 ?>