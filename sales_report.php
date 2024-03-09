<?php
 include 'connection.php';
 include 'random_functions.php';
extract($_GET);

 //$r=$_SESSION['res'];

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

<center>
  <br>
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
<h2 style="padding-top: 30px;font-size: 60px">Sales Report</h1><br>   

<!-- <h1>View Sales</h1> -->
<table border=1 class="table table-secondary table-striped " style="width: 1000px;color: black;background:white;opacity: 0.85;">
		<tr align="left">
		  <th>Slno</th>
         <th>Date</th>
         <th>Customer</th>
        
           <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
                <th>Status</th>
        
        
		</tr>
		<?php 

       
      $q="SELECT * FROM tbl_order INNER JOIN tbl_cart_master USING(Cart_master_id) INNER JOIN tbl_cart_child USING(Cart_master_id)  INNER JOIN tbl_item USING(Item_id) INNER JOIN tbl_customer USING(Cust_id) ";
      $res=select($q);
       $slno=1;
       foreach ($res as $row) {
      ?>
        
        
  <td><?php echo $slno++; ?></td>
        <td><?php echo $row['Order_date'] ?></td>
        <td><?php echo $row['Cust_fname'] ?></td>
        
        <td><?php echo $row['Item_name'] ?></td>
        <td><?php echo $row['Cart_qty'] ?></td>
        <td><?php echo getOldProductPrice($row['Item_id'],$row["Order_id"]) ?></td>
      
        <td><?php echo $row['Cart_status'] ?></td>
    </tr>
     <?php
       }


		 ?>
	</table>
  </font>
</center>