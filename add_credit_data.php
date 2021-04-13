<?php include 'required.php';?>

<?php
$comp=$_GET['serch'];
$id=$_GET['id'];
error_reporting(0);
try 
{

    $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql="update bill set ps=1 WHERE compname=? and billid=?";			
    //$result = $databasehandler->prepare($sql);
    //$result->execute([$comp,$id]);
    $sql="select sum(qty*price) as total  from bill  WHERE compname=? and billid=?";			
    $result = $databasehandler->prepare($sql);
    $result->execute([$comp,$id]);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $total = $row['total'];
    // $total=$result['total'];
    echo"<html>
<head>
</head>
<body>
<h1 style='color:green;'>
        Total Bill Price Is : ".$total."
    </h1>
    <form method='post' name='form' action='#'>
        <input type='text' required placeholder='Enter Amout Recived' name='ramt'>
        <input type='date' required placeholder='Date' name='rdate'>
        <input type='submit' value='Submit'>
    </form>

</body></html>";
    $i=0;
    $c=-1;
    $tmp=0;
    $totol=0;
    if($_POST['ramt'])
    {
        
        $sql="update bill set ps=1 WHERE compname=? and billid=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$comp,$id]);
        $sql="update payment_status set pay=1 , payment_recive=?,rdate=? WHERE compname=? and billid=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['ramt'],$_POST['rdate'],$comp,$id]);
        header("Location: index.php");
        //$sql="insert into payment_status ";			
        //$result = $databasehandler->prepare($sql);
        //$result->execute([$comp,$id]);
        
    }
}
catch (PDOException $e) 
{
    echo $e->getMessage();
    die();
}

?>

