<?php 
include 'admin_header.php';
extract($_GET);
 ?>
 <form method="post" style="width: 300px">
 <h2 style="color: white;"><i>SEARCH SALES</i></h2>
 <br>
       <input type="date" name="daily" class="form-control" /> Date 
       <br><br>
     <input type="month" name="monthly" class="form-control" /> Month
        <br><br>
         <input type="submit" name="sale" value="Submit" class="btn btn-danger">
     </form>
<center><br><br>
	<h1 style="color: #fff">Sales Details</h1><br>
	<table class="table" style="width: 1300px;color: black;background: white;opacity: 0.85;">
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

           $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id)  where Order_date='$daily' and Cart_master_status='Paid' ";
           }
            else if ($monthly!="") {

            
             $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id)  where Order_date like '$monthly%' and Cart_master_status='Paid' ";

             }
           }
             else{
             $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING(`Cust_id`) INNER JOIN `tbl_item` USING (Item_id) where Cart_master_status='Paid' ";
            }

                $res=select($q);
                // $_SESSION['res']=$res;
                // $r=$_SESSION['res'];
			// print_r($re);
				$i=1;
				foreach ($res as $row) { ?>

					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row['Cust_fname']; echo " "; echo $row['Cust_lname']; ?></td>
						<td><?php echo $row['Item_name'] ?></td>
						<td><?php echo $row['Order_date']; ?></td>
						<td><?php echo $row['Sell_price']; ?></td>
        				</tr>
        			<?php 
                        }
                           ?>
	</table>
	<h2><a class="btn btn-get-started" href="sales_report.php"><b>Print Report</b></a></h2>
      <br>
</center>
<?php
include 'footer.php';
?>