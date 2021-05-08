<?php include 'required.php';?>
<?php
error_reporting(0);
    if(isset($_POST['SubmitButton'])){
        $user = $_POST["myInput"];
        $price=$_POST['price'];
        try 
        {
            $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
            $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "INSERT INTO items  VALUES ('".$user.",');";
            // $var=$databasehandler->query($sql);
            $sql="INSERT INTO items (item_name,price) VALUES (?,?)";			
            $result = $databasehandler->prepare($sql);
            $result->execute([$user,$price]);
        }  
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
header("Location: Addnitem.php");
    }

        ?>