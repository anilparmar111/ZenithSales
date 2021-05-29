<?php
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['search'])) 
        {
                $Name = $_POST['search'];
                $Query = "SELECT * FROM items WHERE item_name LIKE '%$Name%' LIMIT 5";
                $qryres=$databasehandler->query($Query);
                while ($Result = $qryres->fetch()) 
                {
                        echo $Result['item_name']; 
                }
        }

?>
