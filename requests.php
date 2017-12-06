<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php include 'utils.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="index.css"/>
    <link rel="stylesheet" href="userpage.css"/>
    <title>  User page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Please login!</h1> </div>';
            return;
        }
    ?>


    <? 

    if($_SESSION["Usertype"] != "ADMIN") {
        echo '<div class="aside"> </div><div class="content"><h1> You must be an admin to view requests. </h1> </div>';
        return;
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requests = array();

   
    $stmt = $conn->prepare("SELECT r.* FROM PhysicalStore r WHERE r.Status='PENDING'");
    
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $requests = $stmt->fetchAll();

    ?>


    <? if($_SESSION["Usertype"] == "ADMIN") { ?>
        <div class="aside"> 
            <button type="button" onclick="back()"> Back </button>
            <hr>
            <br>
        </div>
        <div class="content"> 
                <?php displayRequests($requests); ?>
        </div>
    <? } ?>




    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="requests.js" type="text/javascript"> </script>


  </body>
</html>

