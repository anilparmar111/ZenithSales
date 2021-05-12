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
	$sql = "SELECT count(DISTINCT billid)   FROM bill where compname= ? and party=?";

	// $sql = "SELECT count(*) FROM `table` WHERE foo = ?"; 
$result = $databasehandler->prepare($sql); 
$result->execute([ $_GET['serch'],$_SESSION['party'] ]); 
$number_of_rows = $result->fetchColumn(); 
$index=$number_of_rows+1;
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
      $sql = "INSERT INTO payment_status (compname,billid,pay,payment,pdate,party) VALUES (?,?,?,?,?,?)";
			$result = $databasehandler->prepare($sql);	
      
			$result->execute([$_GET['serch'],$index,false,$_POST['sub_total'],$ed,$_SESSION['party']]);
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
                    <h5> Bill No: <?php $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
	              $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	              $sql = "SELECT count(DISTINCT billid)   FROM payment_status where compname= ? and party=?";
                $result = $databasehandler->prepare($sql); 
                $result->execute([ $_GET['serch'],$_SESSION['party']]); 
                $number_of_rows = $result->fetchColumn(); echo $number_of_rows 
                      ?>
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
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center"> # </th>
                            <th class="text-center"> Product </th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Total </th>
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

                    </tbody>
                </table>

            </div>
        </div>

        <br><br>


        <br><br>
        <div class="row clearfix" style="margin-top:20px">
            <div class="pull-right col-md-4">
                <table class="table table-bordered table-hover" id="tab_logic_total">
                    <tbody>
                        <tr>
                            <th class="text-center">Total</th>
                            <td class="text-center"><?php echo $_POST['ttl'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-center">Price Increse % </th>
                            <td class="text-center"><?php echo $_POST['inc'] ?></td>
                        </tr>
                        <tr>
                            <th class="text-center">GST </th>
                            <td class="text-center"><?php echo $_POST['gst']?></td>
                        </tr>
                        <tr>
                            <th class="text-center">Courier Charge</th>
                            <td class="text-center"><?php echo $_POST['cg']?></td>
                        </tr>
                        <tr>
                            <th class="text-center">BOX <br> PRICE</th>
                            <td class="text-center">
                                <?php echo $_POST['box'] ?>
                                <br>
                                <?php echo $_POST['no'] ?>
                                <br>
                                <?php echo $_POST['box']*$_POST['no'] ?>
                                <!-- <input type="text" id="box" name='box' readonly placeholder=""  class="form-control" /> -->
                                <!-- <input type="text" id="no" name='no' readonly placeholder="" class="form-control" /> -->
                                <!-- <input type="text" id="ext" name='ext' readonly placeholder="" class="form-control" /> -->

                            </td>
                        </tr>
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
        </div>
    </div>

</body>

</html>