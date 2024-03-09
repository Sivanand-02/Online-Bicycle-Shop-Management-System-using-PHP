<?php
include 'staff_header.php'
?>
<?php
if(isset($_POST['subcat_submit'])){
	extract($_POST);
	$q1="SELECT * FROM tbl_subcategory where Subcat_name='$subcat_name' or Subcat_desc='$subcat_desc'";
	$res=select($q1);
	if(sizeof($res)>0)
	{
		alert("Subcategory already added !");
		return redirect("staff_manage_subcat.php");
	}
	 $q="INSERT INTO tbl_subcategory VALUES(NULL,'$subcat_name','$subcat_desc','1')";
		insert($q);
	}
if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_subcategory set Subcat_status='0' where Subcat_id='$did'";
	update($q);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_subcategory set Subcat_status='1' where Subcat_id='$uid'";
	update($q);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_subcategory where Subcat_id='$upid'";
    $res=select($q);

        
}

if (isset($_POST['update'])) {
    extract($_POST);

    $q="update tbl_subcategory set Subcat_name='$subcat_name',Subcat_desc='$subcat_desc' where Subcat_id=$upid;";
    update($q);
   	return redirect('staff_manage_subcat.php');
}
?>
<div class="banner-info text-left">
							<font color=red>
								<?php if (isset($_GET['upid'])) { ?>

								<h1 style="margin-top: -2em">Edit Subcategory</h1><br>
							<form method="post" style="width: 500px;">
								Subcategory Name : <input type="text" name="subcat_name" maxlength="20" value="<?php echo $res[0]['Subcat_name']?>" class="form-control"><br><br>
								Subcategory Description : <input type="textarea" name="subcat_desc" maxlength="50" value="<?php echo $res[0]['Subcat_desc']?>" class="form-control"><br><br>
								<input type="submit" name="update" value="Update" class="btn btn-danger">

								<?php }else{ ?>

							<h1 style="margin-top: -2em">Add Subcategory</h1><br>
							<form method="post" style="width: 500px;">
								Subcategory Name : <input type="text" name="subcat_name" maxlength="20" class="form-control"><br><br>
								Subcategory Description : <input type="textarea" name="subcat_desc" maxlength="50"class="form-control"><br><br>
								<input type="submit" name="subcat_submit" value="Add subcategory" class="btn btn-danger">
								<?php } ?>
							</form>
							</font>
</div>

<center><br><br>
	<h1 style="color: #fff">Subcategory Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Description</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>

		<?php 
			$q="SELECT * FROM `tbl_subcategory`";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Subcat_name']; ?></td>
						<td><?php echo $row['Subcat_desc']; ?></td>
						<?php if($row['Subcat_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Subcat_id'] ?>">Deactivate</a></td>
                	<?php } 
                 		else if($row['Subcat_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Subcat_id'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Subcat_id'] ?>">Update</a></td>
        				</tr>
        			<?php 
                        }
                           }?>
					

		 ?>
	</table>
</center>

<?php
include 'footer.php'
?>