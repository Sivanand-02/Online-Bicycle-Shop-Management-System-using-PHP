<?php 
include 'connection.php';

$cid=$_SESSION['Cust_id'];
extract($_GET);

if (isset($_GET['upid'])) {
    extract($_GET);

    $q="select * from tbl_card where Card_id='$upid'";
    $res1=select($q); 
}     

if(isset($_POST['pay'])){
  extract($_POST);

  $date=$exp_date;
  $today=date("Y-m");
  if ($date < $today) {
  alert('Your card is expired');
  }else{

  $q1="INSERT INTO tbl_order VALUES(NULL,'$cmmid',now())";
  $odid=insert($q1);

  $q2="INSERT INTO tbl_card VALUES(NULL,'$cid','$card_no','$card_holder','$exp_date')";
  $card_id=insert($q2);
  $q3="INSERT INTO tbl_payment VALUES(null,'$odid','$card_id','$cmmid',now())";
  insert($q3);
  $q4="UPDATE tbl_cart_master SET Cart_status='Paid' where Cart_master_id='$cmmid'";
  update($q4);
 
  $q3="select * from tbl_cart_child where Cart_master_id='$cmmid'";
  $res=select($q3);

  foreach ($res as $key) {
    
    $pid=$key['Item_id'];
    $qty=$key['Cart_qty'];

   $q6="update tbl_item set Item_stock=Item_stock-'$qty' where Item_id='$pid'";
    update($q6);

     alert("Payment succesful ! ");
  return redirect("user_home.php");


  }

}
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Credit Card</title>

  <!-- Styles -->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style.css">
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
  <meta name="robots" content="noindex,follow" />
</head>

<body>
    <?php if (isset($_GET['upid'])) { ?>
      <?php 
      $q="SELECT * FROM tbl_card where Cust_id=$cid";
      $res=select($q); 
      ?>
    <form class="credit-card" method="post">
      <div class="form-header">
        <h4 class="title">Payment</h4>
      </div>

      <div class="form-body">
        <p>Total amount to be paid : ₹<?php echo $tot_amt ?></p>
        <input type="text" class="card-number"  name="card_no" value="<?php echo $res[0]['Card_holder'] ?>" style="color:black;">
        <input type="text" class="card-number" name="card_holder" value="<?php echo $res[0]['Card_no'] ?>" style="color:black;">

        <!-- Date Field -->
        <div class="date-field">
          <div class="month">
            <input type="month" class="card-number" name="exp_date" placeholder="MM-YY">
          </div>
        </div>

        <!-- Card Verification Field -->
        <div class="card-verification">
          <div class="cvv-input">
            <input type="password" placeholder="CVV">
          </div>
          <div class="cvv-details">
            <p>3 or 4 digits usually found <br> on the signature strip</p>
          </div>
        </div>

        <!-- Buttons --><br><br><br><br><br>

        <button type="submit" name="pay" class="proceed-btn">Proceed</button>
        <!-- <button type="submit" class="paypal-btn"><a href="#">Pay With</a></button> -->
      </div>
    </form>
<?php }else{ ?>
    <form class="credit-card" method="post">
      <div class="form-header">
        <h4 class="title">Payment</h4>
      </div>

      <div class="form-body">
        <!-- Card Number -->
        <p>Total amount to be paid : ₹<?php echo $tot_amt ?></p>
        <input type="text" class="card-number" pattern=[0-9]{16} name="card_no" placeholder="Card Number">
        <input type="text" class="card-number" maxlength=15 name="card_holder" placeholder="Card Holder Name">

        <!-- Date Field -->
        <div class="date-field">
          <div class="month">
            <input type="month" class="card-number" name="exp_date" placeholder="MM-YY">
          </div>
        </div>

        <div class="card-verification">
          <div class="cvv-input">
            <input type="password" placeholder="CVV">
          </div>
          <div class="cvv-details">
            <p>3 or 4 digits usually found <br> on the signature strip</p>
          </div>
        </div>

        <br><br><br><br><br>

        <button type="submit" name="pay" class="proceed-btn">Proceed</button>
      </div>
    </form>
    <?php 
    } ?>
</body>

<center>
    <br><br><br><br><br>
  <h1 style="color: black;">Saved Cards</h1><br>
  <table class="table table-striped" style="width:700px;color: black;background: white;opacity: 0.85;">
    <tr>
      <th>Sl no.</th>
      <th>Name</th>
      <th colspan="2">Card Number</th>
      </tr>
    <?php 
    $q="SELECT * FROM tbl_card where Cust_id=$cid";
      $re=select($q);
      if(sizeof($re)>0) {
        $i=1;
        foreach ($re as $row) { ?>

          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['Card_holder']; ?></td>
            <td><?php echo $row['Card_no']; ?></td>
            <td><a class="btn btn-success"  href="?upid=<?php echo $row['Card_id'] ?>&tot_amt=<?php echo $tot_amt ?>&cmmid=<?php echo $cmmid ?>&quan=<?php echo $quan ?>&ccid=<?php echo $ccid ?>">Use</a></td>
          </tr>
               <?php   } ?>

            <?php   }
            
         ?>       
        </table>
</center>

</html>

<style type="text/css">
  /* Global */

* {
  box-sizing : border-box;
}
caret.png
body,
html {
  height     : 100%;
  min-height : 100%;
}

body {
  margin           : 0;
  background-color : #e7e7e7;
  font-family      : 'Roboto',
                     sans-serif;
}

/* Credit Card */

.credit-card {
  width            : 360px;
  height           : 400px;
  margin           : 60px auto 0;
  border           : 1px solid #ddd;
  border-radius    : 6px;
  background-color : #fff;
  box-shadow       : 1px 2px 3px 0px rgba(0,0,0,0.10);
}

.form-header {
  height        : 60px;
  padding       : 20px 30px 0;
  border-bottom : 1px solid #E1E8EE;
}

.form-body {
  height  : 340px;
  padding : 30px 30px 20px;
}

/* Title */

.title {
  margin    : 0;
  color     : #5e6977;
  font-size : 18px;
}

/* Common */

.card-number,
.cvv-input input,
.month select,
.paypal-btn,
.proceed-btn,
.year select {
  height : 42px;
}

.card-number,
.month select,
.year select {
  font-size   : 14px;
  font-weight : 100;
  line-height : 14px;
}

.card-number,
.cvv-details,
.cvv-input input,
.month select,
.year select {
  color   : #86939e;
  opacity : .7;
}

/* Card Number */

.card-number {
  width         : 100%;
  margin-bottom : 20px;
  padding-left  : 20px;
  border        : 2px solid #e1e8ee;
  border-radius : 6px;
}

/* Date Field */

.month select,
.year select {
  -moz-appearance     : none;
  -webkit-appearance  : none;
  width               : 145px;
  margin-bottom       : 20px;
  padding-left        : 20px;
  border              : 2px solid #e1e8ee;
  border-radius       : 6px;
  background          : url('http://designmodo.com/demo/creditcardform/caret.png') no-repeat;
  background-position : 85% 50%;
}

.month select {
  float : left;
}

.year select {
  float : right;
}

/* Card Verification Field */

.cvv-input input {
  width         : 145px;
  float         : left;
  padding-left  : 20px;
  border        : 2px solid #e1e8ee;
  border-radius : 6px;
  background    : #fff;
}

.cvv-details {
  float         : right;
  margin-bottom : 20px;
  font-size     : 12px;
  font-weight   : 300;
  line-height   : 16px;
}

.cvv-details p {
  margin-top : 6px;
}

/* Buttons Section */

.paypal-btn,
.proceed-btn {
  cursor: pointer;
  width         : 100%;
  border-color  : transparent;
  border-radius : 6px;
  font-size     : 16px;
}

.proceed-btn {
  margin-bottom : 10px;
  background    : #7dc855;
}

.paypal-btn a,
.proceed-btn a {
  text-decoration : none;
  cursor          : pointer;
}

.proceed-btn a {
  color : #fff;
}

.paypal-btn a {
  color : rgba(242, 242, 242, 0.7);
}

.paypal-btn {
  padding-right : 95px;
  background    : url('http://designmodo.com/demo/creditcardform/paypal-logo.svg') no-repeat 65% 56% #009cde;
}
</style>