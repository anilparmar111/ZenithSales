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
t=setTimeout('startTime()', 500)
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


<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
    <form action="add_debit_data.php?serch=<?php echo $_GET['serch'];?>"  method="post">
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
          <tr id='addr0'>
            <td>1</td>
            <td><input type="text" name='product[]'  placeholder='Enter Product Name' class="form-control"/></td>
            <td><input type="number" name='qty[]'  placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
            <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
            <td><input type="number" name='total[]'  placeholder='0.00' class="form-control total" readonly/></td>
            <!-- <td><button id='delete_row' class="pull-right btn btn-default">Delete Row</button></td> -->
            <!-- <td><input type="button" value="Delete" onclick="deleteRow(this)"></td> -->
        </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>
      <input type="submit">
</form>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <button type="button" value="button" id="add_row" class="btn btn-default pull-left">Add Row</button>
      <button type="button" value="button"  id='delete_row' class="pull-right btn btn-default">Delete Row</button>
    </div>
  </div>
  <div class="row clearfix" style="margin-top:20px">
    <div class="pull-right col-md-4">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
          <tr>
            <th class="text-center">Total</th>
            
            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
          <!-- <tr>
            <th class="text-center">Tax</th>
            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                <input type="number" class="form-control" id="tax" placeholder="0">
                <div class="input-group-addon">%</div>
              </div></td>
          </tr>
          <tr>
            <th class="text-center">Tax Amount</th>
            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
          </tr> 
          <tr>
            <th class="text-center">Grand Total</th>
            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
        </tr>-->
        
        </tbody>
      </table>
    </div>
  </div>
</div>





<!-- <a  href="add_debit_data.php?serch=<?php echo $_GET['serch'];?>" class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>Debit</a> -->
<script>
function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("tab_logic").deleteRow(i);
}
</script>

</body>
</html>