<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="media/bootstrap.min.css" rel="stylesheet">
        <script src="media/jquery-1.11.1.min.js"></script>
        <script src="media/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="font-awesome.min.css">
<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>
<a style="text-decoration:none" href="Adduser.php"><button type="button" class="btn btn-danger btn-lg btn-block">Add New User</button></a>
<div class="container">

  <center><h2>Serch User</h2></center>
  <p>Type Something In The Input Field To Search User Name</p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Company Name</th>
        <th>Debit</th>
      </tr>
    </thead>
    <tbody id="myTable">

    <?php 
try {
$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "select * from comp";
session_start();
$qryres=$databasehandler->query($sql);
while ($row = $qryres->fetch()) 
{
  echo("<tr><td>".$row['comp_name']."</td><td><a target='_blank' href='Debit.php?serch=".$row['comp_name']." ' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>Debit</a></td></tr>");
}
}
catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
?>

    </tbody>
  </table>
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>