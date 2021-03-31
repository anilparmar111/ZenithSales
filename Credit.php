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
//to add AM or PM after time
if(h>11) ap="PM";
if(h>12) h=h-12;
if(h==0) h=12;
//to add a zero in front of numbers<10
m=checkTime(m)
s=checkTime(s)
var time = today.getDate() + ":" + today.getMonth() + ":" + today.getFullYear();
document.getElementById("dat").innerHTML=time+ap
t=setTimeout('startTime()', 500);
document.getElementById('clock').innerHTML=h+":"+m+":"+s+" "+ap
// t=setTimeout('startTime()', 500)
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

<!-- action="add_debit_data.php?serch=<//?php echo $_GET['serch'];?>" method="post" -->



<?php 
try 
{

$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO bill (billid,compname,pname,qty,price,timei,ps) VALUES (?,?,?,?,?,?,?)";
$sql="select * from bill WHERE compname=? and ps=0";			
$result = $databasehandler->prepare($sql);
$result->execute([$_GET['serch']]);
$i=0;
$c=-1;
$tmp=0;
$totol=0;
// if($result!=null)
// { 
//   $c=$result[0]['billid'];
// }
foreach ($result as $row) 
{
    if($c==$row['billid'])
    { 
        $i=$i+1;
        echo"<tr>
        <th scope='row'>".$i."</th>
        <td>".$row['pname']."</td>
        <td>".$row['qty']."</td>
        <td>".$row['price']."</td>
        <td>".$row['qty']*$row['price']."</td>
      </tr>";
      $totol+=$row['qty']*$row['price'];
    }
    else
    {
        
        if($tmp>0)
        {
          echo"<td colspan='4'><button style='width:100%; height:100%;'><a style='text-decoration:none;' href=add_credit_data.php?serch=".$_GET['serch']."&id=".$c.">Credit</a></button></td><td>".$totol."</td>";
            echo"</tbody></table></form>";
        }
        $totol=0;
        $c=$row['billid'];
        $i=1;
        $tmp+=1;
        echo"<form action='#'><table class='table table-bordered border-primary'>".
            "<thead><tr><th scope='col' colspan='3'>".$c."</th><th scope='col' colspan='2'>".date("d-m-Y", strtotime($row['timei']))."</th></tr></thead>"
              ."
          <thead>
          <tr>
          <th scope='col'>#</th>
          <th scope='col'>Product</th>
          <th scope='col'>Qty</th>
          <th scope='col'>Price</th>
          <th scope='col'>Total</th>
          </tr>
          </thead>
          <tbody>"."<tr>
          <th scope='row'>".$i."</th>
          <td>".$row['pname']."</td>
          <td>".$row['qty']."</td>
          <td>".$row['price']."</td>
          <td>".$row['qty']*$row['price']."</td>
          </tr>";
          $totol+=$row['qty']*$row['price'];
}

// echo"</tbody>
        // </table><input type='submit'></form>";
// echo"</tbody></table></form>";
// echo " <tr>
//       <th scope='row'>3</th>
//       <td colspan='2'>Larry the Bird</td>
//       <td>@twitter</td>
//     </tr>";
    
}
if($tmp>0)
{
echo"<td colspan='4'><button style='width:100%; height:100%;'><a style='text-decoration:none;' href=add_credit_data.php?serch=".$_GET['serch']."&id=".$c.">Credit</a></button></td><td>".$totol."</td>";
            echo"</tbody></table></form>";
}
          }
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
?>


</form>

</body>
</html>