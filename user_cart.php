<?php 
include 'user_header.php';
include 'random_functions.php';
$cid=$_SESSION['Cust_id'];

if(isset($_GET['remove_item'])){  
  extract($_GET);
  $Cart_qty=$Cart_qty;
  $Sell_price=$Sell_price;
  $tot=$Cart_qty*$Sell_price;
  $q1="UPDATE `tbl_cart_master` SET `Cart_tot_amt`=`Cart_tot_amt`-'$tot' WHERE `Cart_master_id`='$remove_item'";
  update($q1);
  $q2="DELETE FROM `tbl_cart_child` WHERE `Cart_master_id`='$remove_item' AND `Item_id`='$Item_id'";
  delete($q2);
  $q3="SELECT * FROM `tbl_cart_master` WHERE `Cart_master_id`='$remove_item' AND `Cart_tot_amt`='0'";
  $rd=select($q3);
  if(sizeof($rd)>0){
      $q4="DELETE FROM `tbl_cart_master` WHERE `Cart_master_id`='$remove_item'";
      delete($q4);
  }
  return redirect("user_cart.php");
}
?>
<br><br>
<center>
	<h1 style="color: #fff;">Cart Details</h1><br>
	<table class="table" style="width: 700px;color: black;background: white;opacity: 0.9;">
		<tr >
			<th>Item</th>
			<th>Details</th>
		</tr>
		<?php 
			$q="SELECT * FROM tbl_cart_master inner join tbl_cart_child using(Cart_master_id) inner join tbl_item using(Item_id) inner join tbl_customer using(Cust_id) where Cust_id='$cid' and Cart_status='pending'";
			$re=select($q);
			// print_r($re);
			if(sizeof($re)>0)	{
				foreach ($re as $row) { ?>

					<tr>
						<td><img src="<?php echo $row['Item_image'];?>" width="170" height="200"></td>
						<td><b><?php echo $row['Item_name']; ?><span style="float: right;">
              <a href="?remove_item=<?php echo $row['Cart_master_id'] ?>&Cart_child_id=<?php echo $row['Cart_child_id'] ?>&Item_id=<?php echo $row['Item_id'] ?>&Cart_qty=<?php echo $row['Cart_qty'] ?>&Sell_price=<?php echo getProductPrice($row['Item_id']) ?>" class="btn btn-danger btn-sm">Remove</a></span></b><br><br>

						<?php echo $row['Item_desc']; ?><br><br><b>Quantity : </b>
						<?php echo $row['Cart_qty']; ?><br><br> 
						₹ <?php echo getProductPrice($row['Item_id']); ?></td>	
                    </tr>
               <?php   } ?>

            <?php   }else{
              ?>
                    <tr>
                      <td colspan="2"  align="center"><h4>Your Cart Is Empty....</h4></td>
                    </tr>

              <?php
          }
            ?>	
            <?php
            if(sizeof($re)>0)
            {
              if(getProductStock($re[0]['Item_id'])>=$re[0]['Cart_qty']){
                ?>
            <tr>
            	<td>Total Amount : ₹<?php echo $re[0]['Cart_tot_amt']?></td>
            	<td align="right" colspan=2><a href="card1.php?tot_amt=<?php echo $re[0]['Cart_tot_amt']?>&cmmid=<?php echo $re[0]['Cart_master_id']?>&quan=<?php echo $row['Cart_qty'] ?>&ccid=<?php echo $row['Cart_child_id'] ?>">
                <input type="button" value=" Pay ₹<?php echo $re[0]['Cart_tot_amt']?>" name="place_order" class="btn btn-danger"></a>
              </td>
            </tr>
            <?php 
            }else
            {?>

                  <font color="red">We do not have the required quantity for <?php echo $re[0]['Item_name'] ?>  <br>
                    Please Remove <?php echo $re[0]['Item_name'] ?> to checkout ! </font><br><br>

            <?php }
              ?>	
              <?php
            }
            ?>		
        </table>
</center>

<?php
include 'footer.php';
?>