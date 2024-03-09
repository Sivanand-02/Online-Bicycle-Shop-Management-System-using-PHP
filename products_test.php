<?php
include 'user_header.php';

$q="SELECT * FROM tbl_item";
$res=select($q);
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
/*#bs{
  color:white;
}*/
</style>

<div class="container">
    <div class="product-list">
      <div class="row">
        <?php
        foreach ($res as $key) {?>
        <div class="col-sm-3 ">
          <div class="white-box">
            <div class="wishlist-icon">
              <a href="javascript:void(0);"></a>
            </div>
            <div class="product-img">
              <img src="<?php echo  $key['Item_image']?>">
            </div>
            <div class="product-bottom">
              <div class="product-name"><?php echo $key['Item_name']?></div>
              <div class="price">
                <span>₹</span> <span><?php echo $key['Sell_price']?></span> 
              </div><br>
              <a href="single_product1.php?amt=<?php echo $key['Sell_price']?>&id=<?php echo $key['Item_id']?>&img=<?php echo $key['Item_image']?>&desc=<?php echo $key['Item_desc']?>&name=<?php echo $key['Item_name']?>" class="btn btn-danger">Product Details</a>
            </div>
          </div>
        </div>
        <?php
    }?>
    </div>
</div>
</div>

<?php
include 'footer.php';
?>