<?php 
include 'connection.php';
include 'random_functions.php';

 $cid=$_SESSION['Cust_id'];
extract($_GET);

$qi="SELECT * FROM tbl_customer where Cust_id=$cid";
$qii=select($qi);
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

  <html>
<head>
  <title>Firefox</title>
</head>
</html>
<body onload="printDiv()">
  <div id="div_print" >


    
<img src="images\logo.jpg" style="height: 50px; width: 150px"></img>
<div id=div_print align="right"><h6 style="margin-right: 1em;padding:2em;font-family: Centaur;">Date : <?php echo date("d-m-y") ?></h6></div>
<font style="font-family:Centaur">
<center>
  <h1><b>Firefox</b></h1>
<p>
              E801 Eve Street, 
              Ernakulam, 
              Kerala, 
              India <br><br>
              <strong>Phone:</strong> +91 9856231254<br> +91 77845126395<br>
              <strong>Email:</strong> firefox@gmail.com<br> 
            </p> 
<h1 style="padding-top: 30px;font-family:Centaur;color:black;text-align: center;  ">Invoice</h1><br>
</center>
<p style="margin-left: 17em;"><b>Name : </b><?php echo $qii[0]['Cust_fname'];?><br>
<b>Address : </b><?php echo $qii[0]['Cust_street'] ?>, <?php echo $qii[0]['Cust_city'] ?>, <?php echo $qii[0]['Cust_dist'] ?>, <?php echo $qii[0]['Cust_pin'] ?></p>
<center>
<!-- <h1>View Sales</h1> -->
<table border=1 class="table table-secondary table-striped " style="width: 1000px;color: black;background:white;opacity: 0.85;">
	 <tr align="left">
        <th>Sl. no</th> 
        <th>Product</th>
        <th>Date</th>
        <th>Quantity</th>
        <th>Amount</th>



        <!-- <th><a class="btn bg-white btn-light mx-1px text-95" href="" onclick="printDiv()" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                </a></th> -->
               <!--  <th>Status</th> -->
        
      </tr>
      <?php 

     $q="SELECT * FROM tbl_cart_master INNER JOIN tbl_cart_child USING(Cart_master_id) inner join tbl_order using (Cart_master_id) INNER JOIN tbl_customer USING (Cust_id) INNER JOIN tbl_item USING (Item_id) WHERE Cust_id='$cid' AND Cart_status='Paid' and Order_id='$oid' ";
     $res=select($q);
     $slno=1;

    foreach ($res as $row) {?>
        <tr>
        <td><?php echo $slno++; ?></td>
        <td><?php echo $row['Item_name'] ?></td> 
        <td><?php echo $row['Order_date'] ?></td>
        <td><?php echo $row['Cart_qty'] ?></td>
        <td><?php echo getOldProductPrice($row['Item_id'],$row["Order_id"]) ?></td>
      </tr>
     <?php
       }
		 ?>
     <tr><th colspan="4" align="left"> </th>
      <td colspan="" align="left" style=""><b>Total Amount : </b><?php echo $row['Cart_tot_amt']  ?>
      </td>
    </tr>
	</table>
  </font>
</center>
</font>
