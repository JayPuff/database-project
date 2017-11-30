<?php session_start(); ?>
<?php include 'config.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  Register  </title>
  </head>
  <body>
    <?php

    unset ($_SESSION['Username']);
    unset ($_SESSION['Usertype']);
    
    echo '<h1> Logged out successfully! </h1>';
    
    ?>


    <script> window.location.href = "/login.php";  </script>


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <!-- <script src="index.js" type="text/javascript"> </script> -->
  </body>
</html>

