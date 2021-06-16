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
    <script src='jquery-3.2.1.min.js' type='text/javascript'></script>
    <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

    <style type="text/css">
    .container {
            
            /* padding-top:20px;
            padding-left:15px;
            padding-right:15px; */
        }
    #nd-box {
        float: left;
        /* width: 180px; */
        /* height: 160px; */
        /* margin-left: 20px; */
    }

    #rd-box {
        float: right;
        width: 300px;
        /* height: 160px; */
    }

textarea {
    border: none;
    background-color: transparent;
    resize: none;
    outline: none;
}



    </style>




    <style media="print">
    @page {
        size: auto;
        margin: 0;
    }
    </style>


</head>

<body>

    <?php

try 
{
	$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
	$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "delete FROM bill where billid=? and compname=?";
 
$result = $databasehandler->prepare($sql);
// echo $_GET['blid']; 
$result->execute([ $_GET['blid'] ,$_GET['serch']]); 
// $number_of_rows = $result->fetchColumn(); 
$index=$_GET['blid'];
$ed=$_POST['bdate'];
    if(!empty($_POST['product']))
    {
        $ed=$_POST['bdate'];
        for($i=0;$i<count($_POST['product']);$i++)
        { 
            $prod=$_POST['product'][$i];
            $qt=$_POST['qty'][$i];
            $pr=$_POST['price'][$i];
            session_start();
            if( !isset( $_SESSION['party'] ) ) 
            {
                 $msg="Please Select Party";
                  header("Location: login.php?msg={$msg}");  
            }
			      $sql = "INSERT INTO bill (billid,compname,pname,qty,price,timei,ps,party) VALUES (?,?,?,?,?,?,?,?)";
            $result = $databasehandler->prepare($sql); 
			      $result->execute([$index,$_GET['serch'],$prod,$qt,$pr,$ed,false,$_SESSION['party']]);
        }
//         $sql = "delete FROM payment_status where billid=?";
// $result = $databasehandler->prepare($sql);
// $result->execute([ $_GET['blid'] ]);
// echo "okdone<br>"; 
      $sql = "update  payment_status set compname= ?,pay = ?,payment = ?,
      pdate = ?,party = ? where billid=?";
			$result = $databasehandler->prepare($sql);	
			$result->execute([$_GET['serch'],false,$_POST['sub_total'],$ed,$_SESSION['party'],$index]);
            $sql = "update bill_details set lrno=?,ttb=?,tc=?,tsp=?,pi=?,gst=?,cc=?,box_no=?
            ,price=?,compname=? where billid=? ";
$result = $databasehandler->prepare($sql); 
$result->execute([$_COOKIE['lrn'], $_COOKIE['ttb'], $_COOKIE['ttc'],$_COOKIE['tcp'],$_POST['inc'],
$_POST['gst'],$_POST['cg'],$_POST['box'],$_POST['no'],$_GET['serch'],$index]);

$sql = "update  bill_details set lrno= ?,tc = ?,tsp = ?,pi= ?,gst = ?,cc=?,box_no=?,price=?,ttb=? where billid=? and compname=?";
$result = $databasehandler->prepare($sql); 
$result->execute([$_COOKIE['lrn'],$_COOKIE['ttc'],$_COOKIE['tcp'],$_POST['inc'],$_POST['gst'],$_POST['cg'],
$_POST['box'],$_POST['no'],$_COOKIE['ttb'],$index,$_GET['serch']]);

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
	// header("Location:index.php");
?>


    <div class="container">
        <div class="jumbotron" class="container w3-display-container w3-text-white">
            <center>
                <h1><?php echo $_GET['serch'];?></h1>
            </center>
             <div class="container">
                <div id="nd-box">
                    <h5> Date : <?php $newDate = date("d/m/Y", strtotime($_POST['bdate']));  echo $newDate;  ?> </h5>
                    <h5> Bill No: <?php echo $_GET['blid'] ?>
                    </h5>
                </div>

                <div id="rd-box">
                    <table class="width: 50%;">
                        <tbody>
                            <tr>
                                <td><label for="lrn">L.R. No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </td>
                                <td><?php 
                                echo $_COOKIE['lrn'] ?></td>
                            </tr>
                            <tr>
                                <td><label for="ttb">Total Box&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </td>
                                <td>
                                    <?php echo $_COOKIE['ttb'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="ttc">Total
                                        Cartoon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                                <td>
                                    <?php echo $_COOKIE['ttc'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="tcp">Transport&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </td>
                                <td>
                                    <?php echo $_COOKIE['tcp'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class='table borderless' class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-left"> No </th>
                            <th class="text-left"> Product </th>
                            <th class="text-left"> Qty </th>
                            <th class="text-left"> Price </th>
                            <th class="text-left"> Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

for($i=0;$i<count($_POST['product']);$i++)
        { 
			$index=$i+1;

            echo "<tr id='addr0'>
            <td>".$index."</td>
          <td>".$_POST['product'][$i]."</td>
            <td>".$_POST['qty'][$i]."</td>
            <td>".$_POST['price'][$i]."</td>
            <td>".$_POST['price'][$i]*$_POST['qty'][$i]."</td>
        </tr>
          <tr></tr>";

        }


?>

        <tr>
        <td colspan='5'><br><?php echo " " ?></td>
        
        </tr>
        <tr class="align-right">
        <!-- <td ></td> -->
        <th style="vertical-align:bottom; text-align:left;" colspan='3' rowspan="6">आत्मनिर्भर भारत = Vocal For Local</th>
        <!-- <th style="text-align:right;" colspan='4' class="align-right" >Total</th> -->
        <th>Total</th>
        <td><?php echo $_POST['ttl'] ?></td>
        </tr>
        <tr>
        <!-- <td colspan='3'></td> -->
        
        <th>Price <?php 
            if($_POST['inc']>=0)
            {
                echo " + (plus) = ";
                echo $_POST['inc'];
                echo "%";
            }
            else {
                echo " - (minus) = ";
                echo $_POST['inc']*-1;
                echo "%";
                
            }

        ?> </th>
        <td><?php 
            $ans=0;
            $ans=($_POST['ttl']*$_POST['inc'])/100;
            echo $ans;
        
        ?></td>
        </tr>

            <tr>
        <!-- <td colspan='3'></td> -->
        <th>GST</th>
        <td><?php echo $_POST['gst'] ?></td>
        </tr>
        <tr>

        <!-- <td colspan='3'></td> -->
        <th>Courier Charge</th>
        <td><?php echo $_POST['cg'] ?></td>
        </tr>

        <tr>
        <!-- <td colspan='3'></td> -->
        <th>BOX = <?php echo $_POST['box']; echo " "; ?><br> Price Of Each = <?php echo $_POST['no'] ?> </th>
        <td><?php echo $_POST['box']*$_POST['no'] ?></td>
        </tr>

        <tr>
        <!-- <td  colspan='3'>आत्मनिर्भर भारत = Vocal For Local</td> -->
        <th>Grand Total</th>
        <th><?php echo $_POST['sub_total'] ?></th>
        </tr>



                    </tbody>
                </table>

            </div>
        </div>

        <br><br>


        <br><br>
        <!-- <div class="row clearfix" style="margin-top:20px">
            <div class="pull-right col-md-4">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                        <tr>

                            <th class="text-center">Grand Total</th>

                            <td class="text-center">
                                <?php
            echo $_POST["sub_total"];
            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>

</body>

</html>