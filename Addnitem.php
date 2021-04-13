<?php include 'required.php';?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="au.css" >
</head>


<body>

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <!-- <form method="post" action="#"> -->
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text-truncate">Register New Item</h1>
                    <div class="px-2">
                        <form action="additem.php" method="post" class="justify-content-center">
                            <div class="form-group">
                                <label class="sr-only">Name</label>
                                <input  name="myInput" type="text" required class="form-control" placeholder="Enter Name">
                            </div>
                            <button type="submit" name="SubmitButton" class="btn btn-primary btn-lg">Register</button>
                        </form>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>


