<html>

<head>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<link href="media/bootstrap.min.css" rel="stylesheet">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="media/jquery-1.11.1.min.js"></script>
<script src="media/bootstrap.min.js"></script>
</head>
<body>



<?php

try 
{
	$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
	$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT count(DISTINCT billid)   FROM bill where compname= ?";
	
	// $sql = "SELECT count(*) FROM `table` WHERE foo = ?"; 
$result = $databasehandler->prepare($sql); 
$result->execute([ $_GET['serch']]); 
$number_of_rows = $result->fetchColumn(); 
$index=$number_of_rows+1;
    if(!empty($_POST['product']))
    {
        $ed=date('Y-m-d');
        $total=0;
        for($i=0;$i<count($_POST['product']);$i++)
        { 
            $prod=$_POST['product'][$i];
            $qt=$_POST['qty'][$i];
            $pr=$_POST['price'][$i];
            $total+=$qt*$pr;
			$sql = "INSERT INTO bill (billid,compname,pname,qty,price,timei,ps) VALUES (?,?,?,?,?,?,?)";
			$result = $databasehandler->prepare($sql); 
			$result->execute([$index,$_GET['serch'],$prod,$qt,$pr,$ed,false]);
        }
        $sql = "INSERT INTO payment_status (compname,billid,pay,payment,pdate) VALUES (?,?,?,?,?)";
			$result = $databasehandler->prepare($sql); 
			$result->execute([$_GET['serch'],$index,false,$total,$ed]);
    }
    else
    {
    	echo ("error");
    }
}
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
	header("Location:index.php");
?>



<div class="container">
  <div class="jumbotron" class="container w3-display-container w3-text-white">
    <center><h1><?php echo $_GET['serch'];?></h1></center>      
    <p><div id="clock"></div></p>
    <p><div id="dat"></p>
  </div>
        
</div>





</body>
</html>