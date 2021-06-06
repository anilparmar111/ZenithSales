<input type="button" value="Remove" onclick="removeRow(this)"/>
function removeRow(oButton) {
        var empTab = document.getElementById('tab_logic');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // buttton -> td -> tr
    }


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

<select id='ll' name="product[]"  class="form-control" class="product"  style='width: 200px;' required>
            <!-- <select id='ll' name='product[]' class="product"  style='width: 200px;' required> -->
            <option value=''>Select Product</option> 
            <?php
                                    $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
                                    $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $sql = "select * from items";
                                    $var=$databasehandler->query($sql);
                                    foreach ($var as $key) {
                                        echo "<option value='".$key['item_name']."'>".$key['item_name']." price : ".$key['price']."</option>";
                                    }
                                ?>
          </select>



          <!-- new -->
 <!-- <link rel="icon" href="https://codingbirdsonline.com/wp-content/uploads/2019/12/cropped-coding-birds-favicon-2-1-192x192.png" type="image/x-icon"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" /> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<style>.required{color: #FF0000;}
           .flag{background-color: #ff884b;padding: 10px;border-radius: 20px;color: white}
    </style>
    <!-- new end -->