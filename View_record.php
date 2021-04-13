<?php include 'required.php';?>
<html>
<head>
<link href="media/bootstrap.min.css" rel="stylesheet">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> -->
<script src="media/jquery-1.11.1.min.js"></script>
<script src="media/bootstrap.min.js"></script>
</head>
<body>
<form method="post" action="#">
Enter Starting Date : <input type='date' name='sdate' required>
<br>
<br><br>
Enter Ending Date : <input type='date' name='edate' required><br>
<br>
<br>
<br>
<!-- Enter Compnay Name : <input type="text" placeholder="Enter Compnay Name" name="cname"> -->
<select id='ll' name='cname'  style='width: 200px;' required>
            <option value='-1'>-- Select Compnay Name --</option> 
            <?php
                try 
                {
                    $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
                    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "select * from comp";
                    $var=$databasehandler->query($sql);
                    foreach ($var as $key) {
                      echo "<option value='".$key['comp_name']."'>".$key['comp_name']."</option>";
                    }
                }  
                catch (PDOException $e) {
                    echo $e->getMessage();
                  die();
                }
                ?>
</select>
<input type='submit'>
</form>
</body>
</html>
<?php
error_reporting(0);

class Lazer_data
    {
        public $billno="-";
        public $comp_name;
        public $ddate="-";
        public $cdate="-";
        public $compdate;
        public $amount;
    }
$arr=array();
if($_POST['sdate'] && $_POST['edate'] && $_POST['cname']!='-1')
{
    $comp=$_GET['serch'];
    $id=$_GET['id'];
    error_reporting(0);
    try 
    {
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from payment_status  WHERE pdate>=? and  pdate<=? and compname=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['sdate'],$_POST['edate'],$_POST['cname'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno=$row['billid'];
            $dt->amount=$row['payment'];
            $dt->comp_name=$row['compname'];
            $dt->ddate=$row['pdate'];
            $dt->compdate=$row['pdate'];
            array_push($arr,$dt);
        }
        $sql="select * from payment_rec  WHERE rdate>=? and  rdate<=? and comp_name=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['sdate'],$_POST['edate'],$_POST['cname'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno="-";
            $dt->amount=$row['amount'];
            $dt->comp_name=$row['comp_name'];
            $dt->cdate=$row['rdate'];
            $dt->compdate=$row['rdate'];
            array_push($arr,$dt);
        }
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        die();
    }
}
elseif($_POST['sdate'] && $_POST['edate'])
{
    try 
    {
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from payment_status  WHERE pdate>=? and  pdate<=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['sdate'],$_POST['edate'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno=$row['billid'];
            $dt->amount=$row['payment'];
            $dt->comp_name=$row['compname'];
            $dt->ddate=$row['pdate'];
            $dt->compdate=$row['pdate'];
            array_push($arr,$dt);
        }
        $sql="select * from payment_rec  WHERE rdate>=? and  rdate<=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_POST['sdate'],$_POST['edate'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno="-";
            $dt->amount=$row['amount'];
            $dt->comp_name=$row['comp_name'];
            $dt->cdate=$row['rdate'];
            $dt->compdate=$row['rdate'];
            array_push($arr,$dt);
        }
        print_r($a);
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        die();
    }
}
function cmp($x, $y) {
    return strtotime($x->compdate) - strtotime($y->compdate);

}
usort($arr, "cmp");
echo "<table class='table'>
    <thead>
    <tr>
        <th scope='col'>#</th>
        <th scope='col'>Biil No</th>
        <th scope='col'>Compnay Name</th>
        <th scope='col'>Debit Date</th>
        <th scope='col'>Credit Date</th>
        <th scope='col'>Amount</th>
    </tr>
    </thead>
    <tbody>";
    $i=1;
    $sum=0;
    foreach ($arr as $key=>$entry) {
        $amount=$entry->amount;
        if($entry->ddate=='-')
        {
            $amount=$amount*(-1);
        }
        $sum+=$amount;
        echo "<tr>
                    <th scope='row'>".$i."</th>
                    <td>".$entry->billno."</td>
                    <td>".$entry->comp_name."</td>
                    <td>".$entry->ddate."</td>
                    <td>".$entry->cdate."</td>
                    <td>".$amount."</td></tr>";
        $i+=1;
                    # code...
    }
    echo"</tbody></table>";
    echo "<h1 color='green'>Total Amout Is : ".$sum."</h1>";
?>

