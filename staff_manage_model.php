<?php
include 'staff_header.php'
?>
<?php
if(isset($_POST['model_submit'])){
	extract($_POST);
	$q1="SELECT * FROM tbl_model where Model_name='$model_name' or Model_desc='$model_desc'";
	$res=select($q1);
	if(sizeof($res)>0)
	{
		alert("Model already added !");
		return redirect("staff_manage_model.php");
	}
	 $q="INSERT INTO tbl_model VALUES(NULL,'$model_name','$model_desc','1')";
		insert($q);
	}
if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_model set Model_status='0' where Model_id='$did'";
	update($q);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_model set Model_status='1' where Model_id='$uid'";
	update($q);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_model where Model_id='$upid'";
    $res=select($q);
}
if (isset($_POST['update'])) {
    extract($_POST);

    $q="update tbl_model set Model_name='$model_name',Model_desc='$model_desc' where Model_id=$upid;";
    update($q);
   	return redirect('staff_manage_model.php');
}
?>
<div class="banner-info text-left">
							<font color=red>
								<?php if (isset($_GET['upid'])) { ?>
								<h1 style="margin-top: -2em">Edit Model</h1><br>
								<form method="post" style="width: 500px;">
								Model name: <input type="text" name="model_name" maxlength="50" value="<?php echo $res[0]['Model_name'] ?>" class="form-control"><br><br>
								Model Description : <input type="textarea" name="model_desc" maxlength="100" value="<?php echo $res[0]['Model_desc'] ?>" class="form-control"><br><br>
								<input type="submit" name="model_submit" value="Add Model" class="btn btn-danger">
							</form>
								<?php }else{ ?>

								<h1 style="margin-top: -2em">Add Model</h1><br>
								<form method="post" style="width: 500px;">
								Model name: <input type="text" name="model_name" maxlength="50" class="form-control"><br><br>
								Model Description : <input type="textarea" maxlength="100" name="model_desc" class="form-control"><br><br>
								<input type="submit" name="model_submit" value="Add Model" class="btn btn-danger">
							</form>
							<?php } ?>
							</font>
</div>

<center><br><br>
	<h1 style="color: #fff">Model Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Description</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>

		<?php 
			 $q="SELECT * FROM `tbl_model`";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Model_name']; ?></td>
						<td><?php echo $row['Model_desc']; ?></td>
					<?php if($row['Model_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Model_id'] ?>">Deactivate</a></td>
                	<?php } 
                 		else if($row['Model_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Model_id'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Model_id'] ?>">Update</a></td>
        				</tr>
        			<?php 
                        }
                           }?>
	</table>
</center>

<?php
include 'footer.php'
?>