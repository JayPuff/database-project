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
    <title>  Purchase Page  </title>
  </head>
  <body>
    <?php
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Sorry, Please log in to purchase! </h1> </div>';
            return;
        }
    ?>


    <? 
    $mode = "NONE";


    if(!isset($_GET["type"])) {
        echo '<div class="aside"> </div><div class="content"><h1> No type of purchase specified. </h1> </div>';
        return;
    }   

    if($_GET["type"] == "ad") {
         if (!isset($_GET["id"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No ID for purchase specified. </h1> </div>';
            return;
         }

         $mode = "AD";

    } else if ($_GET["type"] == "membership") {
        $mode = "MEMBERSHIP";

    } else if ($_GET["type"] == "promotion") {
        if (!isset($_GET["id"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No ID for purchase specified. </h1> </div>';
            return;
         }

         $mode = "PROMOTION";
    }


    if($mode == "NONE") {
        echo '<div class="aside"> </div><div class="content"><h1> No MODE of purchase specified. </h1> </div>';
        return;
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $mine;
    $ad;

    if($mode == "PROMOTION" || $mode == "AD") {
        $stmt = $conn->prepare("SELECT * FROM Ad WHERE Id=:id");
        $stmt->bindParam(':id', $_GET["id"]);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $ads = $stmt->fetchAll();

        if(count($ads) != 1) {
            echo '<div class="aside"> </div><div class="content"><h1> No advertisment was found with that ID </h1> </div>';
            return;
        }
        
        $ad = $ads[0];
        $mine = ($ad["Username"] == $_SESSION["Username"]);

        if(!$mine && $mode == "MEMBERSHIP") {
            echo '<div class="aside"> </div><div class="content"><h1> Cant purchase membership for not owned AD </h1> </div>';
            return;
        }

        if($mine && $mode == "AD") {
            echo '<div class="aside"> </div><div class="content"><h1> Cant purchase own AD </h1> </div>';
            return;
        }
    }
    
    

    ?>

   
        <div class="aside"> 

            <? if($mode == "MEMBERSHIP") { ?>
                <button type="button" onclick="window.location.href='/userpage.php';"> Back </button>
            <? } ?>

            <? if($mode == "PROMOTION") { ?>
                <button type="button" onclick="window.location.href='/viewad.php?id=<? echo $_GET["id"]; ?>';"> Back </button>
            <? } ?>

            <? if($mode == "AD") { ?>
                <button type="button" onclick="window.location.href='/viewad.php?id= <?  echo $_GET["id"]; ?> ';"> Back </button>
            <? } ?>

            <hr>
        </div>

        <div class="content ad-content"> 
        <? if($mode == "MEMBERSHIP") { ?>
                <h2> Membership Purchase </h2>
            <? } ?>

            <? if($mode == "PROMOTION") { ?>
                <h2> Promotion Purchase </h2>
            <? } ?>

            <? if($mode == "AD") { ?>
                <h2> Buy AD </h2>
            <? } ?>
        </div>

        
        <? if($mode != "MEMBERSHIP") { ?>
            <script>
                <? echo "var id = " . $ad["Id"] ?>
            </script>
        <? } ?>
      


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <!-- <script src="viewad.js" type="text/javascript"> </script> -->

  </body>
</html>

