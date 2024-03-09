<?php 
include 'staff_header.php';
include 'random_functions.php';
 ?>
<center><br><br>
	<form method="post" style="width: 300px">
 <h2 style="color: white;">Search Sales</h2>
 <br>


  
       <font color="red">Date : <input type="date" name="daily" class="form-control" /> 
       <br>
     	Month : <input type="month" name="monthly" class="form-control" />
        <br><br></font>
         <input type="submit" name="sale" value="Submit" class="btn btn-danger"><br><br>
    
  </form>
	<h1 style="color: #fff">Sales Details</h1><br>
	<table class="table" style="width: 1500px;color: black;background: white;opacity: 0.85;">
		<tr>
			<th>Sl no.</th>
			<th>Name</th>
			<th>Item</th>
			<th>Date</th>
			<th>Unit Price</th>
		</tr>

		<?php 

         if (isset($_POST['sale'])) {
           extract($_POST);
           if ($daily!="") {

           $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id)  where Order_date='$daily' and Cart_status='Paid' ";
           //$re=select($q);
           }
            else if ($monthly!="") {

            
			 $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id)  where Order_date like '$monthly%' and Cart_status='Paid' ";
             //$re=select($q);

             }
           }else{
             $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id) where Cart_status='Paid' ";
             //$re=select($q);
            } ?>


		<?php 
			// $q="SELECT * FROM tbl_order INNER JOIN tbl_cart_master USING(Cart_master_id) INNER JOIN tbl_cart_child USING(Cart_master_id)  INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_customer USING(Cust_id)";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0){
				$i=1;
				foreach ($re as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Cust_fname']; echo " "; echo $row['Cust_lname']; ?></td>
						<td><?php echo $row['Item_name'] ?></td>
						<td><?php echo $row['Order_date']; ?></td>
						<td><?php echo getOldProductPrice($row['Item_id'],$row['Order_id']); ?></td>
        				</tr>
        			<?php 
                        }
                           }?>
	</table>
	<h2><a class="btn btn-danger" href="sales_report.php"><b>Print Report</b></a></h2>
      <br>
</center>
<?php
include 'footer.php';
?>