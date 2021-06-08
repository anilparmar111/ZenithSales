<!DOCTYPE html>
<html>

<head>
    <title>test page</title>

    <link href="media/bootstrap.min.css" rel="stylesheet">
    <script src="media/jquery-1.11.1.min.js"></script>
    <script src="media/bootstrap.min.js"></script>
    <script src='jquery-3.2.1.min.js' type='text/javascript'></script>
    <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form method="POST" action="#">
        <input type="text" id="bln" name="bln" required placeholder="Enter Your Bill No">
        <select id='ll1' name='comp' class="product" style='width: 200px;' required>
            <option value=''>Select Compnay</option>
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
        <button type="submit">Submit</button>    
    </form>
<?php 
if(!empty($_POST))
{
    $bln=$_POST['bln'];
    $comp=$_POST['comp'];
    $url="Location: editbill.php?bln=".$bln."&comp=".$comp;
    header($url);

}

?>

        <script type="text/javascript">
            $("#ll1").select2({
                templateResult: formatState
            });
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = state.text;
                return $state;
            }
        </script>


</body>

</html>