<html>

<head>
</head>

<body>
<form method="post" action="#">
<center><p>Please select Party:</p>
        <input type="radio" id="zs" name="party" value="zs" required>
        <label for="male">Zenithsales</label><br>
        <input type="radio" id="ms" name="party" value="ms" required>
        <label for="female">Mannsales</label><br>
        <input type="submit" name="submit" value="submit">
        </center>
</form>        
</body>
</html>

<?php
error_reporting(0);
session_start();
if(isset($_POST['submit']))
{
    
    $_SESSION["party"] = $_POST['party'];
    header("Location: index.php");
}

if( !empty( $_REQUEST['msg'] ) )
{
    $message=$_REQUEST['msg'];
    echo "<script type='text/javascript'>alert('$message');</script>";
}


?>