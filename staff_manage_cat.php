<?php
include 'staff_header.php';
?>
<?php
if(isset($_POST['cat_submit'])){
	extract($_POST);
	$q1="SELECT * FROM tbl_category where Cat_name='$cat_name' or Cat_desc='$cat_desc'";
	$res=select($q1);
	if(sizeof($res)>0)
	{
		alert("Category already added !");
		return redirect("staff_manage_cat.php");
	}
	echo $q="INSERT INTO tbl_category VALUES(NULL,'$cat_name','$cat_desc','1')";
		insert($q);
		return redirect("staff_manage_cat.php");
	}

if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_category set Cat_status='0' where Cat_id='$did'";
	update($q);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_category set Cat_status='1' where Cat_id='$uid'";
	update($q);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_category where Cat_id='$upid'";
    $res=select($q);

        
}

if (isset($_POST['update'])) {
    extract($_POST);

    $q="update tbl_category set Cat_name='$cat_name',Cat_desc='$cat_desc' where Cat_id=$upid;";
    update($q);
   	return redirect('staff_manage_cat.php');
}
?>
	
	<div class="banner-info text-left">
							<font color=red>
								<?php if (isset($_GET['upid'])) { ?>

								<h1 style="margin-top: -2em">Edit Category</h1><br>
							<form method="post" style="width: 500px;">
								Category Name : <input type="text" name="cat_name" maxlength="20" value="<?php echo $res[0]['Cat_name']?>" class="form-control"><br><br>
								Category Description : <input type="text" name="cat_desc" maxlength="50" value="<?php echo $res[0]['Cat_desc']?>" class="form-control"><br><br>
								<input type="submit" name="update" value="Update" class="btn btn-danger">
							</form>

								<?php }else{ ?>

							<h1 style="margin-top: -2em">Add Category</h1><br>
							<form method="post" style="width: 500px;">
								Category Name : <input type="text" name="cat_name" maxlength="20" class="form-control"><br><br>
								Category Description : <input type="text" name="cat_desc" maxlength="50" class="form-control"><br><br>
								<input type="submit" name="cat_submit" value="Add category" class="btn btn-danger">
								<?php } ?>
							</form>
							</font>
</div>

<center><br><br>
	<h1 style="color: #fff">Category Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Description</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>

		<?php 
			$q="SELECT * FROM `tbl_category`";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Cat_name']; ?></td>
						<td><?php echo $row['Cat_desc']; ?></td>
						<?php if($row['Cat_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Cat_id'] ?>">Deactivate</a></td>
                	<?php } 
                 		else if($row['Cat_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Cat_id'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Cat_id'] ?>">Update</a></td>
        				</tr>
        			<?php 
                        }
                           }?>
	</table>
</center>

<?php
include 'footer.php'
?>