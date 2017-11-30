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
        if(!isset($_SESSION["Username"]) || !isset($_SESSION["Usertype"])) {
            echo '<div class="aside"> </div><div class="content"><h1> Please login!</h1> </div>';
            return;
        }
    ?>


    <? 

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM Category"); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $categories = $stmt->fetchAll();


    ?>

    <? if($_SESSION["Usertype"] == "REGULAR") { ?>
        <div class="aside"> 
            <button type="button" onclick="something()"> View my ADS </button>
            <button type="button" onclick="something()"> Post new AD </button>
            <button type="button" onclick="something()"> Change Membership </button>
            <hr>

            <h2> Browse ADS </h2>
            &nbsp;By Category: <br>
            <select id="category"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($categories); $i++) {
                    echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
                } ?>
            </select>
            <br> &nbsp;By Seller: <br>
            <select id="seller"> </select>

            <hr>
            <button type="button" onclick="logout()"> Log out </button>
        </div>
        <div class="content"> </div>
    <? } ?>

    <? if($_SESSION["Usertype"] == "ADMIN") { ?>
        <div class="aside"> 
            <button type="button" onclick="something()"> View all ADS </button>
            <button type="button" onclick="something()"> View Purchase Details </button>
            <hr>

            <h2> Browse ADS </h2>
            &nbsp;By Category: <br>
            <select id="category"> 
                <option value="">  </option>
                <? for($i = 0; $i < count($categories); $i++) {
                    echo "<option value='" . $categories[$i]["CategoryName"]  . "'>" . $categories[$i]["CategoryName"]  . "</option>";
                } ?>
            </select>
            <br> &nbsp;By Seller: <br>
            <select id="seller"> </select>

            <hr>
            <button type="button" onclick="logout()"> Log out </button>
        </div>
        <div class="content"> </div>
    <? } ?>




    
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script src="userpage.js" type="text/javascript"> </script>
  </body>
</html>

