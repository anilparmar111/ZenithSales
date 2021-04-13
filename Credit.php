<?php include 'required.php';?>
<html>

<head>
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<link href="media/bootstrap.min.css" rel="stylesheet">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="media/jquery-1.11.1.min.js"></script>
<script src="media/bootstrap.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!-- <link rel="stylesheet" href="w3.css"> -->

<script src="script.js"></script>
<script type="text/javascript">
function startTime(){

var today=new Date()
var h=today.getHours()
var m=today.getMinutes()
var s=today.getSeconds()
var ap="AM";
if(h>11) ap="PM";
if(h>12) h=h-12;
if(h==0) h=12;
m=checkTime(m)
s=checkTime(s)
var time = today.getDate() + ":" + today.getMonth() + ":" + today.getFullYear();
document.getElementById("dat").innerHTML=time+ap
t=setTimeout('startTime()', 500);
document.getElementById('clock').innerHTML=h+":"+m+":"+s+" "+ap
}
function checkTime(i){
if (i<10)
{ i="0" + i}
return i
}



window.onload=startTime;
</script>

<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <div class="jumbotron" class="container w3-display-container w3-text-white">
    <center><h1><?php echo $_GET['serch'];?></h1></center>      
    <p><div id="clock"></div></p>
    <p><div id="dat"></p>
  </div>
        
</div>



<?php 
error_reporting(0);
session_start();
try 
{
if( !isset( $_SESSION['party'] ) ) 
   {
       $msg="Please Select Party";
       header("Location: login.php?msg={$msg}");  
   }
$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="select payment from payment_status WHERE compname=? and party=?";
// $_GET['serch']
$result = $databasehandler->prepare($sql); 
$result->execute([$_GET['serch'],$_SESSION['party']]);
$tp=0;
foreach($result as $row)
{
    $tp=$tp+$row['payment'];
}

echo "<h1 style='color:red;'>Total Payable Amount : ".$tp."</h1></br>";
$sql="select amount from payment_rec WHERE comp_name=? and party=?";
$result = $databasehandler->prepare($sql); 
$result->execute([$_GET['serch'],$_SESSION['party']]);
$tr=0;
foreach($result as $row)
{
    $tr=$tr+$row['amount'];
}
echo "<h1 style='color:green;'>Total Recieved Amount : ".$tr;
echo "</h1><br>";
echo "<h1 style='color:blue;'>Total : ";
echo $tr-$tp;
echo "<br>";
echo "<br>";

}
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
    ?>
<form method='post' name='form' action='#'>
        <input type='text' required placeholder='Enter Amout Recived' name='ramt'>
        <input type='date' required placeholder='Date' name='rdate'>
        <input type='submit' value='Click Hear To Credit'>
</form>

<?php

try 
{
    session_start();
    if( !isset( $_SESSION['party'] ) ) 
   {
       $msg="Please Select Party";
       header("Location: login.php?msg={$msg}");  
   }
      if($_POST['ramt'])
      {
          $sql="INSERT INTO payment_rec (comp_name,rdate,amount,party) VALUES (?,?,?,?)";			
          $result = $databasehandler->prepare($sql);
          $result->execute([$_GET['serch'],$_POST['rdate'],$_POST['ramt'],$_SESSION['party']]);
          header("Location: index.php"); 
      }


}
catch (PDOException $e) 
{
    echo $e->getMessage();
    die();
}
?>



</body>
</html>