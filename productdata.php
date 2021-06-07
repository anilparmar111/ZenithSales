<?php
    $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from items";
    $var=$databasehandler->query($sql);
    $product_arry = array();
    foreach ($var as $key) 
    {
        $pname = $key['item_name'];
        $price = $key['price'];
        $product_arry[] = array("name" => $pname, "price" => $price);
        // echo "<option value='".$key['item_name']."'>".$key['item_name']." price : ".$key['price']."</option>";
    }
    array_reverse($product_arry);
echo json_encode($product_arry);




?>