<?php 
include 'header.php';
extract($_GET);
 ?>
  <center>
 <!-- hero slider Start -->
    <div class="banner-wrap">
        <div class="banner-slider">
        
            <div class="banner-slide bg1">
                <div class="container">
                    <div class="hero-content">
                        <!-- <p data-animation="fadeInDown" class="mb-2">Fashion Look</p> -->

 <form method="post" style="width: 300px">
 <h2 style="color: white;"><i>SEARCH SALES</i></h2>
 <br>


  
       <input type="date" name="daily" class="form-control" /> Date 
       <br><br>
     <input type="month" name="monthly" class="form-control" /> Month
        <br><br>
         <input type="submit" name="sale" value="Submit" class="btn btn-danger">

      
    
  </form>
       </div>
                </div>
                <div class="hero-overlay"></div>
            </div>
            <!-- hero slide end -->
        </div>
    </div>
    <!-- hero slider end -->

    <br>
    <h1><i>View Sales</i></h1><br>
       <table class="table table-striped table-hover" style="width: 1400px">
        <tr>
            <th>Sl no.</th>
            <th>Name</th>
            <th>Product</th>
            <th>Date</th>
            <th>Total Amount</th>
        </tr>

        <?php 

         if (isset($_POST['sale'])){
           extract($_POST);
          
           if ($daily!=""){

           $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`cart_master_id`)INNER JOIN `tbl_cart_child` USING (cart_master_id) INNER JOIN `tbl_customer` USING(`customer_id`) INNER JOIN `tbl_item` USING (item_id)  where o_date='$daily' and cart_master_status='Paid' ";
           }
            else if ($monthly!="") {

            
             $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`cart_master_id`)INNER JOIN `tbl_cart_child` USING (cart_master_id) INNER JOIN `tbl_customer` USING(`customer_id`) INNER JOIN `tbl_item` USING (item_id)  where o_date like '$monthly%' and cart_master_status='Paid' ";

             }
           }else{
             $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`cart_master_id`)INNER JOIN `tbl_cart_child` USING (cart_master_id) INNER JOIN `tbl_customer` USING(`customer_id`) INNER JOIN `tbl_item` USING (item_id) where cart_master_status='Paid' ";
            }

                $res=select($q);
                // $_SESSION['res']=$res;
                // $r=$_SESSION['res'];
                 
                 $i=1;
                foreach ($res as $row) { ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['c_fname']; echo $row['c_lname']; ?></td>
                         <td><?php echo $row['i_name']; ?></td>
                        <td><?php echo $row['o_date']; ?></td>
                        <td><?php echo $row['total_amt']; ?></td>
                        </tr>
                    <?php 
                        }
                           ?>
    </table>
      <h2><a class="btn btn-get-started" href="salesreport.php"><b>Print Report</b></a></h2>
      <br>
</center>
<?php
include 'footer.php';
?>