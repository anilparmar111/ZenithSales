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
var time = today.getDate() + "/" + today.getMonth() + "/" + today.getFullYear();
document.getElementById("dat").innerHTML=time
t=setTimeout('startTime()', 500);
document.getElementById('clock').innerHTML=h+":"+m;
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
<!--drop down for select item-->
   
<!-- end of drop down list-->
<div class="container">
  <div class="jumbotron" class="container w3-display-container w3-text-white">
  <center>
   <h1>
  <?php echo $_GET['serch']; ?>
  </h1></center>

  

<div class="ss-item-required">

<table class="width: 50%;float: left;">
  <tbody>
    <tr>
        <td><label for="lrn">L.R. No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
        <td>
          <input type="text" required  name="lrn" id="lrn" placeholder="Enter L R No">
        </td>
    </tr>
    <tr>
<td><label for="ttb">Total Box&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
        <td>
          <input type="number" required  name="ttb" id="ttb" placeholder="Enter Total Box">
        </td>
    </tr>
    <tr>
<td><label for="ttc">Total Cartoon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
        <td>
          <input type="number" required  name="ttc" id="ttc" placeholder="Enter Total Cartoon">
        </td>
    </tr>
    <tr>
<td><label for="tcp">Transport&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
        <td>
          <textarea rows='3' cols='23' required  name="tcp" id="tcp" placeholder="Enter Transport"></textarea>
        </td>
    </tr>
  </tbody>
</table>
</div>


</div>
  </div>
        

<form action="add_debit_data.php?serch=<?php echo $_GET['serch'];?>" enctype="multipart/form-data"  method="post">

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
          <tr>
            <th class="text-center"> No </th>
            <th class="text-center"> Product </th>
            <th class="text-center"> Qty </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Total </th>
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
            <td>1</td>
            <td>
            <select id='ll' name='product[]' class="product"  style='width: 200px;' required>
            <option value=''>Select Product</option> 
            <?php
                try 
                {
                    $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
                    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "select * from items";
                    $var=$databasehandler->query($sql);
                    foreach ($var as $key) {
                      echo "<option value='".$key['item_name']."'>".$key['item_name']."</option>";
                    }
                    
                }  
                catch (PDOException $e) {
                    echo $e->getMessage();
                  die();
                }
                ?>
          </select>
          </td>
            <td><input required type="number" name='qty[]'  placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
            <td><input required type="text" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
            <td><input required type="number" name='total[]'  placeholder='0.00' class="form-control total" readonly/></td>
        </tr>
          <tr id='addr1'></tr>
        </tbody>
      </table>

    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12">
      <button type="button" value="button" id="add_row" class="btn btn-default pull-left">Add Row</button>
      <button type="button" value="button"  id='delete_row' class="pull-right btn btn-default">Delete Row</button>
    </div>
  </div>


  <br><br>


  <br><br>
  <input type="date" required name="bdate">
        <input class="btn btn-danger" onclick=" formcheck(); "   type="submit" >
  <div class="row clearfix" style="margin-top:20px;font-size:10px;">
    <div class="pull-right col-md-4">
      <table class="table table-bordered table-hover" id="tab_logic_total">
        <tbody>
        <tr>
            <th class="text-center">Total</th>
            <td class="text-center"><input type="text" id="ttl" name='ttl' readonly placeholder='0.00' class="form-control" /></td>
        </tr>
        <tr>
            <th class="text-center">Price Increse %  </th>
            <td class="text-center"><input type="text" id="inc" name='inc' required placeholder='0.00' class="form-control" /></td>
          </tr>
                  <tr>
            <th class="text-center">GST  </th>
            <td class="text-center"><input type="text" id="gst" name='gst' required placeholder='0' class="form-control" /></td>
          </tr>
           <tr>
            <th class="text-center">Courier Charge  </th>
            <td class="text-center"><input type="text" id="cg" name='cg' required placeholder='0' class="form-control" /></td>
          </tr>
                            <tr>
            <th class="text-center">BOX <br><br> PRICE</th>
            <td class="text-center">
            <input type="text" id="box" name='box' required placeholder='0' class="form-control" />
            <input type="text" id="no" name='no' required placeholder='0' class="form-control" />
            <input type="text" id="ext" name='ext' readonly placeholder='0' class="form-control" />
            
            </td>
          </tr>
          <tr>

            <th class="text-center">Grand Total</th>
            
            <td class="text-center"><input type="text" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</form>



<!-- <a  href="add_debit_data.php?serch=<?php echo $_GET['serch'];?>" class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>Debit</a> -->
<script>

function formcheck() {
  var fields = $(".ss-item-required")
        .find("select, textarea, input").serializeArray();



// Set a Cookie
function setCookie(cName, cValue, expDays) {
        let date = new Date();
        date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
}

// Apply setCookie
// setCookie('username', username, 30);

    

  $.each(fields, function(i, field) {
    if (!field.value)
    {
      alert(field.name + ' is required');
      event.preventDefault();

      // Validation.validate(document.getElementById(field.name));
      

    }
    else
    {
      setCookie(field.name,field.value,7);
      // sessionStorage.setItem(field.name, field.value);
      // alert(field.name + sessionStorage.getItem(field.name));
    }
   });
}




function deleteRow(r) {
  var i = r.parentNode.parentNode.rowIndex;
  document.getElementById("tab_logic").deleteRow(i);
}
</script>

<script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#selUser").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
        </script>


</body>
</html>