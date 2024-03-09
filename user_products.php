<?php
include 'user_header.php';
include 'random_functions.php';

$q="SELECT * FROM tbl_item";
$res=select($q);

if(isset($_POST['filter'])){
    extract($_POST);
    $q="SELECT * FROM tbl_item where Cat_id='$cat_id' and Subcat_id='$subcat_id' and Model_id='$model_id'";
    $res=select($q);    

}
if(sizeof($res)>0);
?>

<style type="text/css">
.product-list {
    padding: 20px 10px 20px;
    font-family: 'Nunito Sans', sans-serif;
}

.product-list>ul {
    margin: 0 -10px;
    padding: 0;
    list-style: none;
    display: flex;
}
.product-list>ul>li {
    width: 25%;
    padding: 10px;
}
.white-box {
    border-radius: 5px;
    box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.4);
    background-color: white;
    padding: 35px 20px;
    transition: all 0.5s ease-in-out;
    position: relative;
}
.wishlist-icon {
    position: absolute;
    right: 12px;
    top: 10px;
}
.wishlist-icon img {
    width: 20px;
    height: 20px;
}
.product-img {
    min-height: 135px;
}
.product-img img {
    max-width: 100%;
    max-height: 130px;
    display: block;
    margin: 0 auto;
}
.product-bottom {
    text-align: center;
}
.product-name {
    font-size: 16px;
    color: black;
    text-align: center;
    margin: 10px 0 10px;
    font-weight: 600;
    max-height: 48px;
    min-height: 48px;
    overflow: hidden;
}
.price {
    margin-top: 0;
    font-size: 18px;
    font-weight: 600;
    color: #000000;
    font-family: 'Open Sans', sans-serif;
}
.blue-btn {    
	background: #13cfdf;
    border-radius: 5px;
    color: #ffffff;
    font-weight: 700;
    border: none;
    padding: 0 15px;
    cursor: pointer;
    height: 30px;
    line-height: 30px;
    max-width: 132px;
    margin: 10px auto 0;
    display: block;
    text-align: center;
    text-decoration: none;
}
.price .line-through {
    font-size: 14px;
    color: #999999;
    font-weight: 400;
    vertical-align: 1px;
    display: inline-block;
    text-decoration: line-through;
    margin-left: 4px;
}
</style>

<div class="container">
    <br><br> 
    <div style="color: red;display: flex;">
        <form method="post"  style="color: red;display: flex;">
       Category : &nbsp;&nbsp;<select name="cat_id" class="form-control" style="width: 120px;">
                                    <?php 
                                        $q1="SELECT * FROM `tbl_category`";
                                        $rd=select($q1);
                                        if(sizeof($rd)>0){
                                            foreach ($rd as $row) { ?>
                                                <option value="<?php echo $row['Cat_id']; ?>"><?php echo $row['Cat_name']; ?></option>
                                        <?php   }
                                        }
                                     ?>
                                </select>&nbsp;&nbsp;&nbsp;
        Subcategory : &nbsp;&nbsp;<select name="subcat_id" class="form-control" style="width: 80px;">
                                    <?php 
                                        $q1="SELECT * FROM `tbl_subcategory`";
                                        $rd=select($q1);
                                        if(sizeof($rd)>0){
                                            foreach ($rd as $row) { ?>
                                                <option value="<?php echo $row['Subcat_id']; ?>"><?php echo $row['Subcat_name']; ?></option>
                                        <?php   }
                                        }
                                     ?>
                                </select>&nbsp;&nbsp;&nbsp;
        Model : &nbsp;&nbsp;<select name="model_id" class="form-control" style="width: 350px;">
                                    <?php 
                                        $q1="SELECT * FROM `tbl_model`";
                                        $rd=select($q1);
                                        if(sizeof($rd)>0){
                                            foreach ($rd as $row) { ?>
                                                <option value="<?php echo $row['Model_id']; ?>"><?php echo $row['Model_name']; ?></option>
                                        <?php   }
                                        }
                                     ?>
                                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" class="btn btn-info btn-sm" name="filter" value="Filter" style="height: 38px">
                                <br><br>

         </form>
    </div><br><br>
    <div class="product-list">
      <div class="row">
        <style>
            .col-sm-3 {
                margin-bottom: 50px;
            }
        </style>
      	<?php
      	foreach ($res as $key) {

            // getProductStock( $key['Item_id']);
            // continue;
            if($key['Item_status']=='0')
                    {?>
            <div class="col-sm-3 ">
          <div class="white-box">   
            <div class="product-img">
              <img src="<?php echo  $key['Item_image']?>">
            </div>
            <div class="product-bottom">
              <div class="product-name"><?php echo $key['Item_name']?></div>
              <div class="price">
                <span>₹</span> <span><?php echo getProductPrice($key['Item_id'])?></span> 
              </div><br>
             <span style="color: red;">Out of stock</span>
            </div>
          </div>
        </div>
        <?php
    }
    elseif(getProductStock($key['Item_id'])=='0'){?>
        <div class="col-sm-3 ">
          <div class="white-box">   
            <div class="product-img">
              <img src="<?php echo  $key['Item_image']?>">
            </div>
            <div class="product-bottom">
              <div class="product-name"><?php echo $key['Item_name']?></div>
              <div class="price">
                <!-- <span>₹</span> <span><?php echo $key['Sell_price']?></span>  -->
              </div><br>
             <span style="color: red;">Out of stock</span>
            </div>
          </div>
        </div>
        <?php
    }
    else{?>



        <div class="col-sm-3 ">
          <div class="white-box">   
            <div class="product-img">
              <img src="<?php echo 	$key['Item_image']?>">
            </div>
            <div class="product-bottom">
              <div class="product-name"><?php echo $key['Item_name']?></div>
              <div class="price">
                <span>₹</span> <span><?php echo getProductPrice($key['Item_id'])?>.00</span> 
              </div><br>
              <a href="single_product1.php?amt=<?php echo $key['Sell_price']?>&id=<?php echo $key['Item_id']?>&img=<?php echo $key['Item_image']?>&stock=<?php echo getProductPrice($key['Item_id'])?>&desc=<?php echo $key['Item_desc']?>&name=<?php echo $key['Item_name']?>" class="btn btn-danger">Product Details</a>
            </div>
          </div>
        </div>
        <?php
    }

}?>
    </div>
</div>
</div>

<?php
include 'footer.php';
?>