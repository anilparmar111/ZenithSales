<html>
<head>
<link href="media/bootstrap.min.css" rel="stylesheet">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="media/jquery-1.11.1.min.js"></script>
<script src="media/bootstrap.min.js"></script>
</head>
<body>
<form method="post" action="#">
Enter Starting Date : <input type='date' name='sdate' required><br>
Enter Ending Date : <input type='date' name='edate' required><br>
<input type='submit'>
</form>
</body>

</html>

<?php
error_reporting(0);
if($_POST['sdate'] && $_POST['edate'])
{
    
    $comp=$_GET['serch'];
    $id=$_GET['id'];
    error_reporting(0);
    try 
    {
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from payment_status  WHERE pdate>=? and  rdate<=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['sdate'],$_POST['edate']]);
        echo "<table class='table'>
    <thead>
    <tr>
        <th scope='col'>#</th>
        <th scope='col'>Biil No</th>
        <th scope='col'>Compnay Name</th>
        <th scope='col'>Debit Date</th>
        <th scope='col'>Credit Date</th>
        <th scope='col'>Total Pay</th>
        <th scope='col'>Total Recive</th>
        <th scope='col'> Payment Status</th>
    </tr>
    </thead>
    <tbody>";
$i=1;
$totaldebit=0;
$totalcreadit=0;
        foreach ($result as $row) 
        {
            $str="";
            $totaldebit+=$row['payment'];
            $totalcreadit+=$row['payment_recive'];
            if($row['pay']==1)
            {
                $str="Yes";
            }
            else {
                $str="No";
            }
            echo"<tr>
                    <th scope='row'>".$i."</th>
                    <td>".$row['billid']."</td>
                    <td>".$row['compname']."</td>
                    <td>".$row['pdate']."</td>
                    <td>".$row['rdate']."</td>
                    <td>".$row['payment']."</td>
                    <td>".$row['payment_recive']."</td>
                    <td>".$str."</td>
                </tr>";
            $i+=1;
        }
        echo"</tbody>
</table>";

        echo "<h1>Total Debit : ".$totaldebit."</h1>";
        echo "<h1>Total Credit : ".$totalcreadit."</h1>";
        $c=-1;
        $tmp=0;
        $totol=0;
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        die();
    }
}
?>

