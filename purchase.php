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
    } else if ($_GET["type"] == "store") {
        if (!isset($_GET["requesteddate"]) || !isset($_GET["requestedtime"]) || !isset($_GET["duration"]) || !isset($_GET["delivery"]) || !isset($_GET["location"])) {
            echo '<div class="aside"> </div><div class="content"><h1> No parameters needed for store purchase </h1> </div>';
            return;
         }

         $mode = "STORE";
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

            <? if($mode == "STORE") { ?>
                <button type="button" onclick="window.location.href='/rent.php';"> Back </button>
            <? } ?>

            <hr>
        </div>

        <div class="content ad-content"> 
        <? if($mode == "MEMBERSHIP") { ?>
                <h2> Membership Purchase </h2>
                <p> Memberships will allow your ads to remain on the site for a longer period of time </p>
                <p> 7 Days - 10$ </p>
                <p> 14 Days - 50$ </p>
                <p> 30 Days - 90$ </p>

                <select id="membership">
                    <option value='7' > 7 Days </option>
                    <option value='14' > 14 Days </option>
                    <option value='30' > 30 Days </option>
                </select>

            <? } ?>

            <? if($mode == "PROMOTION") { ?>
                <h2> Promotion Purchase </h2>
                <p> Promotions will bump your AD to the TOP </p>
                <p> 7 Days - 10$ </p>
                <p> 14 Days - 50$ </p>
                <p> 30 Days - 90$ </p>

                <select id="promotion">
                    <option value='7' > 7 Days </option>
                    <option value='14' > 14 Days </option>
                    <option value='30' > 30 Days </option>
                </select>
            <? } ?>

            <? if($mode == "AD") { ?>
                <h2> Buy AD </h2>
                <p> You are currently purchasing: <? echo $ad["Title"] ?> </p>
                <p> For: <? echo $ad["Price"]  ?> </p>
            <? } ?>

            <? if($mode == "STORE") { ?>
                <h2> Pre-purchase for Store Rent </h2>
                <p> Payment will only be authorized once an admin accepts this request </p>
            <? } ?>


            <hr> <br>
            <? purchaseInfo(); ?>

        </div>

        <script>
            <? echo "var type = '" . $mode . "';" ?>
        </script>

        <? if($mode == "STORE") { ?>
            <script>
                <? echo "var requesteddate = '" . $_GET["requesteddate"] . "'; "; ?>
                <? echo "var requestedtime = " . $_GET["requestedtime"] . "; "; ?>
                <? echo "var loc = '" . $_GET["location"] . "'; "; ?>
                <? echo "var delivery = '" . $_GET["delivery"] . "'; "; ?>
                <? echo "var duration = " . $_GET["duration"] . "; "; ?>
            </script>
        <? }  ?>

        
        <? if($mode != "MEMBERSHIP" && $mode != "STORE") { ?>
            <script>
                <? echo "var id = " . $ad["Id"] . ";" ?>
            </script>
        <? } else { ?>
            <script>
                <? echo "var id = 0;" ?>
            </script>
        <? }  ?>

        <? if($mode == "AD") { ?>
            <script>
                <? echo "var price = " . $ad["Price"] ?>
            </script>
        <? } else { ?>
            <script>
                <? echo "var price = 0;" ?>
            </script>

        <? } ?>
      


    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="purchase.js" type="text/javascript"> </script>

  </body>
</html>

