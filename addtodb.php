<?php include 'required.php';?>
<?php
error_reporting(0);
    if(isset($_POST['SubmitButton'])){
        $user = $_POST["myInput"];
        // header("Zenithsales/debit_serch.php");
        try 
        {
            $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
            $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO comp (comp_name) VALUES ('".$user."');";
            $var=$databasehandler->query($sql);
        }  
catch (PDOException $e) {
        echo $e->getMessage();
        die();
        // header("Zenithsales/debit_serch.php");
    }
header("Location: debit_serch.php");
// header("Location : google.com");
    }

        ?>