<?php
include 'staff_header.php';
include 'random_functions.php';
extract($_GET);
if(isset($_POST['add_item'])){
	extract($_POST);

	echo $q1="SELECT * FROM tbl_item where Cat_id='$cat_id' and Subcat_id='$subcat_id' and Model_id='$model_id' and Item_name='$item_name' and Item_color='$item_color' and Item_desc='$item_desc' and Gear_type='$item_gear_type' and Handlebar_type='$item_handlebar_type' and Brake_type='$item_brake_type' and Suspension_type='$item_suspension_type'";
	$q2=select($q1); 
	if (sizeof($q2)>0) {
  alert('Item already added !');
  //return redirect("staff_manage_item.php");
}

	$dir = "images/";
	$file = basename($_FILES['Item_image']['name']);
	$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	$target = $dir.uniqid("image_").".".$file_type;
	if(move_uploaded_file($_FILES['Item_image']['tmp_name'], $target))
	{

	echo $q="INSERT INTO tbl_item VALUES(NULL,'$cat_id','$subcat_id','$model_id','$item_name','$item_color','0','$item_desc','0','$target','1','$item_gear_type','$item_suspension_type','$item_brake_type','$item_handlebar_type')";
	insert($q);
	return redirect("staff_manage_item.php");
	}
		else
		{
			echo "file uploading error occured";
		}
}
if (isset($_GET['did'])) {
	extract($_GET);
$q="update tbl_item set Item_status='0' where Item_id='$did'";
	update($q);
}

if (isset($_GET['uid'])) {
	extract($_GET);
$q="update tbl_item set Item_status='1' where Item_id='$uid'";
	update($q);
}

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_item inner join tbl_category using (Cat_id) inner join tbl_subcategory using (Subcat_id) inner join tbl_model using (Model_id) where Item_id='$upid'";
    $res1=select($q);       
}

if (isset($_POST['update_item'])) {
	extract($_POST);
	$dir = "images/";
$file = basename($_FILES['Item_image']['name']);
$file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$target = $dir.uniqid("image_").".".$file_type;
if(move_uploaded_file($_FILES['Item_image']['tmp_name'], $target))
{
	
	 $q="UPDATE `tbl_item` SET `Cat_id`='$cat_id',`Subcat_id`='$subcat_id',`Model_id`='$model_id',`Item_name`='$item_name',`Item_desc`='$item_desc',`Item_image`='$target',Item_color='$item_color',Gear_type='$item_gear_type',Suspension_type='$item_suspension_type',Brake_type='$item_brake_type',Handlebar_type='$item_handlebar_type' WHERE `Item_id`='$upid'";
	update($q);
	return redirect('staff_manage_item.php');
}
else
{
	echo "file uploading error occured";
}

return redirect('staff_manage_item.php');
}
?>
<div class="banner-info text-left">	
							<font color=red>
								<?php if (isset($_GET['upid'])) { ?>

								<h1 style="margin-top: -2em">Edit Item</h1><br>
							<form method="post" style="width: 500px;" enctype="multipart/form-data">
								Item Name : <input type="text" name="item_name" maxlength="50" value="<?php echo $res1[0]['Item_name'] ?>"class="form-control"><br><br>
								Category : <select name="cat_id" class="form-control">



                                    <option value="<?php echo $res1[0]['Cat_id'] ?>"><?php echo $res1[0]['Cat_name'] ?></option>
									<?php 

                                    $q="select * from tbl_category where Cat_status='1'" ;
                                    $res=select($q);
                                    foreach ($res as $key) {?>
                                    	<option value="<?php echo $key['Cat_id'] ?>"><?php echo $key['Cat_name'] ?></option>
                                  <?php  }


									 ?>
								</select>
								<br><br>
									
								Subcategory :<select name="subcat_id" class="form-control">
									<option value="<?php echo $res1[0]['Subcat_id'] ?>"><?php echo $res1[0]['Subcat_name'] ?></option>


									<option>Select</option>
									<?php 

                                    $q="select * from tbl_subcategory";
                                    $res=select($q);
                                    foreach ($res as $key) {?>
                                    	<option value="<?php echo $key['Subcat_id'] ?>"><?php echo $key['Subcat_name'] ?></option>
                                  <?php  }


									 ?>
								</select>
								<br><br>								
								Model : <select name="model_id" class="form-control">
									<option value="<?php echo $res1[0]['Model_id'] ?>"><?php echo $res1[0]['Model_name'] ?></option>


									<option>Select</option>
									<?php 

                                    $q="select * from tbl_model";
                                    $res=select($q);
                                    foreach ($res as $key) {?>
                                    	<option value="<?php echo $key['Model_id'] ?>"><?php echo $key['Model_name'] ?></option>
                                  <?php  }


									 ?>
								</select>
								<br><br>
								Color : <input type="text" name="item_color" class="form-control" maxlength="10" value="<?php echo $res1[0]['Item_color']?>"><br><br>
								<!-- Item Stock : <input type="text" name="item_stock" class="form-control" value="<?php //echo $res1[0]['Item_stock']?>"><br><br> -->
								Item Image : <input type="file" name="Item_image" class="form-control" value="<?php echo $res1[0]['Item_image']?>"><br><br>
								Item Description : <input type="textarea" name="item_desc" maxlength="500" class="form-control" value="<?php echo $res1[0]['Item_desc']?>"><br><br>
								Gear type : <input type="text" name="item_gear_type" class="form-control" maxlength="10" value="<?php echo $res1[0]['Gear_type']?>"><br><br>
								Suspension type : <input type="text" name="item_suspension_type" maxlength="20" class="form-control" value="<?php echo $res1[0]['Suspension_type']?>"><br><br>
								Brake type : <input type="text" name="item_brake_type" class="form-control" maxlength="10" value="<?php echo $res1[0]['Brake_type']?>"><br><br>
								Handlebar type : <input type="text" name="item_handlebar_type" maxlength="10" class="form-control" value="<?php echo $res1[0]['Handlebar_type']?>">
								<br><br>
								<input type="submit" name="update_item" value="Update Item" class="btn btn-danger">
							</form>

								<?php }else{ ?>

								<h1 style="margin-top: -2em">Manage item</h1><br>
							<form method="post" style="width: 500px;" enctype="multipart/form-data">
								Item Name : <input type="text" name="item_name" maxlength="50"class="form-control"><br><br>
								Category ID : <select name="cat_id" class="form-control">
									<option>Select</option>
									<?php 
										$q1="SELECT * FROM `tbl_category` where Cat_status='1'";
										$rd=select($q1);
										if(sizeof($rd)>0){
											foreach ($rd as $row) { ?>
												<option value="<?php echo $row['Cat_id']; ?>"><?php echo $row['Cat_name']; ?></option>
										<?php	}
										}
									 ?>
								</select><br><br>
								Subcategory ID :<select name="subcat_id" class="form-control">
									<option>Select</option>
									<?php 
										$q1="SELECT * FROM `tbl_subcategory` where Subcat_status='1'";
										$rd=select($q1);
										if(sizeof($rd)>0){
											foreach ($rd as $row) { ?>
												<option value="<?php echo $row['Subcat_id']; ?>"><?php echo $row['Subcat_name']; ?></option>
										<?php	}
										}
									 ?>
								</select><br><br>								
								Model ID : <select name="model_id" class="form-control">
									<option>Select</option>
									<?php 
										$q1="SELECT * FROM `tbl_model` where Model_status='1'";
										$rd=select($q1);
										if(sizeof($rd)>0){
											foreach ($rd as $row) { ?>
												<option value="<?php echo $row['Model_id']; ?>"><?php echo $row['Model_name']; ?></option>
										<?php	}
										}
									 ?>
								</select><br><br>
								Color : <input type="text" name="item_color" maxlength="10" class="form-control"><br><br>
<!-- 								Item Stock : <input type="text" name="item_stock" class="form-control"><br><br>
 -->							Item Image : <input type="file" name="Item_image" class="form-control"><br><br>
								Item Description : <input type="textarea" name="item_desc" maxlength="500" class="form-control"><br><br>
								Gear type : <input type="text" name="item_gear_type" class="form-control"><br><br>
								Suspension type : <input type="text" name="item_suspension_type" maxlength="20" class="form-control"><br><br>
								Brake type : <input type="text" name="item_brake_type" maxlength="10" class="form-control"><br><br>
								Handlebar type : <input type="text" name="item_handlebar_type" maxlength="10" class="form-control">
								<br><br>
								<input type="submit" name="add_item" value="Add Item" class="btn btn-danger">
								<?php } ?>
							</form>
							</font>
</div>
<br><br>
<center>
	<h1 style="color: #fff">Item Details</h1><br>	
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Price</th>
			<th>Item Stock</th>
			<th>Item Image</th>
			<th>Item Description</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>

		<?php 
			$q="SELECT * FROM `tbl_item`";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) {
					
					// var_dump($row["Item_id"]);
					?>
					
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Item_name']; ?></td>
						<td><?php echo getProductPrice($row['Item_id']) ? getProductPrice($row['Item_id']) : 0 ?></td>
						<td><?php  echo getProductStock($row['Item_id']) ?></td>
						<td><img src="<?php echo $row['Item_image']?>" style="height:200px;width:210px;"></td>
						<td><?php echo $row['Item_desc']; ?></td>
						<?php if($row['Item_status']=='1') { ?>
                		<td><a class="btn btn-danger" href="?did=<?php echo $row['Item_id'] ?>">Deactivate</a></td>
                		<?php } 
                 		else if($row['Item_status']=='0') { ?>
        				<td><a  class="btn btn-success"  href="?uid=<?php echo $row['Item_id'] ?>">Activate</a></td>
        				<?php 
                           }?>	
                       	<td><a  class="btn btn-success"  href="?upid=<?php echo $row['Item_id'] ?>">Update</a></td>
					</tr>
					
			<?php	}
			}
		 ?>
	</table>
</center>

<?php
include 'footer.php'
?>
