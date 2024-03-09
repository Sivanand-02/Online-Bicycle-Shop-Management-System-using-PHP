<?php

function getProductStock($id) {
    global $con;
    $stmt = $con->prepare("SELECT 
        *
        FROM tbl_purchase_child
        INNER JOIN tbl_purchase_master
        ON tbl_purchase_child.Pur_master_id = tbl_purchase_master.Pur_master_id
        WHERE Item_id = ? AND tbl_purchase_master.Pur_status = 'paid'
        ORDER BY Pur_date"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $purchases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    // var_dump($purchases); 
    if(!$purchases){
        return 0;
    }

    $stmt = $con->prepare("SELECT
        sum(tbl_cart_child.Cart_qty) as total_purchase
        FROM tbl_payment
        INNER JOIN tbl_order
            ON tbl_payment.Order_id = tbl_order.Order_id
        INNER JOIN tbl_cart_master
            ON tbl_order.Cart_master_id = tbl_cart_master.Cart_master_id
        INNER JOIN tbl_cart_child
            ON tbl_cart_master.Cart_master_id = tbl_cart_child.Cart_master_id
        WHERE tbl_cart_child.Item_id = ?;
        "
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $totalOrdered = $stmt->get_result()->fetch_assoc()['total_purchase'];
    // var_dump($purchases);
    // var_dump($totalOrdered);    
    $currentPurchase;

    foreach ($purchases as $key => $purchase) {
        if($totalOrdered < $purchase['Pur_qty']){
            $currentPurchase = $purchase;
            break;
        } else {
            $totalOrdered -= $purchase['Pur_qty'];
            // var_dump("yes");
        }
    }
    if(isset($currentPurchase)){
        // var_dump($currentPurchase['Pur_qty'] - $totalOrdered);
        return $currentPurchase['Pur_qty'] - $totalOrdered;
    } else {
        return 0;
    }
}

function getProductPrice($id) {
    global $con;
    $stock = getProductStock($id);
    if($stock){
    $stmt = $con->prepare("SELECT 
        *
        FROM tbl_purchase_child
        INNER JOIN tbl_purchase_master
        ON tbl_purchase_child.Pur_master_id = tbl_purchase_master.Pur_master_id
        WHERE Item_id = ? AND tbl_purchase_master.Pur_status = 'paid'
        ORDER BY Pur_date"
    );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $purchases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $con->prepare("SELECT
        sum(tbl_cart_child.Cart_qty) as total_purchase
        FROM tbl_payment
        INNER JOIN tbl_order
            ON tbl_payment.Order_id = tbl_order.Order_id
        INNER JOIN tbl_cart_master
            ON tbl_order.Cart_master_id = tbl_cart_master.Cart_master_id
        INNER JOIN tbl_cart_child
            ON tbl_cart_master.Cart_master_id = tbl_cart_child.Cart_master_id
        WHERE tbl_cart_child.Item_id = ?;
        "
    );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $totalOrdered = $stmt->get_result()->fetch_assoc()['total_purchase'];

        $currentPurchase;

        foreach ($purchases as $key => $purchase) {

            if($totalOrdered < $purchase['Pur_qty']){
                $currentPurchase = $purchase;
                break;
            } else {
                $totalOrdered -= $purchase['Pur_qty'];
            }

        }
        return $currentPurchase['Sell_price'];
    }
}

function getOldProductPrice($id,$orderid) {
    global $con;
    $stmt = $con->prepare("SELECT 
        *
        FROM tbl_purchase_child
        INNER JOIN tbl_purchase_master
        ON tbl_purchase_child.Pur_master_id = tbl_purchase_master.Pur_master_id
        WHERE Item_id = ? AND tbl_purchase_master.Pur_status = 'paid'
        ORDER BY Pur_date"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $purchases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $con->prepare("SELECT
        sum(tbl_cart_child.Cart_qty) as total_purchase
        FROM tbl_payment
        INNER JOIN tbl_order
            ON tbl_payment.Order_id = tbl_order.Order_id
        INNER JOIN tbl_cart_master
            ON tbl_order.Cart_master_id = tbl_cart_master.Cart_master_id
        INNER JOIN tbl_cart_child
            ON tbl_cart_master.Cart_master_id = tbl_cart_child.Cart_master_id
        WHERE tbl_cart_child.Item_id = ?;
        "
    );

    $stmt = $con->prepare("SELECT
        tbl_order.Order_id as order_id,
        tbl_cart_child.Cart_qty as quantity
        FROM tbl_payment
        INNER JOIN tbl_order
            ON tbl_payment.Order_id = tbl_order.Order_id
        INNER JOIN tbl_cart_master
            ON tbl_order.Cart_master_id = tbl_cart_master.Cart_master_id
        INNER JOIN tbl_cart_child
            ON tbl_cart_master.Cart_master_id = tbl_cart_child.Cart_master_id
        WHERE tbl_cart_child.item_id = ?
        ORDER BY tbl_payment.Payment_date
        ;"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


    $totalOrdered = 0;
    foreach ($orders as $order) {
        $totalOrdered += $order['quantity'];
    }

    $currentPurchase = $purchases[0];
    $purchasesIndex = 0;
    foreach ($orders as $order) {
        if($order['order_id'] != $orderid){
            if($currentPurchase['Pur_qty'] > $order['quantity']){
                $currentPurchase['Pur_qty'] -= $order['quantity'];
            } else {
                $currentPurchase =  $purchases[++$purchasesIndex];
            }
        } else {
            return $currentPurchase['Sell_price'];
        }
    }

}


//function isPurchaseUsed($purchaseId){

    //global $con;

    //$stmt = $con->prepare("SELECT 
        //*
        //FROM tbl_purchase_child
        //INNER JOIN tbl_purchase_master
        //ON tbl_purchase_child.purchase_master_id = tbl_purchase_master.purchase_master_id
        //WHERE tbl_purchase_master.purchase_master_id = ?"
    //);
    //$stmt->bind_param("i", $purchaseId);
    //$stmt->execute();
    //$main_purchases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    //foreach ($main_purchases as  $purchase) {

        //$product_id = $purchase['product_id'];

        //$stmt = $con->prepare("SELECT 
            //*
            //FROM tbl_purchase_child
            //INNER JOIN tbl_purchase_master
            //ON tbl_purchase_child.purchase_master_id = tbl_purchase_master.purchase_master_id
            //WHERE product_id = ?
            //ORDER BY date_added"
        //);
        //$stmt->bind_param("i", $product_id);
        //$stmt->execute();
        //$purchases = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        //$stmt = $con->prepare("SELECT
            //tbl_order.order_id as order_id,
            //tbl_cart_child.quantity as quantity
            //FROM tbl_payment
            //INNER JOIN tbl_order
                //ON tbl_payment.order_id = tbl_order.order_id
            //INNER JOIN tbl_cart_master
                //ON tbl_order.cart_master_id = tbl_cart_master.cart_master_id
            //INNER JOIN tbl_cart_child
                //ON tbl_cart_master.cart_master_id = tbl_cart_child.cart_master_id
            //WHERE tbl_cart_child.product_id = ?
            //ORDER BY tbl_payment.date
            //;"
        //);

        //$stmt->bind_param("i", $product_id);
        //$stmt->execute();
        //$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        //$totalOrdered = 0;
        //foreach ($orders as $order) {
            //$totalOrdered += $order['quantity'];
        //}

        //$currentPurchase = $purchases[0];

        //$purchasesIndex = 0;

        //foreach ($orders as $order) {
                //if($currentPurchase['quantity'] > $order['quantity']){
                    //$currentPurchase['quantity'] -= $order['quantity'];
                    //if($currentPurchase['purchase_master_id'] == $purchaseId){
                        //return true;
                    //}
                //} else {
                    //$currentPurchase =  $purchases[++$purchasesIndex];
                //}
        //}

    //}
    //return false;

//}

//function getCartItmes(&$orders,$isOld=false) {
    //global $con;
    //foreach ($orders as $key => $order) {
        //$stmt = $con->prepare("
            //SELECT
                //tbl_customer.customer_id,
                //tbl_cart_master.cart_master_id,
                //cart_child_id,
                //tbl_product.product_id as product_id,
                //quantity,
                //product_name,
                //product_image,
                //product_description,
                //subcategory_name,
                //brand_name,
                //tbl_cart_child.date_added as date_added
                //FROM tbl_cart_master
                //INNER JOIN tbl_cart_child
                    //ON tbl_cart_master.cart_master_id = tbl_cart_child.cart_master_id
                //INNER JOIN tbl_product
                    //on tbl_cart_child.product_id = tbl_product.product_id
                //INNER JOIN tbl_subcategory
                    //ON tbl_product.subcategory_id = tbl_subcategory.subcategory_id
                //INNER JOIN tbl_brand
                    //ON tbl_product.brand_id = tbl_brand.brand_id
                //INNER JOIN tbl_customer
                    //ON tbl_cart_master.customer_id = tbl_customer.customer_id
                    //WHERE 
                        //tbl_cart_master.cart_master_id = ?
        //");
        //$stmt->bind_param("i",$order['cart_master_id']);
        //$stmt->execute();
        //$orderProducts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        //$subtotal = 0;
        //foreach ($orderProducts as $productIndex => $product) {
            //$stock = getProductStock($product['product_id']);
            //$orderProducts[$productIndex]['stock'] = $stock;
            //$price;
            //if($isOld){
                //$price = getOldProductPrice($product['product_id'],$order['order_id']);
            //} else {
                //$price = getProductPrice($product['product_id']);
            //}
            //$orderProducts[$productIndex]['price'] = $price;
            //$total = $price * $product['quantity']; 
            //$orderProducts[$productIndex]['total'] = $total;
            //$subtotal += $total;
        //}
        //$orders[$key]['products'] = $orderProducts;
        //$orders[$key]['subtotal'] = $subtotal;

    //}
//}



?>