<?php session_start(); ?>
<?php include 'config.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <title>  User page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"])) {
            echo "<h1> Sorry, not logged in. </h1>";
            return;
        }
    ?>





    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="index.js" type="text/javascript"> </script>
  </body>
</html>

