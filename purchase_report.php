<?php include 'connection.php';
extract($_GET);
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
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<body onload="printDiv()">
  <div id="div_print" >
    <img src="images\logo.jpg" style="height: 50px; width: 150px"></img>
  </div>
</body>

<center>
  <font style="font-family:Centaur">
  <h1><b>Firefox<b></h1>
<p>
              E801 Eve Street, 
              Ernakulam,  
              Kerala, 
              India <br><br>
              <strong>Phone:</strong> +91 9856231254<br> +91 77845126395<br>
              <strong>Email:</strong> firefox@gmail.com<br> 
            </p> 
<h1 style="padding-top: 30px;font-size: 60px">Purchase Report</h1><br>

<!-- <h1>View Sales</h1> -->
<center>
            <h1 style="color: #fff">Purchase Details</h1><br>
            <table class="table" style="width: 1300px;color: black;background: white;opacity: 0.7;">
            <tr>
            <th>Sl no.</th>
            <th>Item Name</th>
            <th>Vendor Name</th>
            <th>Cost Price</th>
            <th>Date</th>
            <th>Quantity</th>
            </tr>

            <?php 
         $q="SELECT * FROM tbl_purchase_child INNER JOIN tbl_purchase_master USING(Pur_master_id) INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_vendor USING(Vendor_id) where Pur_status='Paid'";
      $re=select($q);
      // print_r($re);
      if(sizeof($re)>0){
        $i=1;
        foreach ($re as $row) { ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['Item_name']; ?></td>
            <td><?php echo $row['Vendor_name']; ?></td>
            <td><?php echo $row['Cost_price']; ?></td>
            <td><?php echo $row['Pur_date']; ?></td>
            <td><?php echo $row['Pur_qty']; ?></td>
          
          <?php } ?>
          </tr>
        <?php
      }
      ?>  
        </table>
      </center>