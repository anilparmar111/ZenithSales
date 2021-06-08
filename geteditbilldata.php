<?php
//geteditbilldata.php?bln=&comp=

$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    session_start();
    $sql = "select * from bill where billid='".$_GET['bln']."' and compname='".$_GET['comp']."' and party='".$_SESSION['party']."'";
    $var=$databasehandler->query($sql);
    $product_arry = array();
    foreach ($var as $key) 
    {
        $compname = $key['compname'];
        $pname = $key['pname'];
        $qty =$key['qty'];
        $price=$key['price'];
        $timei=$key['timei'];
        $ps=$key['ps'];
        $party=$key['party'];
        $product_arry[] = array("compname" => $compname,"pname" => $pname,"qty" => $qty,"price" => $price,"timei" => $timei,"ps" => $ps,"party" => $party);
        // echo "<option value='".$key['item_name']."'>".$key['item_name']." price : ".$key['price']."</option>";
    }
    array_reverse($product_arry);
echo json_encode($product_arry);



?>