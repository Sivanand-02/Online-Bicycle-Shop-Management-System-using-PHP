<?php include 'connection.php';
 $cid=$_SESSION['cust_id'];
extract($_GET)

 ?>
<script> 
    function printDiv() { 
      var divContents = document.getElementById("div_print").innerHTML; 
      var a = window.open('', '', 'height=500, width=500'); 
      a.document.write(divContents); 
      a.document.close(); 
      a.print(); 
    } 
  </script> 
<body onload="printDiv()">
  <div id="div_print" ><h3>Date:<?php echo date("Y-m-d"); ?></h3>
<center>
 <h2>Zephyr Fragrances</h2>
            <p>
              A108 Adam Street, 
              Ernakulam, 
              Kerala, 
              India <br><br>
              <strong>Phone:</strong> +91 6238673277<br> +91 778788260<br>
              <strong>Email:</strong> zephfragrances@gmail.com<br> zephperfumes@gmail.com<br> 
            </p> 
<h1 style="padding-top: 30px;font-size: 60px">Bill</h1>

<!-- <h1>View Sales</h1> -->
<table class="table" style="width: 1000px;color: black;font-style: italic;font-family: monospace;font-size: 22px" border="5">
   <tr>
        <th>No</th>
         <th>Date</th>
        <!-- <th>Total Amount</th> -->
        
           <th>Product</th>
        <th>Quantity</th>
                <th>Amount</th>
        <th>Image</th>
               <!--  <th>Status</th> -->
        
      </tr>
      <?php 

     $q="SELECT * FROM `tbl_order` INNER JOIN `tbl_cart_master` USING (`Cart_master_id`)INNER JOIN `tbl_cart_child` USING (Cart_master_id) INNER JOIN `tbl_customer` USING (`Cust_id`) INNER JOIN `tbl_item` USING (Item_id) where Cust_id='$cid' and Cart_status='Paid' and order_id='$oid' and o_date='$odate' ";
     $res=select($q);
     $sino=1;

    foreach ($res as $row) {?>
      <tr>
        <td><?php echo $sino++; ?></td>
        <td><?php echo $row['o_date'] ?></td> 
        <!-- <td><?php echo $row['total_amount'] ?></td> -->
      
        <td><?php echo $row['item_name'] ?></td>
        <td><?php echo $row['qty'] ?></td>
            <td><?php echo $row['total_price'] ?></td>
        <td><img src="<?php echo $row['item_image'] ?>" height="100" width="100"></td>
     <?php
       }


     ?>
  </table>
</center>