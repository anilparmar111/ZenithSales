<?php include 'required.php';?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Bill</title>

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
    <link rel="stylesheet" href="style.css">
    <script>
        $(document).ready(function () {

 $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}

            var rowIdx = 0;
            var prevs = new Array();
            //geteditbilldata.php?bln=&comp=
            var v1=$.ajax({
  url: "geteditbilldata.php",
  async: false,
  dataType: 'json',
  type: "get", //send it through get method
  data: { 
    bln: $.urlParam('bln'), 
    comp: $.urlParam('comp'), 
  },
  success: function(response) {
    //Do Something
    prevs=response;
    // console.log(response);
  },
  error: function(xhr) {
    //Do Something to handle error
    console.log("some errror occurder");
  }
});

            id_numbers = new Array();
            var st = "";
            var t2 = $.ajax({
                url: 'productdata.php',
                type: 'post',
                async: false,
                dataType: 'json',
                success: function (response) {
                    id_numbers = response;
                    // console.log(id_numbers);
                    // console.log(response);
                }
            });
            t2 = id_numbers;
                var len = t2.length;
                var t3 = "";
                for (var i = 0; i < len; i++) {
                    var price = t2[i]['price'];
                    var name = t2[i]['name'];
                    t3 += "<option value='" + name + "'>" + name + "</option>";
                }
            console.log(prevs);
            // console.log(id_numbers);

          var tl=prevs.length;
          for(var i=0;i<tl;i++)
          {
            var t4="";
                var l2 = t2.length;
                for (var j = 0; j < l2; j++) {
                    var price = t2[j]['price'];
                    var name = t2[j]['name'];
                    if(prevs[i]['pname']==name)
                    {
                        t4 += "<option selected value='" + name + "'>" + name + "</option>";
                    }
                    else
                    {
                      t4 += "<option value='" + name + "'>" + name + "</option>";
                    }
                }

                $('#tbody').append(`<tr id="R${++rowIdx}">
            <td class="text-center">
				<button class="btn btn-danger remove"
				type="button">Remove</button>
			</td>
			<td class="row-index text-center">
			<p>${rowIdx}</p>
			</td>`+
                    `<td><select id='ll' name='product[]' class="product" selected="`+prevs[i]['pname']+`"  onchange="getval(this);"  style='width: 200px;' required>
            <option value=''>Select Product</option>`+ t4 + `
            <td><input required type='number' value="`+prevs[i]['qty']+`" name='qty[]'  placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
            <td><input required type='text' value="`+prevs[i]['price']+`" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
            <td><input required type='number'  name='total[]'  placeholder='0.00' class='form-control total' readonly/></td>
			</tr>`);
          }
          calc();
          calc_total();
            $('#addBtn').on('click', function () {
                
                $('#tbody').append(`<tr id="R${++rowIdx}">
            <td class="text-center">
				<button class="btn btn-danger remove"
				type="button">Remove</button>
			</td>
			<td class="row-index text-center">
			<p>${rowIdx}</p>
			</td>`+
    `<td>
        <select id='ll' name='product[]' class="product"  onchange="getval(this);"  style='width: 200px;' required>
          <option value=''>Select Product</option>`+ 
          t3 + 
          `</select>
          </td>
            <td><input required type='number' name='qty[]'  placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
            <td><input required type='text' name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
            <td><input required type='number' name='total[]'  placeholder='0.00' class='form-control total' readonly/></td>
			</tr>`);
            });
            $('#tbody').on('click', '.remove', function () {
                var child = $(this).closest('tr').nextAll();
                child.each(function () {
                    var id = $(this).attr('id');
                    var idx = $(this).children('.row-index').children('p');
                    var dig = parseInt(id.substring(1));
                    idx.html(`${dig - 1}`);
                    $(this).attr('id', `R${dig - 1}`);
                });
                $(this).closest('tr').remove();
                rowIdx--;
                calc();
          calc_total();
            });
        });
    </script>
</head>

<body>
<div class="container">
  <div class="jumbotron" class="container w3-display-container w3-text-white">
  <center>
   <h1>
  <?php echo $_GET['comp']; ?>
  </h1></center>


<?php
// session_start();
$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from bill_details where billid='".$_GET['bln']."' and compname='".$_GET['comp']."'";
    $var=$databasehandler->query($sql);
    // echo $var;
foreach ($var as $key) 
    {
echo "
<div class='ss-item-required'>

    <table class='width: 50%;float: left;'>
        <tbody>
            <tr>
                <td><label for='lrn'>L.R. No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td>
                    <input type='text' value='".$key['lrno']."' required name='lrn' id='lrn' placeholder='Enter L R No'>
                </td>
            </tr>
            <tr>
                <td><label for='ttb'>Total Box&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td>
                    <input type='text' value='".$key['ttb']."' required name='ttb' id='ttb' placeholder='Enter Total Box'>
                </td>
            </tr>
            <tr>
                <td><label for='ttc'>Total Cartoon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td>
                    <input type='text' value='".$key['tc']."' required name='ttc' id='ttc' placeholder='Enter Total Cartoon'>
                </td>
            </tr>
            <tr>
                <td><label for='tcp'>Transport&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td>
                    <textarea rows='3'  cols='23' required name='tcp' id='tcp' placeholder='Enter Transport'>".$key['lrno']."</textarea>
                </td>
            </tr>
        </tbody>
    </table>
</div>


</div>
</div>
";
    }

?>
        

<form action="add_debit_ud_data.php?serch=<?php echo $_GET['comp']."&blid=".$_GET['bln'];?>" enctype="multipart/form-data"  method="post">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center"> # </th>
                            <th class="text-center"> No </th>
                            <th class="text-center"> Product </th>
                            <th class="text-center"> Qty </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Total </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
            <button class="btn btn-md btn-primary" id="addBtn" type="button">
                Add new Row
            </button>
        </div>
        
  <br><br>
<?php

$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select * from bill_details where billid='".$_GET['bln']."' and compname='".$_GET['comp']."'";
    $var=$databasehandler->query($sql);
    // echo $var;
foreach ($var as $key) 
    {
     

echo "
<input type='date'  required name='bdate'>
        <input class='btn btn-danger' onclick=' formcheck(); '   type='submit' >
  <div class='row clearfix' style='margin-top:20px;font-size:10px;'>
    <div class='pull-right col-md-4'>
      <table class='table table-bordered table-hover' id='tab_logic_total'>
        <tbody>
        <tr>
            <th class='text-center'>Total</th>
            <td class='text-center'><input type='text' id='ttl' name='ttl' readonly placeholder='0.00' class='form-control' /></td>
        </tr>
        <tr>
            <th class='text-center'>Price Increse %  </th>
            <td class='text-center'><input type='text'  value='".$key['pi']."'  id='inc' name='inc' required placeholder='0.00' class='form-control' /></td>
          </tr>
                  <tr>
            <th class='text-center'>GST  </th>
            <td class='text-center'><input type='text'  value='".$key['gst']."'  id='gst' name='gst' required placeholder='0' class='form-control' /></td>
          </tr>
           <tr>
            <th class='text-center'>Courier Charge  </th>
            <td class='text-center'><input type='text'  value='".$key['cc']."'  id='cg' name='cg' required placeholder='0' class='form-control' /></td>
          </tr>
                            <tr>
            <th class='text-center'>BOX <br><br> PRICE</th>
            <td class='text-center'>
            <input type='text' id='box' value='".$key['box_no']."'  name='box' required placeholder='0' class='form-control' />
            <input type='text' id='no' name='no' value='".$key['price']."'  required placeholder='0' class='form-control' />
            <input type='text' id='ext' name='ext' readonly placeholder='0' class='form-control' />
            
            </td>
          </tr>
          <tr>

            <th class='text-center'>Grand Total</th>
            
            <td class='text-center'><input type='text' name='sub_total' placeholder='0.00' class='form-control' id='sub_total' readonly/></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>



";


    }



?>
  


</form>


<script type="text/javascript">
    $("#ll").select2({
        templateResult: formatState
    });
    function formatState (state) {
        if (!state.id) {
            return state.text;
        }
        var $state = state.text;
        return $state;  
    }
    

</script>

<script>

function getval(sel)
{
    var currentRow=$(sel).closest('tr'); 
    var qty = currentRow.find('.qty').val();
    // currentRow.find('.qty').val("0");
    var fnd=sel.value;
    var tmp=0;
    // console.log(qty);
    $.ajax({
                url: 'productdata.php',
                    type: 'post',
                    dataType: 'json',
                    success:function(response){
                      console.log(response);
                        var len = response.length;
                        // $("#ll").empty();
                        for( var i = 0; i<len; i++){
                            var  price= response[i]['price'];
                            var name = response[i]['name'];
                            // console.log(name);
                            // console.log(price);
                            if(fnd==name)
                            {
                              currentRow.find('.price').val(price);
                              tmp=price;
                              break;
                            }
                            // $("#ll").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
      });
      // console.log("tmp is : "+tmp);
      // currentRow.find('.price').val("11");
// var currentRow=$(sel).closest('tr'); 
//  var col1=currentRow.find("td:eq(1)").text();
//  currentRow.find("td:eq(3)").text=sel.value;
  // console.log(currentRow.find("td:eq(3)").text()+'ok');  
  // console.log($(sel).closest('tr').index());
  // var index=($(sel).closest('tr').index());
  // console.log(index);
  // console.log("jay swmainarayan");
  // var cells = document.getElementById('tab_logic').getElementsByTagName('tr');
  // console.log(cells[1][1].value);
  // cells[2].style.backgroundColor = 'red';

  // console.log(sel.value);
  // $('#value').text($('#tab_logic tr:nth-child(0) td:nth-child(0)').text());
  // console.log($('#tab_logic tr:nth-child(index) td:nth-child(0)').text()+'ok');

  
  // $.ajax({
                // url: 'productdata.php',
                    // type: 'post',
                    // dataType: 'json',
                    // success:function(response){
                      // console.log(response);
                        // var len = response.length;
                        // $("#ll").empty();
                        // for( var i = 0; i<len; i++){
                            // var price = response[i]['price'];
                            // var name = response[i]['name'];
                            // $("#ll").append("<option value='"+name+"'>"+name+"</option>");
                        // }
                    // }
                // });

  // console.log(sel);
    // $(sel).closest('tr').index()
}

function givevalue()
{
    console.log("ok i am call");
}

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