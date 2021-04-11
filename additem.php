<?php
error_reporting(0);
    if(isset($_POST['SubmitButton'])){
        $user = $_POST["myInput"];
        try 
        {
            $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
            $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO items (item_name) VALUES ('".$user."');";
            $var=$databasehandler->query($sql);
        }  
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
header("Location: debit_serch.php");
    }

        ?>