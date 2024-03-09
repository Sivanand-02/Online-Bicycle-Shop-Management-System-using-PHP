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
<h1 style="padding-top: 30px;font-size: 60px">Customer Report</h1><br>

<!-- <h1>View Sales</h1> -->
<table border=1 class="table table-secondary table-striped " style="width: 1000px;color: black;background:white;opacity: 0.85;">
  <tr align="left">
      <th>No</th>
        <th>Customer</th>
        <th>City</th>
        <th>District</th>
        <th>Pincode</th>
        <th>Phone</th>
        <th>Gender</th>
    </tr>
    <?php 
    $q="select * from tbl_customer";
    $res=select($q);
       
      //$res=$r;
       $slno=1;
       foreach ($res as $row) {
      ?>
        
        
  <td><?php echo $slno++; ?></td>
        <td><?php echo $row['Cust_fname'] ?></td>
        <td><?php echo $row['Cust_city'] ?></td>
        <td><?php echo $row['Cust_dist'] ?></td>
        <td><?php echo $row['Cust_pin'] ?></td>
        <td><?php echo $row['Cust_phone'] ?></td>
        <td><?php echo $row['Cust_gender'] ?></td>
    </tr>
     <?php
       }


     ?>
  </table>
</center>