<?php include 'required.php';?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="media/bootstrap.min.css" rel="stylesheet"> -->
        <!-- CSS only -->
        <!-- CSS only -->
        <link href="bootstrap.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
        <!-- <script src="media/jquery-1.11.1.min.js"></script> -->
        <!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> -->
        <!-- <script src="media/bootstrap.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="font-awesome.min.css"> -->
<link rel="stylesheet" href="au.css" >
</head>


<body>

<a style='text-decoration:none' href='debit_serch.php'><button type='button' class='btn btn-danger btn-lg btn-block'>Debit</button></a>
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <!-- <form method="post" action="#"> -->
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text-truncate">Register New User</h1>
                    <div class="px-2">
                        <form action="addtodb.php" method="post" class="justify-content-center">
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

<!-- 
        <input  class="form-control p-2 bd-highlight col-example" name="myInput" id="myInput" type="text" placeholder="Search..">
    
        <input type="submit" name="SubmitButton"/> -->
<!-- JavaScript Bundle with Popper -->
<script type="text/javascript" src="bootstrap.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> -->
</body>
</html>


