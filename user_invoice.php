<?php 
include 'user_header.php';
extract($_GET);
$cid=$_SESSION['Cust_id'];

?>



<div id="div_print">
<div class="page-content container" style="background: white;">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #111-222
            </small>
        </h1>
        
        <div class="page-tools">
            <div class="action-buttons">
                <br><a class="btn bg-white btn-light mx-1px text-95" href="" onclick="printDiv()" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                <!-- <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a> -->
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="fa fa-book fa-2x text-success-m2 mr-1"></i> -->
                            <img src="images\logo.jpg" style="height: 50px; width: 120px"></img>
                        </div>
                    </div>
                </div>
                <!-- .row -->
<?php 
    $q="select * from tbl_customer where Cust_id='$cid'";
$res=select($q);


?>
                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"><?php echo $res[0]['Cust_fname'] ?><?php echo $res[0]['Cust_lname'] ?></span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                            <?php echo $res[0]['Cust_street'] ?>,<?php echo $res[0]['Cust_dist'] ?>
                            </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"><?php echo $res[0]['Cust_phone'] ?></b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125" style="padding-left: 350px;">
                                Invoice
                            </div>

                         <!--   <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1" style="padding-left: 350px;"></i> <span class="text-600 text-90">ID:</span> #123-654</div>
 -->
                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"  style="padding-left: 350px;"></i> <span class="text-600 text-90">Issue Date:</span><?php  ?></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"  style="padding-left: 350px;"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-success badge-pill px-25">Paid</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-sm-2">#</div>
                        <div class="col-9 col-sm-5">Description</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
                        <div class="d-none d-sm-block  col-sm-2">Unit Price</div>
                        <div class="col-2">Amount</div>
                    </div>
<?php 
$t="SELECT * FROM `tbl_cart_master` INNER JOIN `tbl_cart_child` USING(Cart_master_id) INNER JOIN `tbl_item` USING(Item_id) INNER JOIN tbl_customer USING(Cust_id) WHERE Cust_id='$cid' AND Cart_status='Delivered' AND Cart_master_id='$cmid' ";
$row=select($t);
$si=1;
foreach($row as $key)
{
    ?>

                    <div class="text-95 text-secondary-d3">
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-sm-2"><?php echo $si++ ?></div>
                            <div class="col-sm-10 col-sm-5"><?php echo $key['Item_name']?> <br> <?php echo $key['Item_Description']?></div>
                            <div class="d-none d-sm-block col-sm-2"><?php echo $key['Cart_qty'] ?></div>
                            <div class="d-none d-sm-block col-sm-2 text-95"><?php echo $key['Sell_price'] ?></div>

                        </div>
                        <?php
}  ?>
                        <!-- <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                            <div class="d-none d-sm-block col-1">2</div>
                            <div class="col-9 col-sm-5">Web hosting</div>
                            <div class="d-none d-sm-block col-2">1</div>
                            <div class="d-none d-sm-block col-2 text-95">$15</div>
                            <div class="col-2 text-secondary-d2">$15</div>
                        </div>

                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">3</div>
                            <div class="col-9 col-sm-5">Software development</div>
                            <div class="d-none d-sm-block col-2">--</div>
                            <div class="d-none d-sm-block col-2 text-95">$1,000</div>
                            <div class="col-2 text-secondary-d2">$1,000</div>
                        </div>

                        <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                            <div class="d-none d-sm-block col-1">4</div>
                            <div class="col-9 col-sm-5">Consulting</div>
                            <div class="d-none d-sm-block col-2">1 Year</div>
                            <div class="d-none d-sm-block col-2 text-95">$500</div>
                            <div class="col-2 text-secondary-d2">$500</div>
                        </div>
                    </div> -->

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->
        <?php if(sizeof($row)>0)
        {
            ?>
                <div class="row mt-3">
                       
<hr>
                        <div class="col-8 col-sm-5 text-grey text-90 order-first order-sm-last" style="float: right;">
                            <div class="row my-2">
                                <!-- <div class="col-7 text-right">
                                    SubTotal -->
                                <!-- </div>
                                <div class="col-sm-5 " >  -->
                                   <!--  <span class="text-120 text-secondary-d1" style="padding-left: 1em;"><?php //echo $row[0]['Cart_tot_amt']?></span>
                                </div> -->
                            </div>

                          

                            <hr>
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                <!-- </div>
                                <div class="col-5 "> -->
                                    <span class="text-150 text-success-d3 opacity-2" style="padding-left: 1em;"><?php echo $row[0]['Cart_tot_amt']?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                            
                        </div> -->

                    <hr />
                    <?php

        }   ?>

                    <div style="margin-bottom: 30px;"> 
                        <span class="text-secondary-d1 text-105">Please keep this invoice safe<br>Thank you for your shopping with us!</span>
                        <!-- <a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<?php include 'footer.php'?>


<style>
    body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}



</style>
<script> 
        function printDiv() { 
            var divContents = document.getElementById("div_print").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write(divContents); 
            a.document.close(); 
            a.print(); 
        } 
</script> 